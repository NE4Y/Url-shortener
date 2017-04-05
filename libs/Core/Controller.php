<?php

/**
 * Handles the template-controller mapping
 * Author: Steffen Lindner
 */
class Controller {

    static $smarty;
    static $core_controller_dir = "controller/Core_controller";

    /**
     * Initialize smarty object
     */
    public static function initSmarty() {
        self::$smarty = new Smarty();
        self::$smarty->template_dir = "templates";

        self::loadCoreController();
    }

    /**
     * Dispatches the view
     * @param $tpl
     */
    public static function dispatch($tpl) {
        (empty($tpl)) ? $template = "home" : $template = $tpl;

        if(!self::$smarty->templateExists($template.".tpl")) {
            $template = "404";
        }

        // Load corresponding template-controller
        if(file_exists("controller/".$template."_controller.php")) {
            include("controller/" . $template . "_controller.php");
        }

        // get errors
        if(count(Notify::getNotify()) > 0) {
            self::$smarty->assign("notify", Notify::getNotify());
        }

        self::$smarty->display($template.".tpl");
    }

    /**
     * Load core controller who are not matched to a certain template
     */
    public static function loadCoreController() {
        foreach (glob(self::$core_controller_dir."/*.php") as $filename) {
            include($filename);
        }
    }

    /**
     * Load Ajaxcontroller by $name
     * @param $name String
     */
    public static function loadAjaxController($name) {
        if(file_exists("controller/ajaxController/".$name.".php")) {
            include("controller/ajaxController/".$name.".php");
        }

    }

    /**
     * Will redirect when user is not logged in
     */
    public static function needLogin() {
        if(!User::getUser()->isLoggedIn()) {
            self::redirect("/needLogin");
        }
    }

    /**
     * Will redirect when user has not enough rights
     * @param $rights Rights
     */
    public static function neededRights($rights) {
        if(User::getUser()->getTypeId() < $rights) {
            self::redirect("/noRights");
        }
    }

    /**
     * Redirects user towards $uri
     * Has to be implemented in a controller due to header output
     * @param $uri
     */
    public static function redirect($uri) {
        header('Location: .'.$uri);
    }

    /**
     * Redirects user towards $uri
     * Has to be implemented in a controller due to header output
     * @param $uri
     */
    public static function externRedirect($uri) {
        header('Location: '.$uri);
    }


    /**
     * Will load directory $dir recursiv
     * @param $dir
     */
    public static function loadDir($dir) {
        $scan = glob($dir."/*");

        foreach($scan as $path) {
            if (preg_match('/\.php$/', $path)) {
                require_once $path;
            }
            elseif (is_dir($path)) {
                self::loadDir($path);
            }
        }
    }

    /**
     * Load files in directory given by $arr
     * @param $arr Array with dir names to be loaded
     */
    public static function loadDirs($arr) {
        foreach($arr as $e) {
            self::loadDir($e);
        }
    }

    /**
     * Set http status code
     * @param $code
     */
    public static function setResponse($code) {
        http_response_code($code);
    }
}
?>
