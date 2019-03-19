<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class,1)->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
        ]);
        factory(\App\Models\User::class,10)->create();
    }
}
