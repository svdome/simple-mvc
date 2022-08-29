<?php

namespace core;

class Router
{

    protected static array $routes = [];
    protected static array $currentRoute = [];

    public static function add($regexp, $route = []) {
        self::$routes[$regexp]=$route;
    }

    public static function getRoutes() : array
    {
        return self::$routes;
    }

    public static function getRoute() : array
    {
        return self::$currentRoute;
    }

    public static function dispatch($url)
    {
        echo $url;
        if(self::matchRoutes($url)) {
            $controller='app\controllers\\' . self::$currentRoute['admin_prefix'] . self::$currentRoute['controller'] . 'Controller';
            if(class_exists($controller)) {
                $controllerObject=new $controller(self::$currentRoute);
                $action= self::$currentRoute['action'] . 'Action';
                if(method_exists($controllerObject, )) {

                } else {
                    throw new \Exception("Метод {$controller}::{$action}");
                }
            }
        } else {
            throw new \Exception(("Страница не найдена"));
        }

        debug(self::getRoutes());
    }

    public static function matchRoutes($url) : bool
    {
        foreach (self::$routes as $pattern =>$route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $key =>$value) {
                    if(is_string($key)) {
                        $route[$key]=$value;
                    }
                }
                if (empty($route['action'])) {
                    $route['action']='index';
                }

                if(!isset($route['admin_prefix'])) {
                    $route['admin_prefix']='';
                } else {
                    $route['admin_prefix'] .= '\\';
                }
                $route['controller']=self::upperCamelCase($route['controller']);
                self::$currentRoute=$route;
                return true;
            }
        }
        return false;
    }

    protected static function upperCamelCase($name)
    {

        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name));
    }
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
}