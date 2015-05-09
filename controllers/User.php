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
            if ($_SESSION['token'] === $_POST['token']) {
                $this->modelName->register($_POST);
            } else {
                $_SESSION['errorMsg'] = 'Error occured! Try again please!';
            }
        }
        $_SESSION['token'] = hash('whirlpool', rand(-1000000, 1000000));
        $templateName = ROOT_DIR . $this->viewsDir . 'register.php';
        include_once $this->layout;
    }

    public function login() {
        $this->checkForLoggedUser();
        if (isset($_POST['login'])) {
            if ($_SESSION['token'] === $_POST['token']) {
                $this->modelName->login($_POST);
            } else {
                $_SESSION['errorMsg'] = 'Error occured! Try again please!';
            }
        }
        $_SESSION['token'] = hash('whirlpool', rand(-1000000, 1000000));
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
