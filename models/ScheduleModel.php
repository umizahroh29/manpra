<?php
include_once("config/database.php");

class ScheduleModel
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

    public function get_data_schedules()
    {
        $query = "SELECT
                        t1.id,
                        t1.practicum_id,
                        t2.name AS practicum_name,
                        t1.day,
                        t1.time,
                        t1.duration,
                        t1.room
                    FROM
                        tb_schedules t1
                    JOIN tb_practicums t2 ON
                        t1.practicum_id = t2.id";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['practicum_id'] = $row['practicum_id'];
                $data[$i]['practicum_name'] = $row['practicum_name'];
                $data[$i]['day'] = $row['day'];
                $data[$i]['time'] = $row['time'];
                $data[$i]['duration'] = $row['duration'];
                $data[$i]['room'] = $row['room'];

                $i++;
            }

            return $data;
        }

        return null;
    }

    public function get_data_schedule($id)
    {
        $query = "SELECT
                        t1.id,
                        t1.practicum_id,
                        t2.name AS practicum_name,
                        t1.day,
                        t1.time,
                        t1.duration,
                        t1.room
                    FROM
                        tb_schedules t1
                    JOIN tb_practicums t2 ON
                        t1.practicum_id = t2.id
                   WHERE t1.id = $id";

        $ret = mysqli_query($this->connect, $query);

        $i = 0;
        if ($ret->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[$i]['no'] = ($i + 1);
                $data[$i]['id'] = $row['id'];
                $data[$i]['practicum_id'] = $row['practicum_id'];
                $data[$i]['practicum_name'] = $row['practicum_name'];
                $data[$i]['day'] = $row['day'];
                $data[$i]['time'] = $row['time'];
                $data[$i]['duration'] = $row['duration'];
                $data[$i]['room'] = $row['room'];

                $i++;
            }

            return $data[0];
        }

        return null;
    }

    public function get_data_practicum()
    {
        $query = "SELECT * FROM tb_practicums WHERE status = 'ATSAC'";

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

    public function store($params)
    {
        $ret = 0;
        for ($i = 0; $i < count($params['day']); $i++) {
            $query = "INSERT INTO tb_schedules(practicum_id, day, time, duration, room, created_by, created_at, updated_by, updated_at) 
                            VALUES(" . $params['practicum'][$i] . ", '" . $params['day'][$i] . "', '" . $params['time'][$i] . "', " . $params['duration'][$i] . ", '" . $params['room'][$i] . "', '" . $params['user_input'] . "', NOW(), '" . $params['user_input'] . "', NOW())";
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
        $query = "UPDATE tb_schedules 
                     SET day = '" . $params['day'] . "',
                         time = '" . $params['time'] . "', 
                         duration = " . $params['duration'] . ",
                         room = '" . $params['room'] . "', 
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

    public function destroy($id)
    {
        $query = "DELETE FROM tb_schedules WHERE id = $id";

        $ret = mysqli_query($this->connect, $query);

        if ($ret > 0) {
            return true;
        } else {
            return false;
        }
    }
}