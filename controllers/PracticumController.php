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
        $data = $this->model->get_data_practicum();

        $_SESSION['practicum_data'] = $data;
        require_once('views/practicum/list.php');
    }

    /**
     * Show the form for creating a new practicum
     *
     * @return void
     */
    public function create()
    {
        require_once('views/practicum/add.php');
    }

    /**
     * Store a newly created practicum
     *
     * @return response
     */
    public function store()
    {

    }

    /**
     * Display the specified practicum
     *
     * @return void
     */
    public function show()
    {

    }

    /**
     * Update the specified practicum
     *
     * @return response
     */
    public function update()
    {

    }

    /**
     * Remove the specified practicum
     *
     * @return response
     */
    public function destroy()
    {

    }
}

?>
