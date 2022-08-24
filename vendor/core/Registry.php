<?php

namespace core;
/*
*Класс реестр (реализует паттерн Реестр для управления настройками фреймворка)
*/
class Registry
{
    private static ?self $instance;

    private function __construct() {}

    public static function getInstance()
    {
        return self::$instance ?? new static();
    }

    private static array $properties =[];

    public function setProperty($name, $value)
    {
        self::$properties[$name]=$value;
    }

    public function getProperty($name)
    {
        return self::$properties[$name];
    }

    public function getProperties()
    {
        return self::$properties;
    }
}