<?php

class Autoloader {
    static public function toolLoader($className) {
        $filename = realpath(dirname(__FILE__)) . "/lib/tools/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    static public function sdkLoader($className) {
        $filename = realpath(dirname(__FILE__)) . "/lib/lyra-payment-form-sdk/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }else{
                echo "stringnooooooo";
            }
        }
        return FALSE;
    }

    static public function configLoader($className) {
        $filename = realpath(dirname(__FILE__)) . "/config/" . str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
spl_autoload_register('Autoloader::toolLoader');
spl_autoload_register('Autoloader::sdkLoader');
spl_autoload_register('Autoloader::configLoader');