<?php

namespace app\controllers;

use core\Controller;

class MainController extends Controller
{
    public string $view = 'own';
    public function indexAction()
    {
        $this->setMeta('Стартовая страница','Описание страницы','Страница...');
    }
}