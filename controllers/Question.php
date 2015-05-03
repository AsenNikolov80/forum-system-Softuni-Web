<?php

namespace Controllers;

class Question extends Main {

    function __construct() {
        parent::__construct($viewsDir = '/views/question/', $modelName = 'question');
    }

    public function all() {
        $this->checkUserLogin();
        $questions = $this->modelName->find(['orderBy' => 'date desc']);
        foreach ($questions as $key => $question) {
            $questions[$key] = $this->getRelations($question);
        }
        $templateName = 'views/question/index.php';
        include_once $this->layout;
    }

    public function view($id) {
        $this->checkUserLogin();
        $question = $this->modelName->find(['where' => 'id=' . $id]);
        $question = $question[0];
        $question = $this->getRelations($question);

        if ($question) {
            $templateName = 'views/question/view.php';
            include_once $this->layout;
        } else {
            header('Location:' . ROOT_URL . 'question/all');
            die;
        }
    }

    public function add() {
        $this->checkUserLogin();
        if (isset($_POST['add'])) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $category = $_POST['categoryId'];
            $tags = $_POST['tags'];
            $userId = $this->userLogged['id'];
            $time = date('Y-m-d H:i:s');
            $args = ['title' => $title, 'text' => $text, 'categoryId' => $category,
                'tags' => $tags, 'userId' => $userId, 'date' => $time];
            if (!empty($title) && !empty($text) && !empty($category) && !empty($tags)) {
                $result = $this->modelName->insert($args);
                if ($result) {
                    echo 'Question is added';
                } else {
                    echo 'Something is wrong! Try again!';
                }
            }
        }
        include_once ROOT_DIR . '/models/' . ucfirst('category') . '.php';
        $modelClass = '\Models\\' . ucfirst('category');
        $modelClass = new $modelClass();
        $categories = $modelClass->getCategories();
        $templateName = 'views/question/add.php';
        include_once $this->layout;
    }

    public function checkUserLogin() {
        if ($this->isLogged) {
            $this->layout = 'views/layouts/secure.php';
        }
    }

    private function getRelations($question) {
        $question['username'] = $this->modelName->getUsername($question['userId']);
        include_once ROOT_DIR . '/models/' . ucfirst('category') . '.php';
        $categoryClass = '\Models\\' . ucfirst('category');
        $categoryClass = new $categoryClass();
        $question['categoryName'] = $categoryClass->getCategoryName($question['categoryId']);
        return $question;
    }

}
