<?php
    
    include('session.php');
    
    // If the session vars aren't set, try to set them with a cookie
    if (!isset($_SESSION['Owner_ID'])) 
    {
        if (isset($_COOKIE['Owner_ID'])) 
	{
            $_SESSION['Owner_ID'] = $_COOKIE['Owner_ID'];
        }
    }

    $sessionUser = $_SESSION['Owner_ID'];
    
    //register business details into the table that stores the pharmacy info
    //check if post array is empty
    $post = (!empty($_POST)) ? true : false;

    //if post array is not empty execute  
    if($post){
        if(isset($_POST['pharmacy_name'])){
               $shop_name = filter_input(INPUT_POST, 'pharmacy_name', FILTER_SANITIZE_STRING);
        }
        if(isset($_POST['mobile'])){
               $business_mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_EMAIL);
        }
        if(isset($_POST['email_address'])){
               $email_address = filter_input(INPUT_POST, 'email_address', FILTER_SANITIZE_STRING);
        }
        if(isset($_POST['latitude'])){
               $latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);
        }
        if(isset($_POST['longitude'])){
               $longtitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
        }
    }
    if (isset($_POST['shop_registration'])) {

       //a query for inserting POST array data into database table
       $query= "INSERT INTO pharmacy (Owner_Owner_ID,Shop_Name, Mobile_Number, Email_Address, Latitude, Longitude) VALUES ('$sessionUser','$shop_name', '$business_mobile', '$email_address', '$latitude', '$longtitude')";
       $result = mysql_query($query) or die ($query."<br/><br/>".mysql_error());//query the database by inserting the values
    
       if (!$result) {
            header( "refresh:5;url=http://localhost/LBS/register.html" ); 
            echo 'Sorry! Your registration was unsuccessful. You\'ll be redirected in about 5 secs. If not, click <a href="http://localhost/LBS/register.html">here</a>.';
        }
        else {
            
            header( "refresh:5;url=http://localhost/LBS/profile.php" ); 
            echo 'Your registration was successful. You\'ll be redirected in about 5 secs. If not, click <a href="http://localhost/LBS/profile.php">here</a>.';
        }
       //close database server connection
       mysql_close($connect);
    }