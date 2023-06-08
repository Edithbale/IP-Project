<?php 
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
include ('includes/header.php');

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

// Display the form:
?>
<div class="mt-5">
	<div class="mt-5">
		<div class="container">
			<h1>Login</h1>
			<form action="login.php" method="post">
			<div class="mb-3">
				<label for="email" class="form-label">Email address</label>
				<input type="email" class="form-control" id="email" name="email">
			</div>
				<div class="mb-3">
					<label for="pass" class="form-label">Password</label>
					<input type="password" class="form-control" id="pass" name="pass">
				</div>
				<button type="submit" class="btn btn-primary mb-5" value="login">Submit</button>
			</form>
		</div>
	</div>
</div>

<?php include ('includes/footer.html'); ?>

