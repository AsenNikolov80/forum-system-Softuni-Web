<?php
namespace Controllers;

class Question extends Main{
    function __construct() {
        parent::__construct($viewsDir = '/views/question/', $modelName = 'question');
    }

    public function all() {
        $questions=$this->modelName->find();
        var_dump($questions);
    }
}
