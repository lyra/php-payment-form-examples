<?php
class Translator
{
    private static $instance = NULL;

    private $translationfiles = array(
        'en' => '',
        'fr' => '',
        'de' => '',
        'es' => ''
    );

    private $language = '';
    private $translationfile = '';

    public function __set($name, $value)
    {
        switch ($name) {
            case '$language':
                $this->language = $value;
                if (!file_exists($this->translatefile[$value])) {
                    clearstatcache();
                    if (!file_exists($this->translatefile[$value])) {
                        new Exception("$value is not a valid file path");
                    }else{
                        $this->$translationfile = $this->$translationfiles[$value];
                    }
                }

                if (!is_readable($value)) {
                    new Exception("$value is not a valid file path");
                }
                $this->$translationfile = $value;
                break;

            default:
                new Exception("$name cannot be set");
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case '$translationfile':
                return $this->$translationfile;
                break;
            default:
                throw new Exception("$name does not exist");
        }
    }

    public function translate($message)
    {
        if (!empty($this->translatefile[$value])) {


            return file_put_contents($this->logfile, $message, FILE_APPEND);
        } else {
            return false;
        }
    }

    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new Translator;
        }

        return self::$instance;
    }
}

