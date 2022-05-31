<?php
if (! class_exists('Logger', false)) {

    /**
     * Utility class for managing parameters checking, inetrnationalization, signature building and more.
     */
    class Logger
    {
        private static $instance = NULL;

        private $logfile = '';

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

        public static function instance()
        {
            if (! self::$instance) {
                self::$instance = new Logger;
            }

            return self::$instance;
        }
    }
}
