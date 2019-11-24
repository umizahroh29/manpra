<?php
include_once("models/ImportModel.php");
include_once("vendor/excel_reader2.php");

class ImportController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new ImportModel();
    }

    public function index()
    {
        $user_data = $this->model->get_data_users();

        $_SESSION['user_data'] = $user_data;
        require_once('views/import/list.php');
    }

    public function create()
    {
        $practicum_data = $this->model->get_data_practicums();

        $_SESSION['practicum_data'] = $practicum_data;
        require_once('views/import/import.php');
    }

    public function import()
    {
        $params = $_POST;

        // upload file xls
        $date = new DateTime();
        $temp = explode('.', $_FILES['file']['name']);
        $filename = time() . '-' . basename($_FILES['file']['name']);
        $target = 'assets/files/uploads/' . $filename;
        move_uploaded_file($_FILES['file']['tmp_name'], $target);

        //give permission to file
        chmod($target, 0777);

        // get content file
        $data = new Spreadsheet_Excel_Reader($target, false);

        $count_rows = $data->rowcount($sheet_index = 0);
        $success_rows = 0;
        for ($i = 2; $i <= $count_rows; $i++) {
            // store data per column to variable
            $params['nim'] = $data->val($i, 1);
            $params['name'] = $data->val($i, 2);
            $params['code'] = $data->val($i, 3);
            $params['class'] = $data->val($i, 4);
            $params['role'] = $data->val($i, 5);

            $result = $this->model->store($params);
            if ($result) {
                $success_rows++;
            }
        }

        if ($success_rows > 0) {
            echo "<script>Swal.fire({title: 'Import Data Berhasil', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'import'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Import Data Gagal', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'import'; } });</script>";
        }
    }

    public function edit()
    {
        $id = $_POST['user_id'];

        $user_data = $this->model->get_data_user($id);

        $_SESSION['user_data'] = $user_data;
        require_once('views/import/edit-user.php');
    }

    public function update()
    {
        $params = $_POST;

        $result = $this->model->update($params);
        if ($result) {
            echo "<script>Swal.fire({title: 'Data User Berhasil Diubah', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'import-list'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Data User Gagal Diubah', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'import-list'; } });</script>";
        }
    }

    /**
     * Deactivate the specified practicum
     *
     * @return response
     */
    public function deactivate()
    {
        $id = $_POST['user_id'];

        $result = $this->model->deactivate($id);
        if ($result) {
            echo "<script>Swal.fire({title: 'User Berhasil Dinonaktifkan', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'import-list'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'User Gagal Dinonaktifkan', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'import-list'; } });</script>";
        }
    }

    /**
     * Activate the specified practicum
     *
     * @return response
     */
    public function activate()
    {
        $id = $_POST['user_id'];

        $result = $this->model->activate($id);
        if ($result) {
            echo "<script>Swal.fire({title: 'User Berhasil Diaktifkan', text: '', icon: 'success'}).then((result) => { if(result) { window.location = 'import-list'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'User Gagal Diaktifkan', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'import-list'; } });</script>";
        }
    }
}