<?php

namespace core;

/**
 * Класс контейнер приложения
 */
class App
{
    /**
     * статический контейнер для хранения экземпляра регистра
     * @var Registry
     */
    public static $app;

    public function __construct()
    {
        $url = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        new ErrorHandler();
        self::$app = Registry::getInstance();
        $this->getParams();
        Router::dispatch($url);
    }

    /**
     * Метод для заполнения свойства регистра (массив параметров)
     * @return void
     */
    public function getParams()
    {
        $params = require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                self::$app->setProperty($key, $value);
            }
        }
    }
}