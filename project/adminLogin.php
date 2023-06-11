<!doctype html>
<?php
$page_title = 'Admin Login';
include ('includes/header.php');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .wrapper {
            width: 360px;
            padding: 40px;
            margin: 0 auto;
        }
        #formContent {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        #formContent img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .underlineHover {
            color: #007bff;
        }
        .underlineHover:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="wrapper mt-4">
        <div id="formContent">
            <div class="text-center">
                <img src="img/icons8-admin-96.png" id="icon" alt="User Icon" class="mb-4">
            </div>
            <!-- Login Form -->
            <form action="login.php">
                <div class="mb-3">
                    <input type="text" id="login" class="form-control" name="login" placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="text-center">
                  <input type="submit" class="btn btn-primary" value="Log In">
                </div>
            </form>
            <div class="mt-3 text-center">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
