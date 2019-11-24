<?php
include_once("models/ScheduleModel.php");

class ScheduleController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new ScheduleModel();
    }

    /**
     * Displaying a listing of schedule
     *
     * @return void
     */
    public function index()
    {
        $schedule_data = $this->model->get_data_schedules();

        $_SESSION['schedule_data'] = $schedule_data;
        require_once('views/schedule/list.php');
    }

    /**
     * Show the form for creating a new schedule
     *
     * @return void
     */
    public function create()
    {
        $practicum_data = $this->model->get_data_practicum();

        $_SESSION['practicum_data'] = $practicum_data;
        require_once('views/schedule/add.php');
    }

    /**
     * Store a newly created schedule
     *
     * @return response
     */
    public function store()
    {
        $params = $_POST;
        $params['user_input'] = $_SESSION['user_nim'];

        $result = $this->model->store($params);
        if ($result) {
            echo "<script>Swal.fire({title: 'Jadwal Praktikum Berhasil Ditambah', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'schedule'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Jadwal Praktikum Gagal Ditambah', text: '', icon: 'error'}).then((result) => { if(result) { window.history.back(); } });</script>";
        }
    }

    /**
     * Display the specified schedule
     *
     * @return void
     */
    public function show()
    {
        $id = $_POST['schedule_id'];

        $practicum_data = $this->model->get_data_practicum();
        $schedule_data = $this->model->get_data_schedule($id);

        $_SESSION['practicum_data'] = $practicum_data;
        $_SESSION['schedule_data'] = $schedule_data;
        require_once('views/schedule/edit.php');
    }

    /**
     * Update the specified schedule
     *
     * @return response
     */
    public function update()
    {
        $params = $_POST;
        $params['user_input'] = $_SESSION['user_nim'];

        $result = $this->model->update($params);
        if ($result) {
            echo "<script>Swal.fire({title: 'Jadwal Praktikum Berhasil Diubah', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'schedule'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Jadwal Praktikum Gagal Diubah', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'schedule'; } });</script>";
        }
    }

    /**
     * Remove the specified schedule
     *
     * @return response
     */
    public function destroy()
    {
        $id = $_POST['schedule_id'];

        $result = $this->model->destroy($id);
        if ($result) {
            echo "<script>Swal.fire({title: 'Jadwal Praktikum Berhasil Dihapus', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'schedule'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Jadwal Praktikum Gagal Dihapus', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'schedule'; } });</script>";
        }
    }
}