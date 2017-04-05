<?php

/**
 * Simple php routing
 * Allows you to announce routes towards the corresponding template
 * Author: Steffen Lindner
 */
class Route {

    public static $routes = Array();
    public static $routes404 = Array();
    public static $routes_dir = "";
    public static $path;

    /**
     * Get requested url
     */
    public static function init($route_dir) {
        self::$routes_dir = $route_dir;

        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        if(isset($parsed_url['path'])) {
            self::$path = ltrim($parsed_url['path'], '/');
        }
        else{
            self::$path = '';
        }

	if(empty(Config::get("basepath"))) {
		self::$path = "/".self::$path;
	}

        self::loadRoutes();
    }

    public static function loadRoutes() {
        foreach (glob(self::$routes_dir."/*.php") as $filename) {
            include($filename);
        }
    }

    public static function getRequestedPath() {
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        if(isset($parsed_url['path'])) {
            return str_replace(Config::get('basepath'), "", ltrim($parsed_url['path'], "/"));
        }
        else {
            return '';
        }
    }



    /**
     * Add route and corresponding execution function
     * @param $expression Route
     * @param $function will be executed by calling the route
     */
    public static function add($expression,$function){
        array_push(self::$routes,Array(
            // mask slash and add basepath
            'expression'=>str_replace("/", '\/', Config::get('basepath')).''.str_replace("/", '\/', $expression),
            'function'=> $function
        ));
    }

    /**
     * Default 404 route
     * @param $function will be executed by triggering 404 route
     */
    public static function add404($function){
        array_push(self::$routes404,$function);
    }

    /**
     * Start routing process, execute function which is matched by route
     */
    public static function start() {

        $route_found = false;

        foreach(self::$routes as $route) {


            // Regex start point
            $route['expression'] = "/^".$route['expression'];

            // Regex end point
            $route['expression'] = $route['expression']."$/";

            #echo $route['expression'].'<br />';

            if(preg_match($route['expression'],self::$path,$matches)) {
                call_user_func_array($route['function'], $matches);
                $route_found = true;
            }
        }

        if(!$route_found){
            foreach(self::$routes404 as $route404){
                call_user_func_array($route404, Array(self::$path));
            }
        }
    }
}
?>
