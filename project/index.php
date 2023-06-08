<?php
	session_start(); // Start the session.
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    }

    $page_title = 'Home Page';
    include ('includes/header.php');
    ?>
<html>
    <main>
        <div class="intro">
            <h1> Catering Service </h1>
			<h3></h3>
            <button><a href="booking_form.php">Book Now</a></button>
        </div>
    </main>
	<?php
	include ('includes/footer.html');
	?>
</html>

<style>
    .intro {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 520px;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.5) 100%), url("https://wallpaperaccess.com/full/5600357.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .intro h1 {
      font-family: sans-serif;
      font-size: 60px;
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
      margin: 0;
    }

    .intro p {
      font-size: 20px;
      color: #d1d1d1;
      text-transform: uppercase;
      margin: 20px 0;
    }

    .intro button {
      background-color: #bebebe;
      color: #000;
      padding: 10px 25px;
      border: none;
      border-radius: 5px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.4)
    }
</style>

