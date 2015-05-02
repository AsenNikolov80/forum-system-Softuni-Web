<?php

namespace Models;

class Question extends Main {

    function __construct() {
        parent::__construct(array('table' => 'questions'));
    }

}
