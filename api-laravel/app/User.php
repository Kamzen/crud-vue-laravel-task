<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    //table name
    protected $table = 'users';

    //primary key
    protected $primaryKey = 'user_id';

    protected $hidden = ['password', 'reset_password_token'];

}
