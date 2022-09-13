<?php

namespace core;

use RedBeanPHP\R;

class DataBaseConnection
{
    use TSingleton;

    private function __construct() {
        $db = require_once CONFIG . '/config_db.php';
        R::setup( $db['dsn'], $db['user'], $db['password']);
        if (!R::testConnection()) {
            throw new \Exception('Fail connection to database', 500);
        }
        R::freeze(true);
        if (DEBUG) {
            R::debug( TRUE, 3 );
        }
    }
}