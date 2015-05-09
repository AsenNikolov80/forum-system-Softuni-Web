<?php

namespace Controllers;

class Answer extends Main {

    function __construct() {
        parent::__construct($viewsDir = '/views/answers/', $modelName = 'answer');
    }

    public function showAnswers($questionId) {
        $answers = $this->modelName->find(
                array('where' => "questionId=$questionId",
                    'columns' => "id, text, username, date",
                    'orderBy' => 'date'));
        include_once ROOT_DIR . '/views/elements/showAnswers.php';
    }

    public function addNew($questionId) {
        if (isset($_POST['addAnswer'])) {
            if ($_SESSION['token'] === $_POST['token']) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $text = $_POST['text'];
                if (empty($username) || empty($text)) {
                    $_SESSION['errorMsg']='Username or answer text cannot be empty';
                    header('Location:' . ROOT_URL . 'question/view/' . $questionId);
                    die;
                } else {
                    $time = date('Y-m-d H:i:s');
                    $args = array('username' => $username, 'text' => $text, 'email' => $email,
                        'questionId' => $questionId, 'date' => $time);
                    $this->modelName->insert($args);
                    header('Location:' . ROOT_URL . 'question/view/' . $questionId);
                    die;
                }
            } else {
                $_SESSION['errorMsg']='Error occured! Try again please!';
                $_SESSION['token'] = hash('whirlpool', rand(-1000000, 1000000));
                header('Location:' . ROOT_URL . 'question/view/' . $questionId);
                die;
            }
        }
        $_SESSION['token'] = hash('whirlpool', rand(-1000000, 1000000));
        include_once ROOT_DIR . '/views/answers/add.php';
    }
}
