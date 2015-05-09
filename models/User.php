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
            $_SESSION['errorMsg'] = 'All fields are required!';
        } else {
            if ($password !== $password2) {
                $_SESSION['errorMsg'] = 'Password must match!';
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 14]);
                $args = ['username' => $username, 'password' => $password,
                    'fullname' => $fullname, 'email' => $email];
                $result = $this->insert($args);
                if ($result) {
                    $_SESSION['errorMsg'] = 'You have registered!';
                } else {
                    $_SESSION['errorMsg'] = 'Something is wrong!';
                }
            }
        }
    }

    public function login($param = array()) {
        $username = mysqli_real_escape_string($this->db, $_POST['username']);
        $password = mysqli_real_escape_string($this->db, $_POST['password']);
        $args = ['where' => "`username`='$username'"];
        $result = $this->find($args);
        $passwordMatch = password_verify($password, $result[0]['password']);
        if (isset($result[0]) && $passwordMatch) {
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['username'] = $result[0]['username'];
            $_SESSION['email'] = $result[0]['email'];
            $this->id = $result[0]['id'];
            $_SESSION['fullname'] = $result[0]['fullname'];
            header('Location:' . ROOT_URL . 'secure/index');
            die;
        } else {
            $_SESSION['errorMsg'] = 'Invalid login details';
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

    public function update($id, $args) {
        parent::update($id, $args);
        $this->updateUserInfo($id);
    }

    public function updateUserInfo($id) {
        $updatedUser = $this->find(['where' => 'id=' . $id]);
        $auth = \Lib\Auth::getInstance();
        $auth->updateCurrentUser($updatedUser[0]);
        header('Location:' . ROOT_URL . 'secure/edit');
        die;
    }

    public function logout() {
        session_destroy();
        header('Location:' . ROOT_URL);
        die;
    }

}
