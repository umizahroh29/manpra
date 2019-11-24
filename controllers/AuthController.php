<?php
include_once("models/AuthModel.php");
//include_once("controllers/Controller.php");

class AuthController
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
        if (!isset($_SESSION)) session_start();
        if (isset($_SESSION['user_id'])) {
            header('Location: dashboard');
        } else {
            require_once('views/auth/login.php');
        }
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

        if ($params['password'] != $params['confirm_password']) {
            echo "<script>Swal.fire({title: 'Gagal Registrasi', text: 'Password Tidak Sama', icon: 'error'}).then((result) => { if(result) { window.location = 'register'; } });</script>";
        }

        if ($result) {
            echo "<script>Swal.fire({title: 'Berhasil Registrasi', text: 'Silakan tunggu akun Anda dikonfirmasi oleh Admin melalui email', icon: 'success'}).then((result) => { if(result) { window.location = 'login'; } });</script>";
        } else {
            echo "<script>Swal.fire({title: 'Gagal Registrasi', text: '', icon: 'error'}).then((result) => { if(result) { window.location = 'register'; } });</script>";
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header('Location: login');
    }

    public function confirmation()
    {
        $data = $this->model->get_unconfirmed_account();

        $_SESSION['unconfirmed_data'] = $data;
        require_once('views/auth/confirmation-account.php');
    }

    public function confirmation_process()
    {
        $params = $_POST;

        $result = $this->model->confirmation_process($params);
        header('Location: confirmation-account');
    }

    public function check_nim()
    {
        $nim = $_POST['nim'];

        $result = $this->model->check_nim($nim);
        echo json_encode($result);
    }
}

?>