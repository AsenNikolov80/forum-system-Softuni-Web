<?php

mb_internal_encoding('UTF8');

include_once './controllers/Main.php';
include_once './config/db.php';
include_once './lib/Database.php';
include_once './lib/Auth.php';
include_once './models/Main.php';

define('ROOT_DIR', dirname(__FILE__));
$root = explode('/', substr($_SERVER['REQUEST_URI'], 1));
define('ROOT_URL', '/' . $root[0] . '/');

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
    if (file_exists('./controllers/' . $controller . '.php')) {
        include_once './controllers/' . $controller . '.php';
    } else {
        header('Location:' . ROOT_URL);
        die;
    }
}
if (!preg_match('/[a-zA-Z0-9_]/', $controller)) {
    die("brutal");
}
$controllerClass = '\Controllers\\' . ucfirst($controller);
$instance = new $controllerClass();
if (method_exists($instance, $action)) {
    call_user_func_array(array($instance, $action), array($params));
} else {
    header('Location:' . ROOT_URL);
    die;
}

////function __autoload($className){
//    if(file_exists('controllers/'.$className.'.php')){
//        require_once 'controllers/'.$className.'.php';
//    }
//    if(file_exists('models/'.$className.'.php')){
//        require_once 'models/'.$className.'.php';
//    }
//}