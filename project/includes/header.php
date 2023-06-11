<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Log Book Page</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="aa1.css">
    <script src="/project/includes/index.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm bg-dark fixed-top p-2">
    <div class="container">
        <a class="navbar-brand" href="index.php">MakeBook</a>
        <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar4">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
		// Create a login/logout link:
		if (isset($_SESSION['user_id'])) { //successfully login
        $first_name = $_SESSION['first_name'];
		$user = "SELECT first_name from admin";?>
        <div class="collapse navbar-collapse" id="navbar4">
            <ul class="navbar-nav mr-auto pl-lg-4">
                <li class="nav-item px-lg-2 "> 
                    <a class="nav-link" href="index.php"> 
                        Home
                    </a>
                </li>
                <li class="nav-item px-lg-2">
                    <a class="nav-link" href="booking_form.php">
                        New Booking
                    </a>
                </li>
                <li class="nav-item px-lg-2"> 
                    <a class="nav-link" href="view_booking.php">
                        Booking List
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item float-right px-lg-2">
					<a class="nav-link bg-dark border border-primary rounded-pill" href="logout.php">
                        <b>Logout</b>
                    </a>
                </li>
            </ul>
            <h5 class="text-light bold pt-2">Login as <span class="badge text-bg-success"><?= $first_name ?></span></h5>
        </div>
        <?php } else { ?>
            <div class="collapse navbar-collapse" id="navbar4">
                <ul class="navbar-nav mr-auto pl-lg-4">
                    <li class="nav-item px-lg-2"> 
                        <a class="nav-link" href="index.php"> 
                            Home
                        </a>
                    </li>
                    <li class="nav-item px-lg-2">
                        <a class="nav-link" href="booking_form.php">
                            Enquire Now!
                        </a>
                    </li>
                    <li class="nav-item px-lg-2"> 
                        <a class="nav-link" href="login.php">
                            Admin Login
                        </a>
                    </li>
                    <li class="nav-item px-lg-2"> 
                        <a class="nav-link" href="register.php">
                            New Admin
                        </a>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>
</nav>


</body>
</html>