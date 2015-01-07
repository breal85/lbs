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
    $sessionUser = $_SESSION['Owner_ID'];//this id will help in retrieving the owner ID
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Drug</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <header>
                        <h3 class="text-primary">Please add a drug:</h3>
                    </header>
                    <p id="error" class="bg-danger"></p>
                  <form name="drug_registration" method="post" action="includes/drug.php">
                        <div class="form-group">
                            <label for="drug_name">Drug Name</label>
                            <input name="drug_name" type="text" class="form-control" id="drug_name">
                        </div>
                        <div class="form-group">
                            <label for="drug_price">Drug Price</label>
                            <input name="drug_price" type="text" class="form-control" id="drug_price">
                        </div>
                        <div class="form-group">
                            <label for="drug_details">Drug Details</label>
                            <input name="drug_details" type="text" class="form-control" id="drug_details">
                        </div>
                        <div class="form-group">
                            <label for="drug_cat">Drug Category</label>
                            <?php
                                //a query for selecting data from pharmacy table
                                $pharmacy_query = "SELECT Category_ID, Category_Name FROM drugcat";

                                //store query in a variable
                                $pharmacy_result = mysql_query($pharmacy_query);

                                //check if the results are there
                                if($pharmacy_result) {
                                    //get rows
                                    ?>
                            <select name="drug_cat" class="form-control" id="drug_cat">
                                <?php while($row = mysql_fetch_assoc($pharmacy_result)) { ?>
                                    <option value="<?php echo "{$row['Category_ID']}"?>">
                                        <?php echo "{$row['Category_Name']}"?>
                                    </option> 
                            <?php } ?>
                            </select>
                        <?php    
                            } else {
                                echo "<p>No Pharmacy can be found!</p>";
                            }
                        ?>
			</div>
                      <div class="form-group">
                            <label for="pharmacy_name">Pharmacy Name</label>
                            <?php
                                //a query for selecting data from pharmacy table
                                $shop_query = "SELECT Shop_ID, Shop_Name FROM pharmacy WHERE owner_Owner_ID = '$sessionUser'";
                                //store query in a variable
                                $shop_result = mysql_query($shop_query);

                                //check if the results are there
                                if($shop_result) {
                                    //get rows
                                    ?>
                            <select name="pharmacy_name" class="form-control" id="drug_cat">
                                    <?php while($row = mysql_fetch_assoc($shop_result)) { ?>
                                    <option value="<?php echo "{$row['Shop_ID']}"?>">
                                        <?php echo "{$row['Shop_Name']}"?>
                                    </option> 
                            <?php } ?>
                            </select>
                        <?php    
                            } else {
                                echo "<p>No Pharmacy can be found!</p>";
                            }
                        ?>
			</div>
                        <button name="add_drug" type="submit" class="btn btn-primary">Register Drug</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>