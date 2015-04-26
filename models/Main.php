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
        $resultSet = $this->db->query($query);
        $results = [];
        if (!empty($resultSet)) {
            while ($row = $resultSet->fetch->assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }

}
