<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'fname', 'lname', 'address', 'phone', 'visits', 'last_visit', 'role', 'price_type', 'manager_id', 'client_type', 'client_comment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function price_type():BelongsTo
    {
        return $this->belongsTo(PriceType::class, 'price_type','id');
    }

    /**
     * @return string
     */
    public function getUserId():string
    {
        return (string) auth()->check()?auth()->user()->id:session("user_id");
    }
}
