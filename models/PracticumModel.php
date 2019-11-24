<?php
include_once("config/database.php");

class PracticumModel
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->connect = connect();
        session_start();
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

    public function get_data_practicum($id)
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
                        t2.code = t1.lecturer_code
                   WHERE t1.id = $id";

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

            return $data[0];
        }

        return null;
    }

    public function get_detail_practicum($id)
    {
        $query = "SELECT * FROM tb_practicum_detail WHERE practicum_id = $id";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['practicum_id'] = $row['practicum_id'];
                $data[$i]['grade_component'] = $row['grade_component'];
                $data[$i]['grade_percentage'] = $row['grade_percentage'];
                $data[$i]['duration'] = $row['duration'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    public function get_modul_practicum($id)
    {
        $query = "SELECT * FROM tb_moduls WHERE practicum_id = $id AND status = 'ATSAC'";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['practicum_id'] = $row['practicum_id'];
                $data[$i]['name'] = $row['name'];
                $data[$i]['publish_date'] = $row['publish_date'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    public function get_data_lecturer()
    {
        $query = "SELECT
                        id,
                        code,
                        name
                    FROM
                        tb_users
                  WHERE role = 'Lecturer'";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['code'] = $row['code'];
                $data[$i]['name'] = $row['name'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    public function store($params)
    {
        $params['user_input'] = $_SESSION['user_nim'];

        $query = "INSERT INTO tb_practicums(name, lecturer_code, year, type, status, created_by, created_at, updated_by, updated_at)
                       VALUES ('" . $params['name'] . "', '" . $params['lecturer'] . "', " . $params['year'] . ", '" . $params['type'] . "', 'ATSAC', '" . $params['user_input'] . "', NOW(), '" . $params['user_input'] . "', NOW())";

        $ret = mysqli_query($this->connect, $query);
        if ($ret > 0) {
            $query = "SELECT MAX(id) as id FROM tb_practicums";
            $ret = mysqli_query($this->connect, $query);
            $fetch = mysqli_fetch_assoc($ret);

            $this->store_detail($params, $fetch['id']);
            $this->store_modules($params, $fetch['id']);

            return true;
        } else {
            return false;
        }
    }

    public function store_detail($params, $id)
    {
        $query = "INSERT INTO tb_practicum_detail(practicum_id, grade_component, grade_percentage, duration, created_by, created_at, updated_by, updated_at)
                           VALUES (" . $id . ", 'Tes Awal', " . $params['pretest_pct'] . ", " . $params['pretest_duration'] . ", '" . $params['user_input'] . "', NOW(), '" . $params['user_input'] . "', NOW()),
                                  (" . $id . ", 'Jurnal', " . $params['journal_pct'] . ", " . $params['journal_duration'] . ", '" . $params['user_input'] . "', NOW(), '" . $params['user_input'] . "', NOW()),
                                  (" . $id . ", 'Tes Akhir', " . $params['posttest_pct'] . ", " . $params['posttest_duration'] . ", '" . $params['user_input'] . "', NOW(), '" . $params['user_input'] . "', NOW())";

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function store_modules($params, $id)
    {
        $ret = 0;
        foreach ($params['module'] as $module) {
            $query = "INSERT INTO tb_moduls(practicum_id, name, status, created_by, created_at, updated_by, updated_at) 
                            VALUES(" . $id . ", '" . $module . "', 'ATSAC', '" . $params['user_input'] . "', NOW(), '" . $params['user_input'] . "', NOW())";
            $ret = mysqli_query($this->connect, $query);
        }

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($params)
    {
        $query = "UPDATE tb_practicums 
                     SET name = '" . $params['name'] . "', 
                         year = " . $params['year'] . ",
                         lecturer_code = '" . $params['lecturer'] . "', 
                         type = '" . $params['type'] . "', 
                         updated_by = '" . $_SESSION['user_nim'] . "', 
                         updated_at = NOW()
                   WHERE id = " . $params['id'];

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            $this->update_detail($params);
            $this->update_modules($params);
            return true;
        } else {
            return false;
        }
    }

    public function update_detail($params)
    {
        $query = "UPDATE tb_practicum_detail
                     SET grade_percentage = CASE grade_component 
                                                WHEN 'Tes Awal' THEN " . $params['pretest_pct'] . "
                                                WHEN 'Jurnal' THEN " . $params['journal_pct'] . "
                                                WHEN 'Tes Akhir' THEN " . $params['posttest_pct'] . "
                                             END, 
                         duration = CASE grade_component 
                                        WHEN 'Tes Awal' THEN " . $params['pretest_duration'] . "
                                        WHEN 'Jurnal' THEN " . $params['journal_duration'] . "
                                        WHEN 'Tes Akhir' THEN " . $params['posttest_duration'] . "
                                     END, 
                         updated_by = '" . $_SESSION['user_nim'] . "', 
                         updated_at = NOW()
                   WHERE id IN (" . $params['pretest_id'] . ", " . $params['journal_id'] . ", " . $params['posttest_id'] . ")";

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_modules($params)
    {
        $query = "DELETE FROM tb_moduls WHERE practicum_id = " . $params['id'];
        $ret = mysqli_query($this->connect, $query);

        $params['user_input'] = $_SESSION['user_nim'];

        $ret = $this->store_modules($params, $params['id']);

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deactivate($id)
    {
        $query = "UPDATE tb_practicums SET status = 'ATSNA' WHERE id = " . $id;

        $ret = mysqli_query($this->connect, $query);
        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function activate($id)
    {
        $query = "UPDATE tb_practicums SET status = 'ATSAC' WHERE id = " . $id;

        $ret = mysqli_query($this->connect, $query);
        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>