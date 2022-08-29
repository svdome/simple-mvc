<?php


use core\App;

require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/functions.php';
require_once CONFIG . '/functions.php';

new App();

//var_dump(APP::$app->getProperties());

//echo $noarr['null'];
$test =[
    'test'=>22
];