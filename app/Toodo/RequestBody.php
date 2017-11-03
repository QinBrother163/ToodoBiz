<?php

namespace App\Toodo;


class RequestBody extends BaseBody
{
    public static function signCode($body, $secret)
    {
        $str = ''
            . self::getParam($body, 'appAuthToken')
            . self::getParam($body, 'appId')
            . self::getParam($body, 'bizContent')
            . self::getParam($body, 'charset')
            . self::getParam($body, 'format')
            . self::getParam($body, 'method')
            . self::getParam($body, 'timestamp')
            . self::getParam($body, 'version')
            . $secret;

        return md5($str);
    }
}