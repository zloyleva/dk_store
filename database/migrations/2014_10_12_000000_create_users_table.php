<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->unique();
            $table->string('fname',50)->default('');
            $table->string('lname',50)->default('');
            $table->string('email',50)->unique();
            $table->string('password');


            $table->string('address',100)->nullable();
            $table->string('phone',25)->nullable();
//            $table->string('api_token', 60)->unique()->nullable();

            $table->integer('visits')->default(0);
            $table->timestamp('last_visit');

            $table->string('role',10)->default('user');
            $table->integer('price_type')->default(1);
            $table->integer('manager_id')->default(1);
            $table->string('client_type')->nullable();
            $table->string('client_comment')->nullable();

            $table->rememberToken();
            $table->timestamps();

            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
