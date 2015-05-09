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

    public function showQuestions($categoryId = 0, $page = 1) {
        $this->checkUserLogin();
        $page = intval($page);
        if ($page < 0 || $page === NULL) {
            $page = 1;
        }
        $pageSize = PAGE_SIZE;
        $start = PAGE_SIZE * ($page - 1);
        if ($categoryId) {
            $questions = $this->modelName->find(["where" => "categoryId=$categoryId", "limit" => "$start, $pageSize"]);
        } else {
            $questions = $this->modelName->find(["limit" => "$start, $pageSize"]);
        }
        $pages = ceil($this->modelName->getPages($categoryId) / PAGE_SIZE);
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

            if ($_SESSION['token'] === $_POST['token']) {
                $title = $_POST['title'];
                $text = $_POST['text'];
                $category = intval($_POST['categoryId']);
                $tags = preg_filter('/[^a-zA-Zа-яА-Я ,]*/', '', $_POST['tags']);
                $userId = $this->userLogged['id'];
                $time = date('Y-m-d H:i:s');
                $args = ['title' => $title, 'text' => $text, 'categoryId' => $category,
                    'tags' => $tags, 'userId' => $userId, 'date' => $time];
                if ($category != 0 && !empty($title) && !empty($text) && !empty($category) && !empty($tags)) {
                    $result = $this->modelName->insert($args);
                    if ($result) {
                        echo 'Question is added';
                    } else {
                        echo 'Something is wrong! Try again!';
                    }
                } else {
                    $_SESSION['errorMsg'] = 'All fields are required!';
                }
            } else {
                $_SESSION['errorMsg'] = 'Error occured! Try again please!';
                $_SESSION['token'] = hash('whirlpool', rand(-1000000, 1000000));
            }
        }
        $categories = $this->categoryClass->getCategories();
        $templateName = 'views/question/add.php';
        include_once $this->layout;
    }

    public function edit($questionId) {
        $this->checkUserLogin();
        $questionId = intval($questionId);
        if (isset($_POST['edit'])) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $category = intval($_POST['categoryId']);
            $tags = preg_filter('/[^a-zA-Zа-яА-Я ,]*/', '', $_POST['tags']);
            $time = date('Y-m-d H:i:s');
            $args = ['title' => $title, 'text' => $text, 'categoryId' => $category,
                'tags' => $tags, 'date' => $time];
            if ($category != 0 && !empty($title) && !empty($text) && !empty($category) && !empty($tags)) {
                $result = $this->modelName->update($questionId, $args);
            } else {
                $_SESSION['errorMsg'] = 'All fields are required!';
            }
            header('Location:' . ROOT_URL . 'question/view/' . $questionId);
            die;
        }
        
        $questionArr = $this->modelName->find(['where' => "id=$questionId"]);
        $question = $questionArr[0];
        $_SESSION['token'] = hash('whirlpool', rand(-1000000, 1000000));
        $categories = $this->categoryClass->getCategories();
        include_once ROOT_DIR . '/views/question/edit.php';
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
