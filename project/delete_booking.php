<?php 
// This page is for deleting a booking record.
// This page is accessed through view_bookings.php.

session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	
}

$id = $_SESSION['user_id'];

$page_title = 'Delete a booking';
include ('includes/header.php');

// Check for a valid booking ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_bookings.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('includes/footer.html'); 
	exit();
}

require ('mysqli_connect.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$q = "DELETE FROM booking WHERE booking_id=$id LIMIT 1";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

			// Print a message:
			echo' <script type="text/javascript">
                alert("The booking has been deleted.");
                location="view_booking.php";
                </script>';
    

		} else { // If the query did not run OK.
			echo '<p class="error">The booking could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	
	} else { // No confirmation of deletion.
		echo' <script type="text/javascript">
                alert("No changes made.");
                location="view_booking.php";
                </script>';
    
	}

} else { // Show the form.

	// Retrieve the booking's information:
	$q = "SELECT CONCAT(e_date, ', ', e_time), location , occasion FROM booking WHERE booking_id=$id";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) { // Valid booking ID, show the form.

		// Get the booking's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// Display the record being deleted:
		echo "<h3>Time: $row[0]</h3>
                <h3>Occasion: $row[2]</h3>
                <h3>Location: $row[1]</h3>
		Are you sure you want to delete this booking?";
		
		// Create the form:
		echo '<form action="delete_booking.php" method="post">
	<input type="radio" name="sure" value="Yes" /> Yes 
	<input type="radio" name="sure" value="No" checked="checked" /> No
	<input type="submit" name="submit" value="Submit" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
	} else { // Not a valid booking ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.

mysqli_close($dbc);
		
include ('includes/footer.html');
?>