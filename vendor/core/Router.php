<?php

namespace core;

/**
 * Класс маршрутизации
 */
class Router
{

    /**
     * таблица маршрутов(ключ-шаблон regexp, значение-массив добавляемого маршрута)
     * @var array
     */
    protected static array $routes = [];
    /**
     * текущий маршрут
     * @var array
     */
    protected static array $currentRoute = []; //текущий маршрут

    /**
     * Метод для добавления маршрутов в таблицу маршрутов
     * @param $regexp - шаблон регулярного выражения
     * @param $route - маршрут
     * @return void
     */
    public static function add($regexp, $route = []) {
        self::$routes[$regexp]= $route; //self- оперирование статическими свойствами вместо this  в динамических
    }

    /**
     * метод получения таблицы маршрутов
     * @return array
     */
    public static function getRoutes() : array //метод получения всех маршрутов. array-указания типа данных который возвращается
    {
        return self::$routes; //возврат таблицы маршрутов
    }

    /**
     * метод получения текущего маршрута
     * @return array
     */
    public static function getRoute() : array //метод по получению текущего маршрута
    {
        return self::$currentRoute;
    }


    /**
     * метод по отсечению запросов от get-параметров для избежания ошибок
     * @param $url
     * @return void
     */
    protected static function removeGetParams($url)
    {
        if($url) {
            $params = explode('&', $url, 2);
            if(false === str_contains($params[0], '=')) {
                return rtrim($params[0], '/');
            }
            return '';
        }
        return $url;
    }

    /**
     * метод для вызова нужного метода контроллера согласно таблицы маршрутов
     * @param $url - кусок адресной строки относительно корня проекта
     * @return void
     * @throws \Exception
     */
    public static function dispatch($url) // непосредственная маршрутизация
    {
        $url= self::removeGetParams($url);
        //echo $url;
        if(self::matchRoutes($url)) {
            $controller = 'app\controllers\\' . self::$currentRoute['admin_prefix'] . self::$currentRoute['controller'] . 'Controller';
            if(class_exists($controller)) {
                $controllerObject = new $controller(self::$currentRoute);
                $controllerObject->getModel();
                $action = self::$currentRoute['action'] . 'Action';
                if(method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new \Exception("Метод {$controller}::{$action} не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер {$controller} не найден", 404);
            }
        } else {
            throw new \Exception("Страница не найдена", 404);
        }

        //debug(self::getRoutes());
    }

    /**
     * метод для поиска совпадения url с таблицей маршрутов и перенаправления на соответствующий контроллер
     * @param $url - текущий запрос
     * @return bool
     */
    public static function matchRoutes($url) : bool
    {

        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if(is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if(!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::lowerCamelCase($route['action']);
                self::$currentRoute = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * метод для преведения строки к upperCamelCase
     * @param $name - строка
     * @return array|string|string[]
     */
    protected static function upperCamelCase($name)
    {
        //$test1 = str_replace('-', ' ', $name);
        //$test2 = ucwords($test1);
        //$test3 = str_replace(' ', '', $test2);
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * метод для преведения строки к lowerCamelCase
     * @param $name - строка
     * @return string
     */
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
 }
