<?php 
    
    include('includes/session.php');
    
    // If the session vars aren't set, try to set them with a cookie
    if (!isset($_SESSION['Owner_ID'])) 
    {
        if (isset($_COOKIE['Owner_ID'])) 
	{
            $_SESSION['Owner_ID'] = $_COOKIE['Owner_ID'];
        }
    }

    //create a variable to store session for the user that has logged in
    $sessionUser = $_SESSION['Owner_ID'];//this id will help in retrieving the pharmacy owned by the user
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Pharmacy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Hi <strong><?php echo $login_session ?></strong>!</p>
                    <h3 class="text-primary">View your pharmacies</h3>
                    <?php
                        //a query for selecting data from pharmacy table
                        $query = "SELECT Shop_ID, Shop_Name, Mobile_Number, Email_Address FROM pharmacy WHERE owner_OWNER_ID ='$sessionUser' ";

                        //store query in a variable
                        $result = mysql_query($query);

                        //check if the results are there
                        if($result) {
                            //get rows
                            while($row = mysql_fetch_assoc($result)) {
                            ?>    
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                  <h4 class="list-group-item-heading">
                                      <?php echo "{$row['Shop_Name']}"?>
                                  </h4>
                                  <p class="list-group-item-text">
                                      <?php echo "{$row['Mobile_Number']}"?>
                                  </p>
                                  <p class="list-group-item-text">
                                      <?php echo "{$row['Email_Address']}"?>
                                  </p>
                                </a>
                            </div>
                            <?php }
                        } else {
                            echo "<p>No Pharmacy can be found!</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>