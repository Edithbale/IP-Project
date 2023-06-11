<?php
// This page is for deleting a booking record.
// This page is accessed through view_bookings.php.

session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

    // Need the functions:
    require('includes/login_functions.inc.php');
    redirect_user();
}

$id = $_SESSION['user_id'];

$page_title = 'Delete a booking';
include('includes/header.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <?php
            // Check for a valid booking ID, through GET or POST:
            if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From view_bookings.php
                $id = $_GET['id'];
            } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Form submission.
                $id = $_POST['id'];
            } else { // No valid ID, kill the script.
                echo '<p class="error">This page has been accessed in error.</p>';
                include('includes/footer.html');
                exit();
            }

            require('mysqli_connect.php');

            // Check if the form has been submitted:
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($_POST['sure'] == 'Yes') { // Delete the record.

                    // Make the query:
                    $q = "DELETE FROM booking WHERE booking_id=$id LIMIT 1";
                    $r = @mysqli_query($dbc, $q);
                    if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

                        // Print a success message:
                        echo '<div class="card mt-5 alert alert-success">
                                <div class="card-body">
                                    <h5 class="card-title">Success</h5>
                                    <p class="card-text">The booking has been deleted.</p>
                                </div>
                              </div>';
                        echo '<script type="text/javascript">
                                setTimeout(function() {
                                    location="view_booking.php";
                                }, 2000);
                              </script>';

                    } else { // If the query did not run OK.
                        echo '<div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Error</h5>
                                    <p class="card-text">The booking could not be deleted due to a system error.</p>
                                    <p class="card-text">' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>
                                </div>
                              </div>'; // Public message.
                    }

                } else { // No confirmation of deletion.
                    echo '<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No Changes Made</h5>
                                <p class="card-text">No changes made to the booking.</p>
                            </div>
                          </div>';
                    echo '<script type="text/javascript">
                            setTimeout(function() {
                                location="view_booking.php";
                            }, 2000);
                          </script>';
                }

            } else { // Show the form.

                // Retrieve the booking's information:
                $q = "SELECT CONCAT(e_date, ', ', e_time), location, occasion FROM booking WHERE booking_id=$id";
                $r = @mysqli_query($dbc, $q);

                if (mysqli_num_rows($r) == 1) { // Valid booking ID, show the form.

                    // Get the booking's information:
                    $row = mysqli_fetch_array($r, MYSQLI_NUM);

                    // Display the record being deleted:
                    echo '<div class="card mt-5">
                            <div class="card-body">
                                <h5 class="card-title">Booking Details</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Time: ' . $row[0] . '</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Occasion: ' . $row[2] . '</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Location: ' . $row[1] . '</h6>
                                <p class="card-text">Are you sure you want to delete this booking?</p>
                                <form action="delete_booking.php" method="post">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sure" value="Yes" id="yesRadio" />
                                        <label class="form-check-label" for="yesRadio">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sure" value="No" id="noRadio" checked="checked" />
                                        <label class="form-check-label" for="noRadio">No</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <input type="hidden" name="id" value="' . $id . '" />
                                </form>
                            </div>
                          </div>';

                } else { // Not a valid booking ID.
                    echo '<div class="card mt-5">
                            <div class="card-body">
                                <h5 class="card-title">Error</h5>
                                <p class="card-text">This page has been accessed in error.</p>
                            </div>
                          </div>';
                }
            } // End of the main submission conditional.

            mysqli_close($dbc);
            ?>
        </div>
    </div>
</div>

<?php
include('includes/footer.html');
?>
