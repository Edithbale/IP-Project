    <!doctype html>
    <?php
    $page_title = 'Booking Form';
    ?>

    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        </head>
        <body>
            <form class = "border mx-5 my-5 px-5" action="#">
                <p class="text-danger-emphasis fw-bold fs-2">Event Details</p>
                <div class="form-group container my-5">
                    <label for="occasion" class="fs-4">Occasion: </label>
                    <?php
                                    $occasion = array (1 => 'Birthday', 'Party', 'Banquet', 'Weeding', 'Buffet');
                                    echo '<select class="form-select" name="occasion">';
                                    foreach ($occasion as $key => $value) {
                                    echo "<option value=\"$key\">$value</option>\n";
                                    }
                                    echo '</select>'; 
                    ?>
                </div>
                <div class="form-group container my-2">
                    <label for="e_date" class="fs-4">Event Date: </label>
                    <input  class ="mx-4 col-3" type="date" name="e_date" value="<?php if(isset($_POST['e_date'])) echo $_POST['e_date']; ?>"/>
                    <label for="e_time" class="fs-4">Event Time: </label>
                    <input class="mx-4 col-3" type="time" name="e_time"value="<?php if(isset($_POST['e_time'])) echo $_POST['e_time']; ?>"/>
                </div>
                <div class="container my-5">
                    <div class="row">
                        <div class="col-6 ">
                            <div class="row">
                                <label for="e_date" class="fs-4">Budget/Pax: </label>
                                <input  class ="mx-4 col-xs-2" type="text" name="e_budget" value="<?php if(isset($_POST['e_budget'])) echo $_POST['e_budget']; ?>"/>
                            </div>
                            <div class="row">
                                <label for="e_date" class="fs-4">Number of Pax: </label>
                                <input  class ="mx-4 col-xs-2" type="text" name="e_pax" value="<?php if(isset($_POST['e_pax'])) echo $_POST['e_pax']; ?>"/>
                            </div>
                            <div class="row">
                                <label for="tot"class="fs-4">Total Budget: RM <? $total = $_POST['e_budget'] * $_POST['e_pax'];?></label>
                            </div>
                        </div>
                        <div class="col-6 my-2">
                            <label for="e_address" class="fs-4">Event Address</label>
                            <textarea class="form-control" id="e_address" rows="3"></textarea>
                            <div class="form-group container my-3">
                            <label for="location" class="fs-4">Location: </label>
                            <?php
                                            $location = array (1 => 'Select Location..','Kuala Lumpur', 'Selangor');
                                            echo '<select class="form-select" name="location">';
                                            foreach ($location as $key => $value) {
                                            echo "<option value=\"$key\">$value</option>\n";
                                            }
                                            echo '</select>'; 
                            ?>
                        </div>   
                        </div> 
                        
                    </div>   
                </div>
            </form>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        </body>
    </html>

