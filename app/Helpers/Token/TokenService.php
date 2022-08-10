<?php

namespace App\Helpers\Token;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class TokenService {

    public function make($tokenable, $content, $type, int $expiration)
    {
        if ( ($tokenable instanceof Admin) or ($tokenable instanceof Manager) or ($tokenable instanceof Member) or ($tokenable instanceof User) ) {

            $tokenable->tokens()->create([
                'token' => Hash::make($content),
                'type' => $type,
                'expired_at' => now()->addMinutes($expiration),
            ]);

        } else {
            throw new Exception('Tokenable is not valid');
        }
    }

    public function isValid($tokenable, $content, $type)
    {
        $token = $this->get($tokenable, $type);

        if (is_null($token)) {
            return false;
        }

        return Hash::check($content, $token->token);
    }

    public function has($tokenable, $type)
    {
        return is_null($this->get($tokenable, $type)) ? false : true;
    }

    public function get($tokenable, $type)
    {
        if ( ($tokenable instanceof Admin) or ($tokenable instanceof Manager) or ($tokenable instanceof Member) or ($tokenable instanceof User) ) {

            $token = $tokenable->tokens->where('expired_at', '>=', now())->where('type', $type)->last();

        } else {
            return null;
        }

        return $token;
    }
}