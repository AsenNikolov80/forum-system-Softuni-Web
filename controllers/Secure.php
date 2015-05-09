<?php

namespace Controllers;

class Secure extends Main {

    function __construct($viewsDir = '/views/secure/', $modelName = 'user', $layout = '/views/layouts/secure.php') {
        parent::__construct($viewsDir, $modelName, $layout);
    }

    public function index() {
        $this->checkForLoggedUser(__FUNCTION__);
    }

    public function edit() {
        if (isset($_POST['edit'])) {
            if ($_SESSION['token'] === $_POST['token']) {
                unset($_POST['edit']);
                unset($_POST['token']);
                if (empty($_POST['username']) && empty($_POST['fullname']) && empty($_POST['email'])) {
                    $_SESSION['errorMsg'] = 'You must fill at least one field!';
                    $_SESSION['token'] = hash('whirlpool', rand(-1000000, 1000000));
                } else {
                    $this->modelName->update($this->userLogged['id'], $_POST);
                }
            } else {
                $_SESSION['errorMsg'] = 'Error occured! Try again please!';
                $_SESSION['token'] = hash('whirlpool', rand(-1000000, 1000000));
            }
        }
        $this->checkForLoggedUser(__FUNCTION__);
    }

    private function checkForLoggedUser($viewName) {
        if ($this->isLogged) {
            $templateName = ROOT_DIR . $this->viewsDir . $viewName . '.php';
            include_once $this->layout;
        } else {
            header('Location:' . ROOT_URL);
            die;
        }
    }

}
