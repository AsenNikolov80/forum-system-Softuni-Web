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
            'columns' => '*',
            'orderBy' => 'id desc'
        );
        $res = array_merge($def, $args);
//        print_r($res);die;
        extract($res);
        $query = "SELECT $columns FROM $table";
        if (!empty($where)) {
            $query.=" WHERE $where";
        }
        if (!empty($limit)) {
            $query.=" LIMIT $limit";
        }
        if (!empty($orderBy)) {
            $query.=" ORDER BY $orderBy";
        }
//        echo $query;die;
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
        // key is the column name
        foreach ($args as $key => $value) {
            $args[$key] = mysqli_real_escape_string($this->db, $value);
        }
        $def = array(
            'table' => $this->table,
        );
        $resultArray = array_merge($def, $args);
//        extract($res);
        $columns = [];
        $values = [];
        foreach ($resultArray as $key => $value) {
            if ($key != 'table') {
                $columns[] = '`' . $key . '`';
                $values[] = '\'' . $value . '\'';
            }
        }
        $columns = implode(',', $columns);
        $values = implode(',', $values);
        $query = "INSERT INTO {$resultArray['table']}($columns) VALUES($values)";
        $stmt = $this->db->query($query);

//        if (!$stmt) {
//            echo $this->db->error;
//        }
//        $stmt->bind_param('ssss', $username, $password, $fullname, $email);
        if ($this->db->error == '') {
            return true;
        } else {
            return FALSE;
        }
    }

    public function update($id, $args = array()) {

        $id = intval($id);
        $username = mysqli_real_escape_string($this->db, $args['username']);
        $fullname = mysqli_real_escape_string($this->db, $args['fullname']);
        $email = mysqli_real_escape_string($this->db, $args['email']);
        if (!$username && !$fullname && !$email) {
            return;
        }
        $setClause = array();
        if (!empty($username)) {
            $setClause[] = "`username`='$username'";
        }
        if (!empty($fullname)) {
            $setClause[] = "`fullname`='$fullname'";
        }
        if (!empty($email)) {
            $setClause[] = "`email`='$email'";
        }
        $setClause = implode(',', $setClause);
        $query = "UPDATE `users` SET $setClause WHERE `id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo 'Your profile was updated!';
            $updatedUser = $this->find(['where' => 'id=' . $id]);
            $auth = \Lib\Auth::getInstance();
            $auth->updateCurrentUser($updatedUser[0]);
        } else {
            echo $stmt->error;
            echo 'Something is wrong! Try again!';
        }
    }

}
