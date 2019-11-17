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
            if ($data['role'] == 'Assistant' and $data['status'] == 'Unconfirmed') {
                $_SESSION['message'] = '* Akun Belum Dikonfirmasi oleh Admin';
                return false;
            }

            $_SESSION['user_email'] = $data['email'];
            $_SESSION['user_name'] = $data['name'];
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['user_role'] = $data['role'];
            $_SESSION['user_code'] = $data['code'];
            $_SESSION['user_practicum'] = $data['practicum'];
            $_SESSION['user_nim'] = $data['nim'];

            return true;
        } else {
            $_SESSION['message'] = '* Email atau Password Salah';

            return false;
        }
    }

    function register($params)
    {
        $query = "INSERT INTO tb_users(nim, code, email, password, name, class, role, status, created_by, updated_by) VALUES (" . $params['nim'] . ", '" . $params['code'] . "', '" . $params['email'] . "', '" . hash('md5', $params['password']) . "', '" . $params['name'] . "', '" . $params['class'] . "', 'Assistant', 'Unconfirmed', " . $params['nim'] . ", " . $params['nim'] . ")";

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_unconfirmed_account()
    {
        $query = "SELECT * FROM tb_users WHERE role = 'Assistant'";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['code'] = $row['code'];
                $data[$i]['nim'] = $row['nim'];
                $data[$i]['name'] = $row['name'];
                $data[$i]['class'] = $row['class'];
                $data[$i]['email'] = $row['email'];
                $data[$i]['status'] = $row['status'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    public function confirmation_process($params)
    {
        $query = "UPDATE tb_users SET status = '". $params['status'] ."' WHERE id = " . $params['user_id'];

        $ret = mysqli_query($this->connect, $query);
        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>