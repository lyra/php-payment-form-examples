<?php

class Autoloader
{
    /**
     * @param $className
     * @return bool
     */
    static public function toolLoader ($className)
    {
        $filename = implode(DIRECTORY_SEPARATOR,
                            [
                                realpath(__DIR__), 'lib', 'tools', str_replace("\\",
                                                                               '/',
                                                                               $className
                                  ) .
                                  '.php'
                            ]
        );
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * @param $className
     * @return bool
     */
    static public function sdkLoader ($className)
    {
        $filename = implode(DIRECTORY_SEPARATOR,
                            [
                                realpath(__DIR__), 'lib', 'lyra-payment-form-sdk', str_replace("\\",
                                                                                               '/',
                                                                                               $className
                                  ) .
                                  '.php'
                            ]
        );
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * @param $className
     * @return bool
     */
    static public function configLoader ($className)
    {
        $filename = implode(DIRECTORY_SEPARATOR,
                            [
                                realpath(__DIR__), 'config', str_replace("\\",
                                                                         '/',
                                                                         $className
                                  ) .
                                  '.php'
                            ]
        );
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