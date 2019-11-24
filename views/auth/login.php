<?php
if (!isset($_SESSION)) session_start();

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
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

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
        <div class="mt-3 mb-3" id="user"></div>
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
        <div class="confirm-password"></div>
        <div class="col-sm-12">
            <input type="submit" id="btnSubmit" class="btn btn-fill" value="Login">
        </div>
    </form>

    <div class="mt-5">
        <small class="form-text text-muted">New Assistant? <a href="register">Create New Account</a></small>
    </div>
</div>
</body>
</html>

<script>
    $(function () {
        $('#nim').change(function () {
            var nim = $('#nim').val();

            $.ajax({
                type: 'POST',
                url: 'check-nim',
                data: {nim: nim},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#user').html('Hi, ' + response.name).fadeIn();
                    if (response.password == '' || response.password == null) {
                        var newElement = '';
                        newElement = newElement.concat('<div class="form-group row">');
                        newElement = newElement.concat('<label class="col-sm-4 col-form-label">Confirm Password</label>');
                        newElement = newElement.concat('<div class="col-sm-8">');
                        newElement = newElement.concat('<input type="password" name="confirm-password" id="confirm-password" class="form-control" required>');
                        newElement = newElement.concat('</div>');
                        newElement = newElement.concat('</div>');

                        $('.confirm-password').append(newElement);
                    }
                }
            });
        });
    });
</script>