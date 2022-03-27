<?php

namespace App\Helpers\Token;

use App\Models\Token as TokenModel;
use Illuminate\Support\Facades\Hash;

class Token
{
    public static $column_name;
    public static $class_name;

    public static function make($id, $content, $type, $validitylength) 
    {
        if ((static::$class_name)::find($id) != null && static::get($id, $type) == null) {

            TokenModel::create([
                'token' => Hash::make($content),
                'tokenable_id' => $id,
                'tokenable_type' => static::$class_name,
                'type' => $type,
                'expired_at' => now()->addMinutes($validitylength),
                'created_at' => now(),
            ]);
        }
    }


    public static function isValid($id, $content, $type)
    {
        if (static::get($id, $type) != null) {
            return Hash::check($content, static::get($id, $type)->token);
        }

        return false;
    }

    public static function exists($id, $type)
    {
        return static::get($id, $type) == null ? false : true;
    }

    public static function delete($id, $type) {
        if (self::exists($id, $type)) {
            $token = (static::$class_name)::find($id)->tokens()->where([
                ['type', $type],
                ['expired_at', '>', now()],
            ]);

            $token->delete();
        }
    }


    protected static function get($id, $type)
    {
        if ((static::$class_name)::find($id) != null) {
            $token = (static::$class_name)::find($id)->tokens()->where([
                ['type', $type],
                ['expired_at', '>', now()],
            ])->first();

            return $token;
        }

        return null;
    }

}
