<?php

namespace app\controllers;

use core\Controller;

class FormController extends Controller
{
    public function authAction()
    {
        echo 'Это форма авторизации.';
        debag($this->route);
    }
}