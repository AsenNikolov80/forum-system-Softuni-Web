<?php

namespace Models;

class Main {

    protected $table;
    protected $limit;
    protected $db;

    public function __construct($args = array()) {
        $def = array(
            'limit' => 0
        );
        $args = array_merge($def, $args);
        if (!isset($args['table'])) {
            die('Table not defined');
        }

        extract($args);
        $this->table = $table;
        $this->limit = $limit;
        $this->db = \Lib\Database::getInstance()->getDb();
    }

    public function find($args = array()) {
        $def = array(
            'table' => $this->table,
            'limit' => $this->limit,
            'where' => '',
            'columns' => '*'
        );
        $res = array_merge($def, $args);
        extract($res);
        $query = "SELECT $columns FROM $table";
        if (!empty($where)) {
            $query.=" WHERE $where";
        }
        if (!empty($limit)) {
            $query.=" LIMIT $limit";
        }
        echo $query;
        $resultSet = $this->db->query($query);
        $results = [];
        if (!empty($resultSet) && $resultSet->num_rows > 0) {
            while ($row = $resultSet->fetch_assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }

    public function insert($args = array()) {
        $username = $args[0];
        $password = $args[1];
        $fullname = $args[2];
        $email = $args[3];
        $def = array(
            'table' => $this->table,
        );
        $res = array_merge($def, $args);
        extract($res);
        $query = "INSERT INTO {$table}(`username`,`password`,`fullname`,`email`) VALUES(?,?,?,?)";
        $stmt = $this->db->prepare($query);
//        if (!$stmt) {
//            echo $this->db->error;
//        }
        $stmt->bind_param('ssss', $username, $password, $fullname, $email);
        if ($stmt->execute()) {
            echo 'You have registered!';
        } else {
            echo 'Email or username alredy exists';
        }
    }

}
