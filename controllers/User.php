<?php

namespace Controllers;

class User extends Main {

    protected $layout;
    protected $viewsDir;
    protected $modelName;

    public function __construct($viewsDir = '/views/user/', $modelName = 'user') {
        parent::__construct($viewsDir = '/views/user/', $modelName = 'user');
    }

    public function register() {

        if (isset($_POST['register'])) {
            $this->modelName->register($_POST);
        }
        $templateName = ROOT_DIR . $this->viewsDir . 'register.php';
        include_once $this->layout;
    }

    public function login() {
//        var_dump($_POST);
//        var_dump($this->modelName->find());
        $templateName = ROOT_DIR . $this->viewsDir . 'login.php';
        include_once $this->layout;
    }

}
