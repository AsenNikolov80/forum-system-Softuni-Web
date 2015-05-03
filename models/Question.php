<?php

namespace Models;

class Question extends Main {

    function __construct() {
        parent::__construct(array('table' => 'questions'));
    }

    public function getUsername($userId) {
        $userId = intval($userId);
        $query = "SELECT username FROM users WHERE id=$userId";
        $result = $this->db->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $username = $row['username'];
            }
            return $username;
        }
        return FALSE;
    }

}
