<?php

namespace Controllers;

class Main {

    protected $layout;
    protected $viewsDir;

//    $layout='../views/main/index.php'
    function __construct($viewsDir = '/views/main/') {
        $this->viewsDir = $viewsDir;
        $this->layout = ROOT_DIR . '/views/layouts/default.php';
    }

    public function index() {
        $templateName = ROOT_DIR . $this->viewsDir . 'index.php';
        
        include_once $this->layout;
        
    }

    public function test($param) {
        $templateName = ROOT_DIR . $this->viewsDir . 'test.php';
        include_once $this->layout;
    }

}
