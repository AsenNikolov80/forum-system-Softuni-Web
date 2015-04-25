<?php

include_once './controllers/Main.php';

define('ROOT_DIR', dirname(__FILE__));
$requestArray = substr($_SERVER['REQUEST_URI'], strlen('forum-system-local/'));
$requestArray = explode('/', substr($requestArray, 1), 3);
$controller = 'main';
$action = 'index';
$params = array();
if (count($requestArray) > 1) {
    $controller = $requestArray[0];
    $action = $requestArray[1];
    if (isset($requestArray[2])) {
        $params = $requestArray[2];
    }
    include_once './controllers/' . $controller . '.php';
    
}

$controllerClass = '\Controllers\\' . ucfirst($controller);
$instance = new $controllerClass();
if (method_exists($instance, $action)) {
    call_user_func_array(array($instance, $action), array($params));
    
}
