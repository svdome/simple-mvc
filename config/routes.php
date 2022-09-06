<?php

use core\Router;

//от частного случая к общему

Router::add('^form/auth/?$', ['controller'=>'form', 'action'=>'auth']);
Router::add('^user/getall/?$', ['controller'=>'user', 'action'=>'getall']);
Router::add('^user/getone/?$', ['controller'=>'user', 'action'=>'getone']);
Router::add('^admin/?$', ['controller' => 'main', 'action' => 'index', 'admin_prefix' => 'admin']);
Router::add('^$', ['controller' => 'Main', 'action' => 'index']); //если пустая строка является началом вызова контроллера
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?');