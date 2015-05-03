<?php

namespace Models;

class Category extends Main {

    function __construct() {
        parent::__construct(array('table' => 'categories'));
    }

    public function getCategories($args = array()) {
        $def = array(
            'columns' => '*',
            'where' => ''
        );
        $res = array_merge($def, $args);
        extract($res);
        $query = "SELECT $columns FROM `categories`";
        if ($where) {
            $query.=" WHERE $where";
        }
        $result = $this->db->query($query);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[$row['id']] = $row['name'];
        }
        return $categories;
    }

    public function getCategoryName($id) {
        $id = intval($id);
        $args = array(
            'where' => "id=$id"
        );
        $result = $this->getCategories($args);
        return $result[$id];
    }

}
