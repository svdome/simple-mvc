<?php

namespace core;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            // Добавить в отчет ошибки PHP
            error_reporting(-1);
        } else {
            // выключение протоколирования ошибок
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function exceptionHandler(\Throwable $e) {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this-> logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    private function logError($message = '', $file = '', $line = '')
    {
        file_put_contents(
            LOGS . '/error.log',
            '[' . date("l js \of F Y h:i:s A") . ']' . 'Ошибка: ' . $message . ' |Файл: ' . $file . '|Строка'

        );
    }

    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if(!empty($error) && $error['type'] (E_ERROR | E_PARSE| E_COMPILE_ERROR| E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_;
        }
    }

    private function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        if($response == 0) {
            $response = 404;
        }
        http_response_code($response);
        if ($response ==404 && !DEBUG) {
            require WWW . '/errors/404.php';
            die();
         }
        if (DEBUG) {
            require WWW . '/errors/production.php';
        }
        die();
    }
}

//[1st juaniar 2022 12:00:00 AM] Ошибка: нехватка памяти |