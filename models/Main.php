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
//        print_r($args);
        $res = array_merge($def, $args);
        extract($res);
        $query = "SELECT $columns FROM $table";
        if (!empty($where)) {
            $query.=" WHERE $where";
        }
        if (!empty($orderBy)) {
            $query.=" ORDER BY $orderBy";
        }
        if (!empty($limit)) {
            $query.=" LIMIT $limit";
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
        $setClause = array();

        foreach ($args as $key => $value) {
            if ($value != '' && $value != null) {
                $value = mysqli_real_escape_string($this->db, $value);
                $setClause[] = "`$key`='$value'";
            }
        }
        $setClause = implode(',', $setClause);
        $query = "UPDATE `$this->table` SET $setClause WHERE `id`=?";
//        print_r($query);
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            
        } else {
            echo $stmt->error;
            echo 'Something is wrong! Try again!';
        }
    }

}
