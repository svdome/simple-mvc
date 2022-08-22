<?php
define("DEBUG", true);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT. '/public');
define("APP", ROOT. '/app');
define("CORE", ROOT. '/vendor/core');
define("HELPERS", ROOT. '/tmp/');
define("CACHE", ROOT. '/tmp/cache');
define("LOGS", ROOT. '/tmp/logs');


require_once ROOT. '/vender/autoload.php';