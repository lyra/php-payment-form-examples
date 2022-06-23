<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra PHP payment form example. See COPYING.md for license details.
 *
 * @author    Lyra Network <https://www.lyra.com>
 * @copyright Lyra Network
 * @license   http://www.apache.org/licenses/
 */

class Autoloader
{
    /**
     * @param $className
     * @return bool
     */
    static public function toolLoader($className)
    {
        $filename = implode(DIRECTORY_SEPARATOR,
            [realpath(__DIR__), 'lib', 'tools', str_replace("\\", '/', $className ) . '.php']);

        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $className
     * @return bool
     */
    static public function sdkLoader($className)
    {
        $filename = implode(DIRECTORY_SEPARATOR,
            [realpath(__DIR__), 'lib', 'lyra-payment-form-sdk', str_replace("\\", '/', $className) . '.php']);

        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $className
     * @return bool
     */
    static public function configLoader($className)
    {
        $filename = implode(DIRECTORY_SEPARATOR,
            [realpath(__DIR__), 'config', str_replace("\\", '/', $className) . '.php']);

        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return true;
            }
        }

        return false;
    }
}

spl_autoload_register('Autoloader::toolLoader');
spl_autoload_register('Autoloader::sdkLoader');
spl_autoload_register('Autoloader::configLoader');
