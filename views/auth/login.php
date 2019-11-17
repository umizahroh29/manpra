<?php
session_start();

$msg = isset($_SESSION['message']) ? $_SESSION['message'] : null;

session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - ManPra</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #595c63;
        }

        .middle-container {
            background-color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            border: 1px solid #ededeb;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 10px #f0f0ed;
            /*padding: 50px;*/
            width: 40%;
        }

        .middle-container label {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="middle-container pt-5 pr-5 pl-5 pb-3">
    <h2>Login</h2>
    <h6>Manajemen Praktikum</h6>
    <hr>
    <form method="POST" action="login-process">
        <div class="invalid-message"><?= $msg ?></div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" style="text-align: right;">NIM/NIP</label>
            <div class="col-sm-8">
                <input type="number" name="nim" id="nim" maxlength="10" value=""
                       class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-12">
            <input type="submit" id="btnSubmit" class="btn btn-fill" value="Login">
        </div>
    </form>

    <div class="mt-5">
        <small class="form-text text-muted">New Assistant? <a href="register">Create New Account</a></small>
    </div>
</div>
</body>