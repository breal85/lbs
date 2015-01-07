<?php
     if(!isset($_SESSION)) { 
        session_start(); 
    }
    
    include('connection.php');

    // Storing Session
    $user_check = $_SESSION['Email_Address'];

    // SQL Query To Fetch Complete Information Of User
    $ses_sql = mysql_query("SELECT First_Name FROM owner WHERE Email_Address='$user_check'");
    $row = mysql_fetch_assoc($ses_sql);
    $login_session =$row['First_Name'];

    if(!isset($login_session)) {
            mysql_close($connection); // Closing Connection
            header('Location: login.html'); // Redirecting To Login Page
    }

