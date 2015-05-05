<?php

namespace Models;

class User extends Main {

    public function __construct() {
        parent::__construct(array('table' => 'users'));
    }

    public function register($param = array()) {
        $username = mysqli_real_escape_string($this->db, $_POST['username']);
        $fullname = mysqli_real_escape_string($this->db, $_POST['fullname']);
        $email = mysqli_real_escape_string($this->db, $_POST['email']);
        $password = mysqli_real_escape_string($this->db, $_POST['password']);
        $password2 = mysqli_real_escape_string($this->db, $_POST['password2']);
        if (empty($username) || empty($password) || empty($email) || empty($fullname)) {
            echo 'All fields are required!';
        } else {
            if ($password !== $password2) {
                echo 'Password must match!';
            } else {
                $args = ['username' => $username, 'password' => $password,
                    'fullname' => $fullname, 'email' => $email];
                $result = $this->insert($args);
                if($result){
                    echo 'You have registered!';
                }  else {
                    echo 'Something is wrong!';    
                }
            }
        }
    }

    public function login($param = array()) {
        $username = mysqli_real_escape_string($this->db, $_POST['username']);
        $password = mysqli_real_escape_string($this->db, $_POST['password']);
        $args = ['where' => "`username`='$username' AND `password`='$password'"];
        $result = $this->find($args);
        if (isset($result[0])) {
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['username'] = $result[0]['username'];
            $_SESSION['email'] = $result[0]['email'];
            $this->id = $result[0]['id'];
            $_SESSION['fullname'] = $result[0]['fullname'];
            header('Location:' . ROOT_URL . 'secure/index');
            die;
        } else {
            echo 'Invalid login';
        }
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
    
    public function logout() {
        session_destroy();
        header('Location:' . ROOT_URL);
        die;
    }

}
