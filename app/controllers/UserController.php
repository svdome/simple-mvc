<?php

namespace app\controllers;

use core\Controller;

class UserController extends Controller
{
    public function getallAction()
    {
        $res = R::findAll('names');
        $data =[];
        foreach ($res as $name) {
            $data[$name->id] = $name->name;
        }
        //debug($data);
        //die();
        $this->setData(['name'=>'Admin', 'birthdate'=>'08.06.1992']);
        $this->setMeta('Форма авторизации', 'Описание страницы формы авторизации', 'Форма, авторизация...');
    }
}