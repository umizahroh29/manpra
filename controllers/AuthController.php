<?php
include_once("models/AuthModel.php");
include_once("controllers/Controller.php");

class AuthController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new AuthModel();
    }

    /**
     * Displaying form login
     *
     * @return void
     */
    public function index()
    {
//        echo "<script>swal(\"Hello world!\");</script>";
        require_once('views/auth/login.php');
    }

    public function login()
    {
        $params = $_POST;

        $result = $this->model->login($params);

        if ($result) {
            header('Location: dashboard');
        } else {
            header('Location: login');
        }
    }

    public function register()
    {
        require_once('views/auth/register.php');
    }

    public function register_process()
    {
        $params = $_POST;

        $result = $this->model->register($params);

        if ($result) {
            require_once('views/auth/login.php');
        } else {
            header('Location: register');
        }
    }
}

?>