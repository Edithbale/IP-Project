<?php # Script 9.3 - register.php
// This script performs an INSERT query to add a record to the users table.


$page_title = 'Register';
include ('includes/header.php');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = trim($_POST['first_name']);
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = trim($_POST['last_name']);
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = trim($_POST['email']);
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = trim($_POST['pass1']);
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK. ($fn && $ln && $e)
	
		// Register the user in the database...
		
		require ('mysqli_connect.php'); // Connect to the db.

		// Make the query:
		$q = "INSERT INTO admin (first_name, last_name, email, password, registration_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.

			// Print a message:
			echo '
				<div class="d-flex justify-content-center mt-3 pt-5">
					<div class="alert alert-success text-center">
						<h1>Thank you!</h1>
						<p>You are now registered.</p>
						<p><a href="login.php" class="btn btn-primary">Login Now!</a></p>
					</div>
				</div>
			';	

		} else { // If it did not run OK.
	
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
	
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
				
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.
		
		// Include the footer and quit the script:
		include ('includes/footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

} // End of the main Submit conditional.
?>
	<div class="container mt-5 pt-4">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
				<h1 class="card-title pl-3 pt-3">Register</h1>
					<div class="card-body">
						<form action="register.php" method="post">
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input type="text" class="form-control" id="first_name" name="first_name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
							</div>
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="text" class="form-control" id="last_name" name="last_name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
							</div>
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="email" class="form-control" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
							</div>
							<div class="form-group">
								<label for="pass1">Password</label>
								<input type="password" class="form-control" id="pass1" name="pass1">
							</div>
							<div class="form-group">
								<label for="pass2">Confirm Password</label>
								<input type="password" class="form-control" id="pass2" name="pass2">
							</div>
							<button type="submit" class="btn btn-primary">Register</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php include ('includes/footer.html'); ?>