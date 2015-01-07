<?php
 if(!isset($_SESSION)) { 
    session_start(); 
}

//error checker
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

include('connection.php');

//check if post array is empty
$post = (!empty($_POST)) ? true : false;

//if post array is not empty execute  
if($post) {
    //create POST array to collect data from the login form

    //confirm first whether the data has been set before assigning it a variable
    //and use filter input to remove malicious characters
     if(isset($_POST['email_login'])) {
            $user_email = filter_input(INPUT_POST, 'email_login', FILTER_SANITIZE_STRING);
     }
     if(isset($_POST['password_login'])){
            $password = filter_input(INPUT_POST, 'password_login', FILTER_SANITIZE_STRING);
     }
}

    if (isset($_POST['submit_login_btn'])) {
        //a query for selecting login data from username table
        $query = "SELECT Owner_ID, Email_Address FROM owner WHERE Email_Address ='$user_email' AND Password = SHA('$password')";
        
        //store query in a variable
        $result = mysql_query($query);

        //check if the results are there
        if($result) {
            //get number of rows
            $num_rows = mysql_num_rows($result);

                if($num_rows == 1) {
                    session_regenerate_id();
                    $row = mysql_fetch_array($result);
                    //store user email, owner ID in session variables
                    $_SESSION['Email_Address'] = $row['Email_Address'];
                    $_SESSION['Owner_ID'] = $row['Owner_ID'];
                    setcookie('Owner_ID', $row['Owner_ID'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
                    setcookie('Email_Address', $row['Email_Address'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
                    //load login success message
                    //redirect to profile page
                    //$map_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/profile.php';
                    header('Location: http://localhost/LBS/profile.php');
                }
                
                else {
                    header('Location: http://localhost/LBS/login.html');
                }
        } else {
            echo "<p>No Result</p>";
        }

   //close database server connection
    mysql_close($connect);
} else {
            echo "<p>The submit button did not work!</p>";
}