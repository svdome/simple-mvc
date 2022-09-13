<?php

namespace app\controllers;

use core\Controller;

class UserController extends Controller
{
    public function getallAction()
    {
        $data = $this->model->getAllUsers();
        $this->setData($data);
        $this->setMeta('Форма авторизации','Описание страницы формы авторизации','Форма, авторизация...');
    }

    public function getoneAction()
    {
        $getParam = explode('=', $this->route['get_param']);
        $this->setData($this->model->getUserForId($getParam[1]));
        $this->setMeta('Форма авторизации','Описание страницы формы авторизации','Форма, авторизация...');
    }
}