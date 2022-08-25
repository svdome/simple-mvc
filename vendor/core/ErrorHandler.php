<?php

namespace core;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            // Добавлять в отчет ошибки PHP
            error_reporting(-1);
        } else {
            // Выключение протоколирования ошибок
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']); //Исключения
        set_error_handler([$this, 'errorHandler']); // Отлов ошибок
        ob_start(); // Старт буферизации по фатальным ошибкам
        register_shutdown_function([$this, 'fatalErrorHandler']); // фатальная ошибка. пользователю показывать нельзя, нужна буферизация
    }

    public function exceptionHandler(\Throwable $e)
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this-> logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    private function logError($message = ' ', $file = ' ', $line = ' ')
    {
        file_put_contents (
            LOGS . '/error.log',
            '[' . date("l js \of F Y h:i:s A") . ']' . 'Ошибка: ' . $message . ' | Файл: ' . $file . ' | Строка ' . $line . "\n\n",
            FILE_APPEND
        );
    }

    // фатальная ошибка
    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if(!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean(); // заканчивается буферизация и очистка буфера обмена
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    // функция, выводящая ошибки на экран
    private function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        if($response == 0) {
            $response = 404;
        }
        // устанавливает код ответа сервера (для протокола HTTP)
        http_response_code($response);

        if ($response ==404 && !DEBUG) {
            require WWW . '/errors/404.php';
            die();
         }
        if (DEBUG) {
            require WWW . '/errors/development.php';
        } else {
            require WWW . '/errors/production.php';
        }
        die();
    }
}

//[1st january 2022 12:00:00 AM] Ошибка: нехватка памяти и т.д.(файл, строка,