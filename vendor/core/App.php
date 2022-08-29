<?php

namespace core;

class App
{
    public static $app;

    public function __construct()
    {
        $url = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        new ErrorHandler();
        self::$app = Registry::getInstance();
        $this->getParams();
        Router::dispatch($url);
    }

    public function getParams()
    {
        $params= require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                self::$app->setProperty($key, $value);
            }
        }
    }
}