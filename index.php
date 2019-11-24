<?php
include_once("controllers/AuthController.php");
include_once("controllers/PracticumController.php");
include_once("controllers/ScheduleController.php");
include_once("controllers/ImportController.php");
include_once("controllers/GradeController.php");

$request = $_SERVER['REQUEST_URI'];
$uriSegments = explode("/", parse_url($request, PHP_URL_PATH));
$numSegments = count($uriSegments);
$segment = $uriSegments[$numSegments - 1];

$auth = new AuthController();
$practicum = new PracticumController();
$schedule = new ScheduleController();
$import = new ImportController();
$grade = new GradeController();

$role = (isset($_SESSION['user_role'])) ? $_SESSION['user_role'] : '';

switch ($segment) {
    case '' :
        $auth->index();
        break;
    case 'login' :
        $auth->index();
        break;
    case 'check-nim' :
        $auth->check_nim();
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
        if ($role == 'Admin') {
            $auth->confirmation();
        } else {
            http_response_code(404);
            require_once('views/404.php');
        }
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
        if ($role == 'Admin') {
            $practicum->create();
        } else {
            http_response_code(404);
            require_once('views/404.php');
        }
        break;
    case 'practicum-save' :
        $practicum->store();
        break;
    case 'practicum-edit' :
        if ($role == 'Admin') {
            $practicum->show();
        } else {
            http_response_code(404);
            require_once('views/404.php');
        }
        break;
    case 'practicum-update' :
        $practicum->update();
        break;
    case 'practicum-deactivate' :
        $practicum->deactivate();
        break;
    case 'practicum-activate' :
        $practicum->activate();
        break;
    case 'schedule' :
        $schedule->index();
        break;
    case 'schedule-add' :
        if ($role == 'Admin') {
            $schedule->create();
        } else {
            http_response_code(404);
            require_once('views/404.php');
        }
        break;
    case 'schedule-save' :
        $schedule->store();
        break;
    case 'schedule-edit' :
        if ($role == 'Admin') {
            $schedule->show();
        } else {
            http_response_code(404);
            require_once('views/404.php');
        }
        break;
    case 'schedule-update' :
        $schedule->update();
        break;
    case 'schedule-delete' :
        $schedule->destroy();
        break;
    case 'import' :
        if ($role == 'Admin') {
            $import->create();
        } else {
            http_response_code(404);
            require_once('views/404.php');
        }
        break;
    case 'import-save' :
        $import->import();
        break;
    case 'import-list' :
        $import->index();
        break;
    case 'user-edit' :
        if ($role == 'Admin') {
            $import->edit();
        } else {
            http_response_code(404);
            require_once('views/404.php');
        }
        break;
    case 'user-update' :
        $import->update();
        break;
    case 'user-activate' :
        $import->activate();
        break;
    case 'user-deactivate' :
        $import->deactivate();
        break;
    case 'grade' :
        $grade->index();
        break;
    case 'grade-save' :
        $grade->store();
        break;
    default:
        http_response_code(404);
        require_once('views/404.php');
        break;
}

?>
