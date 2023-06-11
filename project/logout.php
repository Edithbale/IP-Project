<?php
// This page lets the user logout.
// This version uses sessions.
session_start(); // Access the existing session.

// If no session variable exists, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	
	
} else { // Cancel the session:

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.

}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
include ('includes/header.php');

// Print a customized message:
echo '<div class="container d-flex justify-content-center mt-3 pt-5">
<div class="alert alert-success text-center" role="alert">
	<strong>Logout Successful!</strong> You have been logged out.
</div>
</div>';

include ('includes/footer.html');
?>