<?php

use core\Router;

Router::add('^admin/?$', ['controller' => 'main', 'action' => 'index', 'admin_prefix' => 'admin']);
Router::add('^$', ['controller' => 'Main', 'action' => 'index']); //если пустая строка является началом вызова контроллера
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?');