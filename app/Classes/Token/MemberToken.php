<?php

namespace App\Classes\Token;

class MemberToken extends Token
{
    public static $column_name = 'member_id';
    public static $class_name = 'App\Models\Member' ;
}