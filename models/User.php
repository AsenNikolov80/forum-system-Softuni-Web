<?php

namespace Models;

class User extends Main {

    public function __construct() {
        parent::__construct(array('table' => 'users'));
    }

    public function register($param = []) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($username) || empty($password) || empty($email) || empty($fullname)) {
            echo 'All fields are required!';
        } else {
            if ($password !== $password2) {
                echo 'Password must match!';
            } else {
                $args = [$username, $password, $fullname, $email];
                $this->insert($args);
            }
        }
    }

    public function login($param = []) {
        
    }

}
