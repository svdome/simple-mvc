<?php

use core\App;

require_once dirname(__DIR__) . '/config/init.php';

new App();
var_dump(APP::$app->getProperties());
