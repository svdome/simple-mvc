<?php

namespace core;

class APP
{
    public static $app;

    public function __construct()
    {
        self::$app = Registry::getInstance();
    }

    public function getParams()
    {
        $params= require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params)
        }
    }
}