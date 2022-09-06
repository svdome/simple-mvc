<?php

namespace app\models;

use core\Model;
use RedBeanPHP\R;

class User extends Model
{
    public function getAllUsers()
    {
        $res = R::findAll('names');
        $data =[];
        foreach ($res as $name) {
            $data[$name->id] = $name->name;
        }
        return $data;
    }
}