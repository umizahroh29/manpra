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

    <title>Register - ManPra</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
            border: 1px solid #ededeb;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 10px #f0f0ed;
            width: 50%;
        }

        .middle-container label {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="middle-container pt-5 pr-5 pl-5 pb-3">
    <h2 class="text-center">Register</h2>
    <h6 class="text-center">Manajemen Praktikum</h6>
    <hr>
    <form method="POST" action="register-process">
        <div class="invalid-message"><?= $msg ?></div>
        <div class="form-group">
            <label class="col-form-label">Name</label>
            <input type="text" name="name" id="name" value=""
                   class="form-control" required>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label class="col-form-label">NIM/NIP</label>
                <input type="number" name="nim" id="nim" maxlength="10" value=""
                       class="form-control" required>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label text-left">Email</label>
                <input type="email" name="email" id="email" value=""
                       class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label>Class</label>
                <input type="text" class="form-control" id="class" name="class">
            </div>
            <div class="form-group col-sm-6">
                <label>Assistant Code</label>
                <input type="text" class="form-control" maxlength="3" id="code" name="code">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label class="col-form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-12 text-center">
            <input type="submit" id="btnSubmit" class="btn btn-fill" value="Register">
        </div>
    </form>
</div>
</body>