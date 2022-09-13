<?php

namespace app\models;

use core\Model;
use RedBeanPHP\R;

class User extends Model
{
    public function getAllUsers()
    {
        $res = R::findAll('names');
        $data = [];
        foreach ($res as $name) {
            $data[$name->id] = $name->name;
        }
        return $data;
    }

    public function getUserForId($id)
    {
        $user = R::findOne('names', 'id = ?', [$id]);
        return [
            'id' => $user->id,
            'name' => $user->name
        ];
    }
}