<?php include('includes/session.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Welcome <strong><?php echo $login_session ?></strong>!</p>
                    <a href="registerPharmacy.html" name="regPharm" class="btn btn-primary btn-sm">Register Pharmacy</a><br><br>
                    <a href="viewPharmacy.php" name="viewPharm" class="btn btn-info btn-sm">View Pharmacy</a><br><br>
                    <a href="addDrug.php" name="addDrug" class="btn btn-info btn-sm">Add Drug</a><br><br>
                    <a href="includes/logout.php" name="logOut" class="btn btn-danger btn-sm">Log Out</a>
                </div>
            </div>
        </div>
    </body>
</html>