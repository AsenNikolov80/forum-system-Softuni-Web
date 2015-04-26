<?php
namespace Lib;
class Auth {

    private static $isLogged = false;
    private static $user = array();

    private function __construct() {
        session_set_cookie_params(1800, '/');
        session_start();
        if (!empty($_SESSION['username'])) {
            self::$isLogged = true;
            self::$user = ['id' => $_SESSION['id'],
                'username' => $_SESSION['username'],
                'email' => $_SESSION['email']];
        }
    }

    public static function getInstance() {
        static $instance = null;
        if ($instance == null) {
            $instance = new static();
        }

        return $instance;
    }

    public function isLogged() {
        return self::$isLogged;
    }

    public function getUserData() {
        return self::$user;
    }

}
