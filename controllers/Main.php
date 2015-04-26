<?php

namespace Controllers;

class Main {

    protected $layout;
    protected $viewsDir;
    protected $modelName;

//    $layout='../views/main/index.php'
    function __construct($viewsDir = '/views/main/', $modelName = 'main') {
        $this->viewsDir = $viewsDir;
        $this->layout = ROOT_DIR . '/views/layouts/default.php';
        include_once ROOT_DIR . '/models/' . $modelName . '.php';
        $modelClass = '\Models\\' . ucfirst($modelName);
        $this->modelName = new $modelClass(array('table'=>'users'));
    }

    public function index() {
//        var_dump($this->modelName);
        $templateName = ROOT_DIR . $this->viewsDir . 'index.php';
        include_once $this->layout;
    }

    public function register() {
        if (isset($_POST['register'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
            if ($password !== $password2) {
                echo 'Password must match!';
            } else {
                
            }
        }
        $templateName = ROOT_DIR . $this->viewsDir . 'register.php';
        include_once $this->layout;
    }

    public function login() {
        var_dump($_POST);
        $templateName = ROOT_DIR . $this->viewsDir . 'login.php';
        include_once $this->layout;
    }

}
