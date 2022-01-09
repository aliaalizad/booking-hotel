<?php

namespace App\Classes\Token;

use App\Models\Token as TokenModel;
use Illuminate\Support\Facades\Hash;

class Token
{
    public static $column_name;
    public static $class_name;

    public static function make($id, $content, $target, $validitylength) 
    {
        if ((static::$class_name)::find($id) != null && static::get($id, $target) == null) {
            TokenModel::create([
                'token' => Hash::make($content),
                static::$column_name => $id,
                'target' => $target,
                'expired_at' => now()->addMinutes($validitylength),
                'created_at' => now(),
            ]);

            return true;
        }

        return false;
    }


    public static function isValid($id, $content, $target)
    {
        if (static::get($id, $target) != null) {
            return Hash::check($content, static::get($id, $target)->token);
        }

        return false;
    }


    protected static function get($id, $target)
    {
        if ((static::$class_name)::find($id) != null) {
            $token = (static::$class_name)::find($id)->tokens()->where([
                ['target', '=', $target],
                ['expired_at', '>', now()],
            ])->first();

            return $token;
        }

        return null;
    }

}
