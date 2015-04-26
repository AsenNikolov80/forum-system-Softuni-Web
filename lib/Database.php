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
