<?php
    include ('connection.php');
    
    //create current timestamp
    $timestamp = date('Y-m-d G:i:s');
        
    //check if post array is empty
      	$post = (!empty($_POST)) ? true : false;

      	//if post array is not empty execute  
      	if($post) {
            //create POST array to collect data from the user registration form
            //confirm first whether the data has been set before assigning it a variable
            //and use stri_tags to remove malicious characters
             if(isset($_POST['first_name'])) {
                    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
             }
             if(isset($_POST['last_name'])){
                    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
             }
             if(isset($_POST['user_email'])){
                    $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
             }
             if(isset($_POST['nationalid'])){
                    $nid = filter_input(INPUT_POST, 'nationalid', FILTER_SANITIZE_STRING);
             }
             if(isset($_POST['mobile'])){
                    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
             }
             if(isset($_POST['password'])){
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
             }
	}

	if (isset($_POST['submit_reg_btn'])) {
            //a query for inserting POST array data into database table
            $query = "INSERT INTO owner (First_Name,Last_Name,National_ID,Email_Address,Mobile_Number,Password,Time_Created) VALUES ('$first_name','$last_name','$nid','$user_email','$mobile',SHA('$password'),'$timestamp')";

            $result = mysql_query($query);

            if (!$result) {
                $unsucess_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/unsuccessful.php';
                header('Location: http://localhost/LBS/includes/unsuccessful.php');
             }
            else {
                $sucess_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.html';
                header('Location: http://localhost/LBS/login.html');
            }
       //close database server connection
       mysql_close($connect);
       }
       
       else {
           echo "<p>This ain't working!</p>";
       }