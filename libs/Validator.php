<?php

/**
 * Created by PhpStorm.
 * User: Steffen
 * Date: 08.06.16
 * Time: 20:08
 */

/**
 * Class Validator
 * validates different types of information
 */
class Validator {

    /**
     * Check if all elements in $arr exist as a (non empty) post parameter
     * @param $arr
     * @return bool
     */
    public static function validatePost($arr) {
        foreach($arr as $a) {
            if(!isset($_POST[$a]) || empty($_POST[$a])) {
                return false;
            }
        }

        return true;
    }

}