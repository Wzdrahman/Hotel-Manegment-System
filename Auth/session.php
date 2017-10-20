<?php

class Auth
{
    public static function getUser($user)
    {
        return $_SESSION[$user->email];
    }

    public static function login($user)
    {
        $_SESSION[$user->email] = [
            'name ' => $user->name,
        ];
    }

    public static function logout()
    {

    }
}
