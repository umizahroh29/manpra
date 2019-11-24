<?php
include_once("config/database.php");

class GradeModel
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

    function check_grade($nim, $modul)
    {
        $query = "SELECT * FROM tb_grades WHERE nim = $nim AND modul_id = $modul";

        $ret = mysqli_query($this->connect, $query);

        if ($ret->num_rows > 0) {
            return false;
        }

        return true;
    }

    function get_grade_data()
    {
        $practicum_active = $_SESSION['user_practicum'];
        $nim = $_SESSION['user_nim'];

        $query = "SELECT
                        t1.modul_id,
                        t2.name AS modul_name,
                        t1.nim,
                        t3.name,
                        t1.pretest_score,
                        t1.journal_score,
                        t1.posttest_score
                    FROM
                        tb_grades t1
                    JOIN tb_moduls t2 ON
                        t1.modul_id = t2.id
                    JOIN tb_users t3 ON
                        t1.nim = t3.nim
                    WHERE
                        t1.practicum_id = $practicum_active AND t1.created_by = '$nim'";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['modul_id'] = $row['modul_id'];
                $data[$i]['modul_name'] = $row['modul_name'];
                $data[$i]['nim'] = $row['nim'];
                $data[$i]['name'] = $row['name'];
                $data[$i]['pretest_score'] = $row['pretest_score'];
                $data[$i]['journal_score'] = $row['journal_score'];
                $data[$i]['posttest_score'] = $row['posttest_score'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    function get_student_data()
    {
        $practicum_active = $_SESSION['user_practicum'];
        $query = "SELECT * FROM tb_users WHERE role = 'Student' AND activestatus = 'Aktif' AND practicum_active = $practicum_active";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['nim'] = $row['nim'];
                $data[$i]['name'] = $row['name'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    function get_module_data()
    {
        $practicum_active = $_SESSION['user_practicum'];

        $query = "SELECT * FROM tb_moduls WHERE practicum_id = $practicum_active AND status = 'ATSAC'";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['name'] = $row['name'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    function store($params)
    {
        $params['practicum_id'] = $_SESSION['user_practicum'];
        $params['assistant_code'] = $_SESSION['user_code'];
        $query = "INSERT INTO tb_grades(
                        practicum_id,
                        modul_id,
                        nim,
                        pretest_assistant_code,
                        pretest_score,
                        journal_assistant_code,
                        journal_score,
                        posttest_assistant_code,
                        posttest_score,
                        created_by,
                        created_at,
                        updated_by,
                        updated_at
                    )
                    VALUES(" . $params['practicum_id'] . ", 
                           " . $params['module'] . ", 
                           " . $params['nim'] . ", 
                           '" . $params['assistant_code'] . "', 
                           " . $params['pretest'] . ", 
                           '" . $params['assistant_code'] . "', 
                           " . $params['journal'] . ", 
                           '" . $params['assistant_code'] . "', 
                           " . $params['posttest'] . ", 
                           '" . $_SESSION['user_nim'] . "',
                           NOW(),
                           '" . $_SESSION['user_nim'] . "', 
                           NOW())";

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($params)
    {
        $query = "UPDATE tb_grades 
                     SET pretest_score = " . $params['pretest'] . ",
                         journal_score = " . $params['journal'] . ",
                         posttest_score = " . $params['posttest'] . ",
                         updated_by = '" . $_SESSION['user_nim'] . "',
                         updated_at = NOW()
                   WHERE nim = " . $params['nim'] . " AND modul_id = " . $params['module'];

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }
}