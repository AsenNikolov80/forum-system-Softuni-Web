<?php

namespace Controllers;

class User extends Main {

    protected $layout;
    protected $viewsDir;
    protected $modelName;

    public function __construct($viewsDir = '/views/user/', $modelName = 'user') {
        parent::__construct($viewsDir, $modelName);
    }

    public function register() {
        $this->checkForLoggedUser();
        if (isset($_POST['register'])) {
            $this->modelName->register($_POST);
        }
        $templateName = ROOT_DIR . $this->viewsDir . 'register.php';
        include_once $this->layout;
    }

    public function login() {
        $this->checkForLoggedUser();
        if (isset($_POST['login'])) {
            $this->modelName->login($_POST);
        }
        $templateName = ROOT_DIR . $this->viewsDir . 'login.php';
        include_once $this->layout;
    }

    public function logout() {
        $this->modelName->logout();
    }

    private function checkForLoggedUser() {
        if ($this->isLogged) {
            header('Location:' . ROOT_URL . 'secure/index');
            die;
        }
    }

}
