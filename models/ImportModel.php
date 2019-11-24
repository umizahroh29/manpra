<?php
include_once("config/database.php");

class ImportModel
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->connect = connect();
    }

    public function get_data_users()
    {
        $query = "SELECT
                        t1.id,
                        t1.nim,
                        t1.code,
                        t1.email,
                        t1.name,
                        t1.class,
                        t1.role,
                        t1.activestatus,
                        t1.practicum_active AS practicum_id,
                        t2.name AS practicum_name
                    FROM
                        tb_users t1
                    JOIN tb_practicums t2 ON
                        t1.practicum_active = t2.id
                   WHERE t1.role IN ('Assistant', 'Student')";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['nim'] = $row['nim'];
                $data[$i]['code'] = $row['code'];
                $data[$i]['email'] = $row['email'];
                $data[$i]['name'] = $row['name'];
                $data[$i]['class'] = $row['class'];
                $data[$i]['role'] = $row['role'];
                $data[$i]['activestatus'] = $row['activestatus'];
                $data[$i]['practicum_id'] = $row['practicum_id'];
                $data[$i]['practicum_name'] = $row['practicum_name'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    public function get_data_user($id)
    {
        $query = "SELECT
                        t1.id,
                        t1.nim,
                        t1.code,
                        t1.email,
                        t1.name,
                        t1.class,
                        t1.role,
                        t1.activestatus,
                        t1.practicum_active AS practicum_id,
                        t2.name AS practicum_name
                    FROM
                        tb_users t1
                    JOIN tb_practicums t2 ON
                        t1.practicum_active = t2.id
                   WHERE t1.role IN ('Assistant', 'Student')
                     AND t1.id = $id";

        $ret = mysqli_query($this->connect, $query);

        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data['id'] = $row['id'];
                $data['nim'] = $row['nim'];
                $data['code'] = $row['code'];
                $data['email'] = $row['email'];
                $data['name'] = $row['name'];
                $data['class'] = $row['class'];
                $data['role'] = $row['role'];
                $data['activestatus'] = $row['activestatus'];
                $data['practicum_id'] = $row['practicum_id'];
                $data['practicum_name'] = $row['practicum_name'];
            }

            return $data;
        }

        return null;
    }

    public function get_data_practicums()
    {
        $query = "SELECT
                        t1.id,
                        t1.name,
                        t1.lecturer_code,
                        t2.name AS lecturer_name,
                        t1.year,
                        t1.type,
                        t1.status
                    FROM
                        tb_practicums t1
                    JOIN tb_users t2 ON
                        t2.code = t1.lecturer_code";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['name'] = $row['name'];
                $data[$i]['lecturer_code'] = $row['lecturer_code'];
                $data[$i]['lecturer_name'] = $row['lecturer_name'];
                $data[$i]['year'] = $row['year'];
                $data[$i]['type'] = $row['type'];
                $data[$i]['status'] = $row['status'];
                $data[$i]['status_name'] = ($row['status'] == 'ATSAC') ? 'Aktif' : 'Non Aktif';

                $i++;
            }

            return $data;
        }

        return null;
    }

    public function store($params)
    {
        $params['user_input'] = $_SESSION['user_nim'];

        $params['role'] = ($params['role'] == 1) ? 'Student' : 'Assistant';
        $params['code'] = ($params['code'] == '') ? 'NULL' : "'" .$params['code'] . "'";
        print_r('<pre>' . print_r($params, true) . '</pre>');

        $query = "INSERT INTO tb_users(nim, code, name, class, role, status, practicum_active, created_by, created_at, updated_by, updated_at)
                       VALUES (" . $params['nim'] . ", " . $params['code'] . ", '" . $params['name'] . "', '" . $params['class'] . "', '" . $params['role'] . "', 'Confirmed', " . $params['practicum_id'] . ", '" . $params['user_input'] . "', NOW(), '" . $params['user_input'] . "', NOW())";
        print_r($query);
        $ret = mysqli_query($this->connect, $query);
        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($params)
    {
        $query = "UPDATE tb_users 
                     SET name = '" . $params['name'] . "', 
                         class = '" . $params['class'] . "',
                         updated_by = '" . $_SESSION['user_nim'] . "', 
                         updated_at = NOW()
                   WHERE id = " . $params['id'];

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deactivate($id)
    {
        $query = "UPDATE tb_users SET activestatus = 'Non Aktif' WHERE id = " . $id;

        $ret = mysqli_query($this->connect, $query);
        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function activate($id)
    {
        $query = "UPDATE tb_users SET activestatus = 'Aktif' WHERE id = " . $id;

        $ret = mysqli_query($this->connect, $query);
        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }
}