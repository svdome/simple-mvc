<?php

namespace app\controllers;

use core\Controller;

class FormController extends Controller
{
    public function authAction()
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