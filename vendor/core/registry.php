<?php
class Registry
{
    privat static ?self $instance;
    privat function __construct() {

    }
    public static function getInstance()
    {
        if(self::$instance== null) {
            return new static();
        } else {
            self::$instance;
        }
    }
    private static array $properties =[];

    public function setProperty($name, $value)
    {
        self::$properties[$name]=$value;
    }
    public function getProperty($name)
    {
        return self::
    }
}