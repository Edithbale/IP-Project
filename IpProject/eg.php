<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $errors =array(); //Initialize an error array

            if(empty($_POST['e_date'])){
                $errors[] = 'select valid date for the event!';
            }
            else{
                $e_date = trim($_POST['e_date']);
            }

            if (empty($_POST['e_budget'])) {
                $errors[] = 'Enter valid budget!';
            } else {
                $e_budget = trim($_POST['e_budget']);
            }
    }
    if(!empty($errors)) { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
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
    <div class="container">
        <div class=" text-center mt-5 ">
            <h1 >Form</h1>   
        </div>
    <div class="row ">
        <div class="col">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class = "container">
                        <form action="eg.php" id="event details" role="form" method="post">    
                            <div class="controls">
                                <div class="row">
                                    <h3>Event Details</h3>
                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="occasion">Occasion: </label>
                                            <?php
                                                $occasion = array (1 => 'Birthday', 'Party', 'Banquet', 'Weeding', 'Buffet');
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
                                <div class="col-md-6 input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <div class="form-group">
                                        <label for="form_message">Event Address:</label>
                                        <textarea id="form_message" name="e_address" class="form-control" placeholder="Write your message here." rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="location">Location: </label>
                                            <?php
                                                $location = array (1 => 'Select Location..', 'Kuala Lumpur', 'Selangor');
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
                                            <textarea id="form_message" name="e_address" class="form-control" placeholder="Write your message here." rows="4" required="required" data-error="Please, leave us a message."></textarea>
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
    </html>
<style>
    body {
    font-family: 'Lato', sans-serif;
}

h1 {
    margin-bottom: 40px;
}

label {
    color: #333;
}

.btn-send {
    font-weight: 300;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    width: 100%;
    margin-left: 3px;
    }
.help-block.with-errors {
    color: #ff5050;
    margin-top: 5px;

}

.card{
	margin-left: 10px;
	margin-right: 10px;
}
</style>