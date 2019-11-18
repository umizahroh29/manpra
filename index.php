<?php
//include_once("config/database.php");
include_once("controllers/AuthController.php");
include_once("controllers/PracticumController.php");

$request = $_SERVER['REQUEST_URI'];
$uriSegments = explode("/", parse_url($request, PHP_URL_PATH));
$numSegments = count($uriSegments);
$segment =  $uriSegments[$numSegments - 1];

$auth = new AuthController();
$practicum = new PracticumController();

switch ($segment) {
    case 'login' :
        $auth->index();
        break;
    case 'login-process' :
        $auth->login();
        break;
    case 'register' :
        $auth->register();
        break;
    case 'register-process' :
        $auth->register_process();
        break;
    case 'dashboard' :
        require_once('views/dashboard.php');
        break;
    case 'confirmation-account' :
        $auth->confirmation();
        break;
    case 'confirmation-process' :
        $auth->confirmation_process();
        break;
    case 'logout' :
        $auth->logout();
        break;
    case 'practicum' :
        $practicum->index();
        break;
    case 'practicum-add' :
        $practicum->create();
        break;
    case 'practicum-save' :
        $practicum->create();
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}

?>
