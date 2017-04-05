<?php
/**
 * Created by PhpStorm.
 * User: steffen
 * Date: 31.01.17
 * Time: 21:22
 */

$mapper = new Mapper(Route::getRequestedPath());

$mapper->invokeMapping();
?>