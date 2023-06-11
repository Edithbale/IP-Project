<?php 
// This script retrieves all the records from the booking table.
// This new version links to edit and delete pages.
session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	
}

$id = $_SESSION['user_id'];

$page_title = 'View the Current Booking';
include ('includes/header.php');
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<title>Booking List</title>
</head>
<body>
	<div class="container">
		<h1 class="mt-5 pt-4 text-center">Booking List</h1>

		<?php
		require ('mysqli_connect.php');
		
		// Define the query:
		$q = "SELECT occasion, DATE_FORMAT(e_date, '%M %d, %Y') AS date, e_time , e_budget, e_pax, e_address, location, booking_id, name, phone, email, special_req, promo_code, company, newsletter_subscription, total_budget FROM booking";		
		$r = @mysqli_query ($dbc, $q);

		// Count the number of returned rows:
		$num = mysqli_num_rows($r);

		if ($num > 0) { // If it ran OK, display the records.

			// Print how many booking there are:
			echo '<p class="mt-5">There are currently ' . $num . ' booking(s).</p>';

			// Table header:
			echo '<table class="table table-hover table-bordered  table-sm mb-5">
				<thead class="table-info">
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Occasion</th>
						<th scope="col">Date</th>
						<th scope="col">Time</th>
						<th scope="col">Address</th>
						<th scope="col">Location</th>
						<th scope="col">Name</th>
						<th scope="col">Phone Number</th>
						<th scope="col">Email</th>
						<th scope="col">Special Request</th>
						<th scope="col">Promo</th>
						<th scope="col">Company</th>
						<th scope="col">Subscription</th>
						<th scope="col">Budget</th>
						<th scope="col">Pax</th>
						<th scope="col">Total Budget</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
				</thead>
				<tbody>';
			
			$bookingNumber = 1; // Initialize booking number
			
			// Fetch and print all the records:
			while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
				echo '
					<tr>
							<td scope="col">' . $bookingNumber . '</td>
							<td scope="col">' . $row['occasion'] . '</td>
							<td scope="col">' . $row['date'] . '</td>
							<td scope="col">' . $row['e_time'] . '</td>
							<td scope="col">' . $row['e_address'] . '</td>
							<td scope="col">' . $row['location'] . '</td>
							<td scope="col">' . $row['name'] . '</td>
							<td scope="col">' . $row['phone'] . '</td>
							<td scope="col">' . $row['email'] . '</td>
							<td scope="col">' . $row['special_req'] . '</td>
							<td scope="col">' . $row['promo_code'] . '</td>
							<td scope="col">' . $row['company'] . '</td>
							<td scope="col">' . $row['newsletter_subscription'] . '</td>
							<td scope="col">' . $row['e_budget'] . '</td>
							<td scope="col">' . $row['e_pax'] . '</td>
							<td scope="col">' . $row['total_budget'] . '</td>
							<td scope="col"><a class="btn btn-primary" href="edit_booking.php?id=' . $row['booking_id'] . '">Edit</a></td>
							<td scope="col"><a class="btn btn-danger" href="delete_booking.php?id=' . $row['booking_id'] . '">Delete</a></td>
					</tr>';
				
				$bookingNumber++;
			}

			echo '</tbody></table>';
			mysqli_free_result ($r); // Free memory associated with $r	
		} else { // If no records were returned.
			echo '<p class="error">There are currently no booking.</p>';
		}

		mysqli_close($dbc); // Close database connection
		?>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
