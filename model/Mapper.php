<?php

/**
 * Created by PhpStorm.
 * User: steffen
 * Date: 31.01.17
 * Time: 21:55
 */
class Mapper {
    private $requestedPath;

    public function __construct($path) {
        $this->requestedPath = str_replace("/", "", $path);
    }

    public function invokeMapping() {
        $data = DB::getDB()->fetch_assoc("SELECT * FROM mapping WHERE mapping = ?", array($this->requestedPath));

        if(!$data) {
            Notify::addNotify("Route not found");
            Controller::$smarty->assign("errorMsg", "Ooops. This link does not have an original url");
        }
        else {
            Controller::setResponse(301);

            Controller::externRedirect($data['original']);
        }
    }

}