<?php ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register Pharmacy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/map.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyCAZO7zj9pG9UQ9PGz1f7o7h4oYC2cwOKM&sensor=true"></script>
        <script src="js/map.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <header>
                        <p>Please register your pharmacy details:</p>
                    </header>
                    <p id="error" class="bg-danger"></p>
                  <form name="shop_registration" method="post" action="includes/pharmacy.php">
                        <div class="form-group">
                            <label for="pharmacy_name">Pharmacy Name</label>
                            <input name="pharmacy_name" type="text" class="form-control" id="pharmacy_name">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Business Mobile Number</label>
                            <input name="mobile" type="text" class="form-control" id="mobile">
                        </div>
                        <div class="form-group">
                            <label for="email_address">Email Address</label>
                            <input name="email_address" type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input name="latitude" type="text" class="form-control" id="latitude">
			</div>
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input name="longitude" type="text" class="form-control" id="longitude">
                        </div>
                        <button name="shop_registration" type="submit" class="btn btn-primary">Register Pharmacy</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

