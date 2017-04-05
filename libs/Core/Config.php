<?php

/**
 * Class Config, simple Key-Value Store
 * Author: Steffen Lindner
 */
class Config {

    private static $registry = Array();

    public static function set($key,$value){
        self::$registry[$key] = $value;
    }

    public static function get($key){
        if(array_key_exists($key,self::$registry)){
            return self::$registry[$key];
        }
        return false;
    }

    /**
     * Load all Config sets placed inside the config_dir
     */
    public static function loadConfigs() {
        foreach (glob(self::get("config_dir")."/*.php") as $filename) {
            include($filename);
        }
    }
}
?>