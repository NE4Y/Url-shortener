<?php
/**
 * Created by PhpStorm.
 * User: Steffen
 * Date: 20.05.16
 * Time: 14:50
 */
Route::add("/", function() {Controller::dispatch("home");});
Route::add404(function() {Controller::dispatch("reroute");});

?>