<?php
include_once("models/GradeModel.php");

class GradeController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new GradeModel();
    }

    public function index()
    {
        $student_data = $this->model->get_student_data();
        $module_data = $this->model->get_module_data();
        $grade_data = $this->model->get_grade_data();

        $_SESSION['student_data'] = $student_data;
        $_SESSION['module_data'] = $module_data;
        $_SESSION['grade_data'] = $grade_data;
        require_once('views/grade/list.php');
    }

    public function store()
    {
        $params = $_POST;

        $check = $this->model->check_grade($params['nim'], $params['module']);

        if ($check) {
            $ret = $this->model->store($params);
        } else {
            $ret = $this->model->update($params);
        }

        $data = $this->model->get_grade_data();
        $result = ['data' => $data, 'status' => $ret];

        echo json_encode($result);
    }

}