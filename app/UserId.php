<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserId extends Model
{
    //

    protected $fillable_ = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden_ = [
        'password', 'remember_token',
    ];
}
