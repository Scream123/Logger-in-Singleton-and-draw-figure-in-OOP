<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 19.09.2021
 * Time: 20:00
 */

/**
 * Создайте класс с именем Logger, реализуйте все необходимые методы для работы с логированием данных:
 * Обеспечьте возможность записи логов в файл
 * Обеспечьте возможность задания уровня логов (TRACE, DEBUG, INFO, WARN, ERROR, FATAL)
 * Файл с логами должен хранить следующую информацию (дата и время, сообщение, уровень), через разделитель  (по умолчанию точка с запятой).
 * Обработать все возможные исключительные ситуации
 * Продумать какие должны быть методы, параметры методов т.е. продумать структуру класса (Возможно это ряд классов… если это будет аргументированно)
 * Реализовать pattern singleton для этого класса, - аргументировать, если считаете что singleton не допустим для этого задания - аргументировать
 */
class Logger
{
    static private $_instance = null;
    static protected $file;
    static protected $path;
    static protected $level;
    static protected $stream;
    static protected $logfile_delete_days = 30;

    const TRACE = 256;
    const DEBUG = 100;
    const INFO = 200;
    const WARN = 300;
    const ERROR = 400;
    const FATAL = 500;

    /**
     * This is a static variable and not a constant to serve as an extension point for custom levels
     * @var string[] $levels Logging levels with the levels as key
     */
    protected static $levels = [
        self::TRACE => 'TRACE',
        self::DEBUG => 'DEBUG',
        self::INFO => 'INFO',
        self::WARN => 'WARN',
        self::ERROR => 'ERROR',
        self::FATAL => 'FATAL',
    ];

//the ability to call only from getInstance
    //  private function __construct($logfile_dir, $logfile)
    private function __construct($file, $level, $path)
    {
        self::$file = $file;
        self::$level = $level;

        self::$path = $path;

        self::start();

    }

    // disable cloning
    private function __clone()
    {

    }

    static function getInstance()
    {
        if (self::$_instance == null) {
            $path = $_SERVER['DOCUMENT_ROOT'] . "\logs" . DIRECTORY_SEPARATOR;
            $file = $path . "logs.log";

            self::$_instance = new Logger($file, self::TRACE, $path);
            self::log('Тестовая ошибка ', self::TRACE);
            self::start();
        }
        return self::$_instance;
    }

    protected static function trace($string)
    {

        return self::check_level(self::TRACE) ? true : self::log($string, self::$levels[self::TRACE]);
    }

    protected static function info($string)
    {

        return self::check_level(self::INFO) ? true : self::log($string, self::$levels[self::INFO]);
    }

    protected static function warn($string)
    {
        return self::check_level(self::WARN) ? true : self::log($string, self::$levels[self::WARN]);
    }

    protected static function debug($string)
    {
        return self::check_level(self::DEBUG) ? true : self::log($string, self::$levels[self::DEBUG]);
    }

    protected static function error($string)
    {
        return self::check_level(self::ERROR) ? true : self::log($string, self::$levels[self::ERROR]);
    }

    protected static function fatal($string)
    {
        return self::check_level(self::FATAL) ? true : self::log($string, self::FATAL);
    }

    protected static function clear()
    {
        self::close();
        self::open("w");
        self::close();
        self::open();
    }

    private static function check_level($level)
    {
        return self::$level < $level;
    }

    private static function log($string, $level)
    {

        switch ($level) {

            case self::TRACE:
                self::write("[" . date('m/d/Y h:i:s a', time()) . "];" . 'message =' . "$string" . ';' . 'error level: ' . self::$levels[self::TRACE] . '; ' . 'error code number' . $level . ";\n");

                break;

            case self::DEBUG:
                self::write("[" . date('m/d/Y h:i:s a', time()) . "];" . 'message =' . "$string" . ';' . 'error level: ' . self::$levels[self::DEBUG] . '; ' . 'error code number' . $level . ";\n");
                break;

            case self::INFO:
                self::write("[" . date('m/d/Y h:i:s a', time()) . "];" . 'message =' . "$string" . ';' . ';' . 'error level: ' . self::$levels[self::INFO] . '; ' . 'error code number' . $level . ";\n");

                break;
            case self::WARN:
                self::write("[" . date('m/d/Y h:i:s a', time()) . "];" . 'message =' . "$string" . ';' . 'error level: ' . self::$levels[self::WARN] . '; ' . 'error code number' . $level . ";\n");

                break;
            case self::ERROR:
                self::write("[" . date('m/d/Y h:i:s a', time()) . "];" . 'message =' . "$string" . ';' . 'error level: ' . self::$levels[self::ERROR] . '; ' . 'error code number' . $level . ";\n");

                break;
            case self::FATAL:
                self::write("[" . date('m/d/Y h:i:s a', time()) . "];" . 'message =' . "$string" . ';' . 'error level: ' . self::$levels[self::FATAL] . '; ' . 'error code number' . $level . ";\n");

                break;

            default:
                self::write("[" . date('m/d/Y h:i:s a', time()) . "];" . "UNKNOWN" . '; ' . 'message =' . "$string\n");

                break;
        }

        // delete any files older than 30 days
        $files = glob(self::$file . "*");
        $now = time();

        foreach ($files as $file)
            if (is_file($file))
                if ($now - filemtime($file) >= 60 * 60 * 24 * self::$logfile_delete_days)
                    unlink($file);
        return true;    // Don't execute PHP internal error handler
    }

    private static function write($string)
    {
        return fwrite(self::$stream, $string);
    }

    private static function start()
    {
        return self::open();
    }

    private static function open($mode = "a")
    {

        return self::$stream = fopen(self::$file, $mode) or die("Cannot write to file '" . self::$path . "', please ensure '" . self::$file . "' is writable.");
    }

    private static function close()
    {
        return fclose(self::$stream);
    }
}

//singleton object call
$config = Logger::getInstance();