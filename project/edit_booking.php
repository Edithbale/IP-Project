<?php 
// This page is for editing a Booking record.
// This page is accessed through view_bookings.php.]
session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	
}

$id = $_SESSION['user_id'];
$page_title = 'Edit a Booking';
include ('includes/header.php');
echo '<h1>Edit a Booking</h1>';

// Check for a valid Booking ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_booking.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	exit();
}

require ('mysqli_connect.php'); 

// Check for form submission:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		
        $errors = array(); // Initialize an error array.

        //validate occassion
        if (($_POST['occasion'] === 'select')){
            $errors[] = 'You forgot to select Occasion.';
        }
        else{
            $occ = trim($_POST['occasion']);
        }

        //validate event date
        if (empty(($_POST['e_date']))){
            $errors[] = 'Select valid date.';
        }
        else{
            $date = trim($_POST['e_date']);
        }

        //validate event time
        if (empty(($_POST))){
            $errors[] = 'Select valid time.';
        }
        else{
            $time = trim($_POST['e_time']);
        }

        //validate budget
        if (empty($_POST['e_budget'])) {
            $errors[] = 'You forgot to enter your budget.';
        } else {
            if(filter_var($_POST['e_budget'], FILTER_VALIDATE_INT) == false){
                $errors[] = 'Enter a valid budget value.';
            }
            else{
                $budget = trim($_POST['e_budget']);
            }
        }

        //validate pax
        if (empty($_POST['e_pax'])) {
            $errors[] = 'You forgot to enter the event pax.';
        } else {
            if(filter_var($_POST['e_pax'], FILTER_VALIDATE_INT) == false){
                $errors[] = 'Enter a valid pax value.';
            }
            else{
                $pax = trim($_POST['e_pax']);
            }
        }

        //validate address
        if (empty($_POST['e_address'])) {
            $errors[] = 'You forgot to enter your address.';
        } else {
            $address = trim($_POST['e_address']);
        }

        //submit location
        if (($_POST['location'] === 'select')){
            $errors[] = 'You forgot to select location.';
        }
        else{
            $location = trim($_POST['location']);
        }
        //validate contact name
        if (empty(($_POST['c_name']))){
            $errors[] = 'You forgot to enter contact name.';
        }
        else{
            $name = trim($_POST['c_name']);
        }
    
        //validate contact number
        if (empty(($_POST['c_number']))){
            $errors[] = 'You forgot to enter contact number.';
        }
        else{
            if(filter_var($_POST['c_number'], FILTER_VALIDATE_INT) == false){
                $errors[] = 'Enter a valid contact number.';
            }
            else{
                $phone = trim($_POST['c_number']);
            }
        }

        //validate company name
        if (empty(($_POST['company']))){
            $errors[] = 'You forgot to enter company name.';
        }
        else{
            $company = trim($_POST['company']);
        }

        // Check for an email address:
        if (empty($_POST['email'])) {
            $errors[] = 'You forgot to enter email address.';
        } else {
            $email = trim($_POST['email']);
        }

        //check special request and promo code
        if (!empty($_POST['special_req'])) {
            $special_req = trim($_POST['special_req']);
        }
        else{
            $special_req = null;
        } 

        if (!empty($_POST['promo'])) {
            $promo_code = trim($_POST['promo']);
        }
        else{
            @$promo_code = null;
        }

        //validate checkbox
	
	if (empty($errors)) { // If everything's OK.
	
			// Make the query:
			$q = "UPDATE booking SET occasion = '$occ', e_date = '$date', e_time = '$time', e_budget = $budget, e_pax = $pax, e_address = '$address', location = '$location', name = '$name', phone = '$phone', company = '$company', email = '$email', special_req = '$special_req', promo_code = '$promo_code' WHERE booking_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<script type="text/javascript">
                alert("The booking has been edited!");
                location="view_booking.php";
                </script>';
                
				
			} else { // If it did not run OK.
				echo '<p class="error">The booking could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
		
	} else { // Report the errors.

            echo '<script type="text/javascript">
                alert("' . implode('\n ', $errors) . '");
            </script>';

	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the Booking's information:
$q = "SELECT occasion, e_date, e_time, e_budget, e_pax, e_address, location, name, phone, company, email, special_req, promo_code FROM booking WHERE booking_id=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid Booking ID, show the form.

	// Get the Booking's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
        echo '<div class="container">
        <div class=" text-center mt-5 ">
            <h1 >Form</h1>   
        </div>
    <div class="row ">
        <div class="col">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class = "container">
                        <form action="edit_booking.php" id="event details" role="form" method="post">    
                            <div class="controls">
                                <div class="row">
                                    <h3>Event Details</h3>
                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="occasion">Occasion: </label>';
                                                
                                                $occasion = array (
                                                    'select' => 'Select Occasion...',
                                                    'Birthday' => 'Birthday', 
                                                    'Party' =>'Party', 
                                                    'Banquet' =>'Banquet', 
                                                    'Weeding' =>'Weeding', 
                                                    'Buffet' =>'Buffet'
                                                );

                                                echo '<select class="form-select" name="occasion">'; 
                                                foreach ($occasion as $key => $value) {
                                                echo "<option value=\"$key\">$value</option>\n";
                                                }
                                                echo '</select>'; 
                                            echo'
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-6 my-3">
                                        <div class="form-group">
                                            <label for="e_date">Event Date: </label>
                                            <input  class ="form-control" type="date" name="e_date" value="' . $row[1] . '"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-3">
                                        <div class="form-group">
                                            <label for="e_time">Event Time: </label>
                                            <input class="form-control" type="time" name="e_time"value="' . $row[2] . '"/>
                                        </div>
                                    </div>
                                </div>
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="e_budget">Budget/Pax(RM): </label>
                                        <input  class ="form-control" placeholder="RM" type="text" name="e_budget" value="' . $row[3] . '"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="e_pax">Number of Pax: </label>
                                        <input  class ="form-control" type="text" name="e_pax" value="' . $row[4] . '"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <div class="form-group">
                                        <label for="form_message">Event Address:</label>
                                        <textarea id="form_message" name="e_address" class="form-control" placeholder="Write your message here." rows="4">';
                                        echo ($row[5]);
                                        echo'
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="location">Location: </label>';
                                                $location = array (
                                                    'select' => 'Select Location..',
                                                    'Kuala Lumpur' => 'Kuala Lumpur',
                                                    'Selangor' => 'Selangor'
                                                );

                                                echo '<select class="form-select" name="location">';
                                                foreach ($location as $key => $value) {
                                                echo "<option value=\"$key\">$value</option>\n";
                                                }
                                                echo '</select>'; 
                                            echo'
                                        </div>
                                    </div>

                                    <h3 class="my-3"> Contact Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="c_name">Contact Person: </label>
                                                <input  class ="form-control" type="text" name="c_name" value="' . $row[7] . '"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="c_number">Contact Number: </label>
                                                <input  class ="form-control" type="text" name="c_number" value="' . $row[8] . '"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="company">Company Name: </label>
                                                <input  class ="form-control" type="text" name="company" value="' . $row[9] . '"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email: </label>
                                                <input  class ="form-control" type="text" name="email" value="' . $row[10] . '"/>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="my-3">Other Details</h3>

                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="form_message">Special Request:</label>
                                            <textarea id="form_message" name="special_req" class="form-control" placeholder="Write your message here." rows="4">';
                                            echo ($row[11]);
                                            echo'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="promo">Promo Code: </label>
                                            <input  class ="form-control" type="text" name="promo" value="' . $row[12] . '"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">Subscribe to our newsletter for promotions and updates.</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 my-3">
                                        <input type="submit" class="btn btn-success btn-send  pt-2 btn-block" value="Submit" >
                                        <input type="hidden" name="id" value="' . $id . '" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
} else { // Not a valid Booking ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
include ('includes/footer.html');
?>