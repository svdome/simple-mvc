<?php

namespace core;

/*
 * Класс реестр (реализуем паттерн Реестр для управления настройками фреймворка)
 */
class Registry
{
    use TSingleton;

    private static array $properties = [];

    /**
     * Сеттер для настроек
     * @param $name - ключ настройки
     * @param $value - значение настройки
     * @return void
     */
    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    /**
     * Геттер для настройки (по имени)
     * @param $name - ключ настройки
     * @return mixed
     */
    public function getProperty($name)
    {
        return self::$properties[$name];
    }

    /**
     * Геттер для получения всего массива настроек
     * @return array
     */
    public function getProperties()
    {
        return self::$properties;
    }
}