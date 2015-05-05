<?php

namespace Models;

class Question extends Main {

    function __construct() {
        parent::__construct(array('table' => 'questions'));
    }

    public function getVisits($id) {
        $id = intval($id);
        $selectQuery = "SELECT `visits` FROM `questions` WHERE `id`=$id";
        $result = $this->db->query($selectQuery);
        $visits = $result->fetch_assoc()['visits'];
        return $visits;
    }

    public function setVisits($visits, $viewId) {
        $visits = intval($visits);
        $query = "UPDATE `questions` SET `visits`=? WHERE `id`=?";
        $visits++;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $visits, $viewId);
        $stmt->execute();
    }

}
