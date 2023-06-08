<?php
    session_start(); // Start the session.
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    }

    $page_title = 'Booking Form';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $errors = array(); // Initialize an error array.

        //occassion
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
        if (($_POST['location'] == 'select')){
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
	
            //Submit the details in the database...
            
            require ('mysqli_connect.php'); // Connect to the db.
    
            // Make the query:
            $q = "INSERT INTO booking (occasion, e_date, e_time, e_budget, e_pax, e_address, location, name, phone, company, email, special_req, promo_code) VALUES ('$occ', '$date', '$time', '$budget', '$pax', '$address', '$location', '$name', '$phone', '$company', '$email', '$special_req', '$promo_code')";
            $r = mysqli_query($dbc, $q); // Run the query.

            if ($r) { // If it ran OK.
    
                //Confirmation page
                $in = array('$occ', '$date', '$time', '$budget', '$pax', '$address', '$location', '$name', '$phone', '$company', '$email', '$special_req', '$promo_code');
                echo' <script type="text/javascript">
                alert("Your booking success. Thank you.");
                location="bookingPreview.php";
                </script>';
    
            } else { // If it did not run OK.
        
                // Public message:
                echo '<h1>System Error</h1>
                <p class="error">Your booking attempt failed. Please try again later.</p>'; 
        
                // Debugging message:
                echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
                    
            } // End of if ($r) IF.
            
            mysqli_close($dbc); // Close the database connection.
            
            // Include the footer and quit the script:
            exit();
            
        }
        else { // Report the errors.

            if (!empty($errors)) {

                echo '<script type="text/javascript">
                    alert("' . implode('\n ', $errors) . '");
                </script>';
            
            }
        } // End of if (empty($errors)) IF.
    }
?>
<!doctype html>
    <?php
    $page_title = 'Booking Form';
    include ('includes/header.php');
    ?>

    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        </head>
<body>
    <div class="container mt-5 mb-5">
        <div class=" text-center mt-5 ">
            <h1 >Form</h1>   
        </div>
    <div class="row ">
        <div class="col">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class = "container">
                        <form action="booking_form.php" id="event details" role="form" method="post">    
                            <div class="controls">
                                <div class="row">
                                    <h3>Event Details</h3>
                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="occasion">Occasion: </label>
                                            <?php
                                                $occasion = array (

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
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-6 my-3">
                                        <div class="form-group">
                                            <label for="e_date">Event Date: </label>
                                            <input  class ="form-control" type="date" name="e_date" value="<?php if(isset($_POST['e_date'])) echo $_POST['e_date']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-3">
                                        <div class="form-group">
                                            <label for="e_time">Event Time: </label>
                                            <input class="form-control" type="time" name="e_time"value="<?php if(isset($_POST['e_time'])) echo $_POST['e_time']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="e_budget">Budget/Pax(RM): </label>
                                        <input  class ="form-control" placeholder="RM" type="text" name="e_budget" value="<?php if(isset($_POST['e_budget'])) echo $_POST['e_budget']; ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="e_pax">Number of Pax: </label>
                                        <input  class ="form-control" type="text" name="e_pax" value="<?php if(isset($_POST['e_pax'])) echo $_POST['e_pax']; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <div class="form-group">
                                        <label for="form_message">Event Address:</label>
                                        <textarea id="form_message" name="e_address" class="form-control" placeholder="Write your message here." rows="4" ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="location">Location: </label>
                                            <?php
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
                                            ?>
                                        </div>
                                    </div>

                                    <h3 class="my-3"> Contact Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="c_name">Contact Person: </label>
                                                <input  class ="form-control" type="text" name="c_name" value="<?php if(isset($_POST['c_name'])) echo $_POST['c_name']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="c_number">Contact Number: </label>
                                                <input  class ="form-control" type="text" name="c_number" value="<?php if(isset($_POST['c_number'])) echo $_POST['c_number']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="company">Company Name: </label>
                                                <input  class ="form-control" type="text" name="company" value="<?php if(isset($_POST['company'])) echo $_POST['company']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email: </label>
                                                <input  class ="form-control" type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="my-3">Other Details</h3>

                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="form_message">Special Request:</label>
                                            <textarea id="form_message" name="special_req" class="form-control" placeholder="Write your message here." rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="promo">Promo Code: </label>
                                            <input  class ="form-control" type="text" name="promo" value="<?php if(isset($_POST['promo'])) echo $_POST['promo']; ?>"/>
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
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
    <?php include ('includes/footer.html'); ?>
</html>
