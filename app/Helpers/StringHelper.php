<?php
/**
 * Created by PhpStorm.
 * User: fred-
 * Date: 18.04.2018
 * Time: 20:57
 */

namespace App\Helpers;


class StringHelper
{

    protected static $_instance;

    private function __construct() {

    }

    private function __clone() {

    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function createRandomString($length = 8, $chars = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') {
        $chars_length = (strlen($chars) - 1);

        $string = $chars{rand(0, $chars_length)};

        for ($i = 1; $i < $length; $i = strlen($string)) {
            $r = $chars{rand(0, $chars_length)};

            if ($r != $string{$i - 1})
                $string .= $r;
        }
        return $string;
    }
}