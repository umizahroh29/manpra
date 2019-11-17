<?php
session_start();

$name = (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : '';
$firstname = explode(' ', trim($name));
$firstname = $firstname[0];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Praktikum</title>

    <!-- Main Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">

    <!-- Main Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://kit.fontawesome.com/907e2f35a1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            Manajemen Praktikum
        </div>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#accountSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-folder fa-lg"></i>
                    <span class="pl-2">Manajemen Akun</span>
                </a>
                <ul class="collapse list-unstyled" id="accountSubmenu">
                    <li id="confirmation-account">
                        <a href="confirmation-account">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Konfirmasi Akun Asisten</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="#practicumSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-folder fa-lg"></i>
                    <span class="pl-2">Praktikum</span>
                </a>
                <ul class="collapse list-unstyled" id="practicumSubmenu">
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Tambah Praktikum</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Lihat Data Praktikum</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="#scheduleSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-folder fa-lg"></i>
                    <span class="pl-2">Jadwal Praktikum</span>
                </a>
                <ul class="collapse list-unstyled" id="scheduleSubmenu">
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Tambah Jadwal Praktikum</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Lihat Data Jadwal Praktikum</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="#importSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-folder fa-lg"></i>
                    <span class="pl-2">Import</span>
                </a>
                <ul class="collapse list-unstyled" id="importSubmenu">
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Import Data Praktikan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Import Data Asisten</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="#gradeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-folder fa-lg"></i>
                    <span class="pl-2">Nilai</span>
                </a>
                <ul class="collapse list-unstyled" id="gradeSubmenu">
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Input Nilai Praktikan</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Page Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg">
            <button type="button" id="sidebarCollapse" class="btn">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars fa-md" style="color:#fff;"></i>
                    </span>
            </button>
            <div class="collapse navbar-collapse text-body text-right">
                <ul class="navbar-nav ml-auto col-sm-3">
                    <li class="nav-item col-sm-8">
                        <a class="nav-link" role="button" style="color: white">
                            Hi, <?= $firstname ?>
                        </a>
                    </li>
                    <li class="nav-item col-sm-4">
                        <a href="logout" class="nav-link" role="button" style="color: white">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>