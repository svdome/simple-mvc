<?php

namespace core;
/*
 *Класс реестр (реализует паттерн Реестр для управления настройками фреймворка)
 */
class Registry
{
    use TSingleton;

    private static array $properties = [];

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
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