<?php

namespace Controllers;

class Main {

    protected $layout;
    protected $viewsDir;
    protected $modelName;
    protected $db;
    protected $isLogged;
    protected $userLogged;

//    $layout='../views/main/index.php'
    public function __construct($viewsDir = '/views/main/', $modelName = 'main', $layout = '/views/layouts/default.php') {
        $this->viewsDir = $viewsDir;
        $this->layout = ROOT_DIR . $layout;
        include_once ROOT_DIR . '/models/' . ucfirst($modelName) . '.php';
        $modelClass = '\Models\\' . ucfirst($modelName);
        $this->modelName = new $modelClass(array('table' => 'users'));
        $auth = \Lib\Auth::getInstance();
        $this->isLogged = $auth->isLogged();
        $this->userLogged = $auth->getUserData();
    }

    public function index() {
        if($this->isLogged){
            $this->layout='views/layouts/secure.php';
            $this->viewsDir='/views/secure/';
        }
        header('Location:'.ROOT_URL.'question/all');die;
//        $templateName = ROOT_DIR . $this->viewsDir . 'index.php';
//        include_once $this->layout;
    }
}
