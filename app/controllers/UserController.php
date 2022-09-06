<?php

namespace app\controllers;

use core\Controller;


class UserController extends Controller
{
    public function getallAction()
    {
        $data = $this->model->getAllUsers();
        $this->setData($data);
        $this->setMeta('Форма авторизации', 'Описание страницы формы авторизации', 'Форма, авторизация...');
    }
}