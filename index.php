<?php
session_start();

date_default_timezone_set('Europe/Berlin');

require_once("Smarty/libs/Smarty.class.php");
require_once("libs/Core/Controller.php");

// load all classes / models
Controller::loadDirs(array("libs", "model"));

Config::set("config_dir", "config");
Config::loadConfigs();

// Init database connection
DB::initDB();

// init with route dir
Route::init(Config::get('route_dir'));


Controller::initSmarty();

Route::start();


?>
