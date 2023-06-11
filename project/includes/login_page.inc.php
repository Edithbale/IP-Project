<?php 
    // This page prints any errors associated with logging in
    // and it creates the entire login page, including the form.

    // Include the header:
    $page_title = 'Login';
    include ('includes/header.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php
                // Print any error messages, if they exist:
                if (isset($errors) && !empty($errors)) {
                    echo '<div class="alert alert-danger mt-5" role="alert">';
                    echo '<h1>Error!</h1>';
                    echo '<p class="error">The following error(s) occurred:</p>';
                    echo '<ul>';
                    foreach ($errors as $msg) {
                        echo "<li>$msg</li>";
                    }
                    echo '</ul>';
                    echo '<p>Please try again.</p>';
                    echo '</div>';
                }
            ?>

            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="card-title">Login</h1>
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ('includes/footer.html'); ?>
