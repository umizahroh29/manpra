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
    }

    public function get_data_practicum()
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
                        t2.nim = t1.lecturer_code";

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

                $i++;
            }

            return $data;
        }

        return null;
    }
}

?>