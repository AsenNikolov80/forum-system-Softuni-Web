<?php

namespace Controllers;

class Question extends Main {

    private $categoryClass;
    private $userClass;

    function __construct() {
        parent::__construct($viewsDir = '/views/question/', $modelName = 'question');

        include_once ROOT_DIR . '/models/' . ucfirst('category') . '.php';
        $userClass = '\Models\\' . ucfirst('category');
        $this->categoryClass = new $userClass();

        include_once ROOT_DIR . '/models/' . ucfirst('user') . '.php';
        $categoryClass = '\Models\\' . ucfirst('user');
        $this->userClass = new $categoryClass();
    }

    public function all() {
        $this->checkUserLogin();
        $categories = $this->categoryClass->getCategories();
        $templateName = 'views/question/index.php';
        include_once $this->layout;
    }

    public function showQuestions($categoryId = 0) {
        $this->checkUserLogin();
        if ($categoryId) {
            $questions = $this->modelName->find(["where" => "categoryId=$categoryId"]);
        } else {
            $questions = $this->modelName->find();
        }
        foreach ($questions as $key => $question) {
            $questions[$key] = $this->getRelations($question);
        }
        include_once ROOT_DIR . '/views/elements/showQuestions.php';
    }

    public function view($questionId) {
        $this->checkUserLogin();
        $questionId = intval($questionId);
        
        $question = $this->modelName->find(['where' => 'id=' . $questionId]);
        $question = $question[0];
        $question = $this->getRelations($question);

        if ($question) {
            $templateName = 'views/question/view.php';
            $visits = $this->modelName->getVisits($questionId);
            $this->modelName->setVisits($visits, $questionId);
            $question['visits'] = $this->modelName->getVisits($questionId);
            $categories = $this->categoryClass->getCategories();
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
            $tags = preg_filter('/[^a-zA-Zа-яА-Я ,]*/', '', $_POST['tags']);
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
        $categories = $this->categoryClass->getCategories();
        $templateName = 'views/question/add.php';
        include_once $this->layout;
    }

    public function checkUserLogin() {
        if ($this->isLogged) {
            $this->layout = 'views/layouts/secure.php';
        }
    }

    private function getRelations($question) {
        $question['username'] = $this->userClass->getUsername($question['userId']);
        $question['categoryName'] = $this->categoryClass->getCategoryName($question['categoryId']);
        $question['visits'] = $this->modelName->getVisits($question['id']);
        return $question;
    }

}
