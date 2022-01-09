<?php

namespace App\Classes\Token;

class UserToken extends Token
{
    public static $column_name = 'user_id';
    public static $class_name = 'App\Models\User' ;
}