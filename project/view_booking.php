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
	 <html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	</head>
<?php
echo '<h1>Booking List</h1>';

require ('mysqli_connect.php');
		
// Define the query:
$q = "SELECT occasion, DATE_FORMAT(e_date, '%M %d, %Y') AS date, e_time , e_budget, e_pax, e_address, location, booking_id FROM booking ORDER BY date ASC";		
$r = @mysqli_query ($dbc, $q);

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.

	// Print how many booking there are:
	echo '<p class="mt-5">There are currently ' . $num . ' booking(s).</p>';

	// Table header:
	echo '<table class="table table-stripped" align="center" cellspacing="3" cellpadding="3" width="100%">
	<thead class="thead-dark">
		<tr>
			<td sccope="col" align="left"><b>Edit</b></td>
			<td sccope="col" align="left"><b>Delete</b></td>
			<td sccope="col" align="left"><b>Occassion</b></td>
			<td sccope="col" align="left"><b>Date</b></td>
			<td sccope="col" align="left"><b>Time</b></td>
			<td sccope="col" sccope="col" align="left"><b>Budget</b></td>
			<td sccope="col" align="left"><b>Pax</b></td>
			<td sccope="col" align="left"><b>Address</b></td>
			<td sccope="col" align="left"><b>Location</b></td>
		</tr>
	</thead>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr>
			<td sccope="col" align="left"><a href="edit_booking.php?id=' . $row['booking_id'] . '">Edit</a></td>
			<td sccope="col" align="left"><a href="delete_booking.php?id=' . $row['booking_id'] . '">Delete</a></td>
			<td sccope="col" align="left">' . $row['occasion'] . '</td>
			<td sccope="col" align="left">' . $row['date'] . '</td>
			<td sccope="col" align="left">' . $row['e_time'] . '</td>
			<td sccope="col" align="left">' . $row['e_budget'] . '</td>
			<td sccope="col" align="left">' . $row['e_pax'] . '</td>
			<td sccope="col" align="left">' . $row['e_address'] . '</td>
			<td sccope="col" align="left">' . $row['location'] . '</td>
		</tr>
		';
	}

	echo '</table>';
	mysqli_free_result ($r); // Free memory associated with $r	

} else { // If no records were returned.
	echo '<p class="error">There are currently no booking.</p>';
}

mysqli_close($dbc); // Close database connection
include ('includes/footer.html');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
