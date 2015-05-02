<?php

namespace Lib;

class Database {

    private static $db = null;

    private function __construct() {
        $host = DB_HOST;
        $user = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        $db = new \mysqli($host, $user, $password, $database);
        self::$db = $db;
        mysqli_set_charset($this->getDb(), 'UTF8');
    }

    public static function getInstance() {
        static $instance = null;
        if ($instance == null) {
            $instance = new static();
        }

        return $instance;
    }

    public static function getDb() {
        return self::$db;
    }

}
