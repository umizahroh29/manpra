<?php
session_start();

$name = (isset($_SESSION['name'])) ? $_SESSION['name'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Praktikum</title>

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
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-folder fa-lg"></i>
                    <span class="pl-2">Praktikum</span>
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Tambah Praktikum</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="far fa-file fa-lg"></i>
                            <span class="pl-2">Daftar Praktikum</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Page Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid" style="padding-left: 0px;">
                <button type="button" id="sidebarCollapse" class="btn">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars fa-md" style="color:#fff;"></i>
                    </span>
                </button>
            </div>
            <div class="collapse navbar-collapse text-body">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" role="button" style="color: white">
                            Hi, <?= $name ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link" role="button" style="color: white">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>