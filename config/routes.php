<?php

use core\Router;

Router::add('^admin/?$', ['controller'=> 'Main', 'action'=> 'index', 'admin_prefix'=>'admin']);
Router::add('^$', ['controller'=>'Main', 'action'=>'index']);
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?');