<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra PHP payment form example. See COPYING.md for license details.
 *
 * @author    Lyra Network <https://www.lyra.com>
 * @copyright Lyra Network
 * @license   http://www.apache.org/licenses/
 */

if (! class_exists('Logger', false)) {
    /**
     * Utility class for managing parameters checking, internationalization, signature building and more.
     */
    class Logger
    {
        /**
         * @var Logger
         */
        private static $instance = NULL;

        /**
         * @var string
         */
        private $logfile = '';

        /**
         * @param $name
         * @param $value
         * @return void
         */
        public function __set($name, $value)
        {
            switch ($name) {
                case 'logfile':
                    $log_dir = dirname($value);
                    if (! is_dir($log_dir) && ! mkdir($log_dir)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $log_dir));
                    }

                    if (! file_exists($value)) {
                        clearstatcache();
                        if (! file_exists($value)) {
                            $h = fopen($value, 'w');
                            fclose($h);
                        }
                    }

                    if (! is_writeable($value)) {
                        new \Exception("$value is not a valid file path");
                    }

                    $this->logfile = $value;
                    break;

                default:
                    new \Exception("$name cannot be set");
            }
        }

        /**
         * @param $name
         * @return string
         * @throws Exception
         */
        public function __get($name)
        {
            switch ($name) {
                case 'logfile':
                    return $this->logfile;
                    break;

                default:
                    throw new \Exception("$name does not exist");
            }
        }

        /**
         * @param $message
         * @param $file
         * @param $line
         * @return false|int
         */
        public function write($message, $file = null, $line = null)
        {
            if (! empty($this->logfile)) {
                $message = date('Y-m-d H:i:s', time()) . ': ' . $message;
                $message .= is_null($file) ? '' : " in $file";
                $message .= is_null($line) ? '' : " on line $line";
                $message .= "\n";

                return file_put_contents($this->logfile, $message, FILE_APPEND);
            } else {
                return false;
            }
        }

        /**
         * @return Logger|null
         */
        public static function instance()
        {
            if (! self::$instance) {
                self::$instance = new Logger;
            }

            return self::$instance;
        }
    }
}
