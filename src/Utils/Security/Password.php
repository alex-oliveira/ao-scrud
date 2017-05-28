<?php

namespace AoScrud\Security;

class Password
{

    public static function generate($length = 6)
    {
        $rang = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = $length < 8 ? 8 : $length;
        $password = $rang[rand(0, 9)] . $rang[rand(10, 35)] . $rang[rand(36, 61)];
        $count = strlen($rang) - 1;

        for ($i = 4; $i < $length; $i++)
            $password .= $rang[rand(0, $count)];

        return $password;
    }

    public static function crypt($string)
    {
        return bcrypt($string);
    }

}