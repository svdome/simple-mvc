<?php

namespace core;

/**
 * Класс для перехвата и обработки ошибок
 */
class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            // Добавлять в отчёт все ошибки PHP
            error_reporting(-1);
        } else {
            // Выключение протоколирования ошибок
            error_reporting(0);
        }
        // Задаём обработчик для не фатальных ошибок
        set_exception_handler([$this, 'exceptionHandler']);
        // Задаём обработчик для ошибок смешанного типа
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        // Задаём метод, который запустится при остановке скрипта
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    /**
     * Метод для обработки не фатальных ошибок
     * @param \Throwable $e
     * @return void
     */
    public function exceptionHandler(\Throwable $e) {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    /**
     * Метод для обработки ошибок смешанного типа
     * @param $errno - код ошибки
     * @param $errstr - сообщение ошибки
     * @param $errfile - файл в котором произошла ошибка
     * @param $errline - строка в которой произошла ошибка
     * @return void
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    /**
     * Метод для обработки фатальных ошибок
     * @return void
     */
    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'],  $error['line']);
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    /**
     * Метод для логирования ошибок
     * @param $message - сообщение ошибки
     * @param $file - файл в котором произошла ошибка
     * @param $line - строка в которой произошла ошибка
     * @return void
     */
    private function logError($message = '', $file = '', $line = '')
    {
        file_put_contents(
            LOGS . '/error.log',
            '[' . date('l jS \of F Y h:i:s A') . ']' . ' Ошибка: '
            . $message . ' | Файл: ' . $file . ' | Строка: ' . $line . "\n\n",
            FILE_APPEND
        );
    }

    /**
     * Метод для вывода на экран информации об ошибке
     * @param $errno - код ошибки
     * @param $errstr - сообщение ошибки
     * @param $errfile - файл в котором произошла ошибка
     * @param $errline - строка в которой произошла ошибка
     * @param $response - код ответа сервера
     * @return void
     */
    public function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        if ($response == 0) {
            $response = 404;
        }
        //Устанавливает код ответа сервера (для протокола HTTP)
        http_response_code($response);
        if ($response == 404 && !DEBUG) {
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