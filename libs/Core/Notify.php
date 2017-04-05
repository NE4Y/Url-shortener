<?php

/**
 * Created by PhpStorm.
 * User: Steffen
 * Date: 01.06.16
 * Time: 15:32
 */
class Notify {
    private static $notify = array();

    public static function addNotify($msg) {
        array_push(self::$notify, $msg);
    }

    public static function getNotify() {
        return self::$notify;
    }

}

?>