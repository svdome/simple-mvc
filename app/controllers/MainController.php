<?php

namespace app\controllers;

use core\Controller;

class MainController extends Controller
{
    public string $view = 'own';
    public function indexAction()
    {
        echo __METHOD__;
    }
}