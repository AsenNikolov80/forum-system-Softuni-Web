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
            unset($_POST['edit']);
            $this->modelName->update($this->userLogged['id'],$_POST);     
            $this->updateUserData();
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
