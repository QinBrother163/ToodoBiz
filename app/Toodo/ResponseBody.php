<?php

namespace App\Toodo;


class ResponseBody extends BaseBody
{
    public static function signCode($body, $secret)
    {
        $str = ''
            . self::getParam($body, 'bizContent')
            . self::getParam($body, 'code')
            . self::getParam($body, 'msg')
            . self::getParam($body, 'subCode')
            . self::getParam($body, 'subMsg')
            . self::getParam($body, 'timestamp')
            . self::getParam($body, 'token')
            . $secret;
        return md5($str);
    }
}