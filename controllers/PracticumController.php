<?php
include_once("models/PracticumModel.php");

class PracticumController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new PracticumModel();
    }

    /**
     * Displaying a listing of practicum
     *
     * @return void
     */
    public function index()
    {
        $practicum_data = $this->model->get_data_practicums();

        $_SESSION['practicum_data'] = $practicum_data;
        require_once('views/practicum/list.php');
    }

    /**
     * Show the form for creating a new practicum
     *
     * @return void
     */
    public function create()
    {
        $lecturer_data = $this->model->get_data_lecturer();

        $_SESSION['lecturer_data'] = $lecturer_data;
        require_once('views/practicum/add.php');
    }

    /**
     * Store a newly created practicum
     *
     * @return response
     */
    public function store()
    {
        $params = $_POST;

        $result = $this->model->store($params);
        if ($result) {
            echo "<script>Swal.fire({title: 'Praktikum Berhasil Ditambah', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'practicum'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Praktikum Gagal Ditambah', text: '', icon: 'error'}).then((result) => { if(result) { window.history.back(); } });</script>";
        }
    }

    /**
     * Display the specified practicum
     *
     * @return void
     */
    public function show()
    {
        $id = $_POST['practicum_id'];

        $lecturer_data = $this->model->get_data_lecturer();
        $practicum_data = $this->model->get_data_practicum($id);
        $practicum_detail = $this->model->get_detail_practicum($id);
        $practicum_modules = $this->model->get_modul_practicum($id);

        $_SESSION['lecturer_data'] = $lecturer_data;
        $_SESSION['practicum_data'] = $practicum_data;
        $_SESSION['practicum_detail'] = $practicum_detail;
        $_SESSION['practicum_modules'] = $practicum_modules;
        require_once('views/practicum/edit.php');
    }

    /**
     * Update the specified practicum
     *
     * @return response
     */
    public function update()
    {
        $params = $_POST;

        $result = $this->model->update($params);
        if ($result) {
            echo "<script>Swal.fire({title: 'Praktikum Berhasil Diubah', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'practicum'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Praktikum Gagal Diubah', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'practicum'; } });</script>";
        }
    }

    /**
     * Deactivate the specified practicum
     *
     * @return response
     */
    public function deactivate()
    {
        $id = $_POST['practicum_id'];

        $result = $this->model->deactivate($id);
        if ($result) {
            echo "<script>Swal.fire({title: 'Praktikum Berhasil Dinonaktifkan', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'practicum'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Praktikum Gagal Dinonaktifkan', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'practicum'; } });</script>";
        }
    }

    /**
     * Activate the specified practicum
     *
     * @return response
     */
    public function activate()
    {
        $id = $_POST['practicum_id'];

        $result = $this->model->activate($id);
        if ($result) {
            echo "<script>Swal.fire({title: 'Praktikum Berhasil Diaktifkan', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'practicum'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Praktikum Gagal Diaktifkan', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'practicum'; } });</script>";
        }
    }
}

?>
