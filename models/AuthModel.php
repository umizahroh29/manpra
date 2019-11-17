<?php
include_once("config/database.php");

class AuthModel
{
    public function __construct()
    {
        $this->connect = connect();
    }

    function login($params)
    {
        $query = "SELECT * FROM tb_users WHERE nim = " . $params['nim'] . " AND password = '" . hash('md5', $params['password']) . "'";
        $ret = mysqli_query($this->connect, $query);

        $data = mysqli_fetch_assoc($ret);

        session_start();
        if (!empty($data)) {
            $_SESSION['user_email'] = $data['email'];
            $_SESSION['user_name'] = $data['name'];
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['user_role'] = $data['role'];
            $_SESSION['user_code'] = $data['code'];
            $_SESSION['user_practicum'] = $data['practicum'];
            $_SESSION['user_nim'] = $data['nim'];

            return true;
        } else {
            $_SESSION['message'] = 'Wrong Password or Email!';

            return false;
        }
    }

    function register($params)
    {
        $query = "INSERT INTO tb_users(nim, code, email, password, name, class, role, created_by, updated_by) VALUES (" . $params['nim'] . ", '" . $params['code'] . "', '" . $params['email'] . "', '" . hash('md5', $params['password']) . "', '" . $params['name'] . "', '" . $params['class'] . "', 'ASSISTANT', " . $params['nim'] . ", " . $params['nim'] . ")";

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            return true;
        } else {
            $_SESSION['message'] = 'Register Failed';
            return false;
        }
    }
}

?>