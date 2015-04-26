<?php

namespace Controllers;

class Main {

    protected $layout;
    protected $viewsDir;
    protected $modelName;
    protected $db;

//    $layout='../views/main/index.php'
    public function __construct($viewsDir = '/views/main/', $modelName = 'main') {
        $this->viewsDir = $viewsDir;
        $this->layout = ROOT_DIR . '/views/layouts/default.php';
        include_once ROOT_DIR . '/models/' . $modelName . '.php';
        $modelClass = '\Models\\' . ucfirst($modelName);
        $this->modelName = new $modelClass(array('table' => 'users'));
        $auth = \Lib\Auth::getInstance();
        $this->isLogged = $auth->isLogged();
        $this->userLogged = $auth->getUserData();
    }

    public function index() {
        $templateName = ROOT_DIR . $this->viewsDir . 'index.php';
        include_once $this->layout;
    }

}
