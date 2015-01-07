<?php

    include('session.php');
    
    if (!isset($_SESSION['Owner_ID'])) 
    {
        if (isset($_COOKIE['Owner_ID'])) 
	{
            $_SESSION['Owner_ID'] = $_COOKIE['Owner_ID'];
        }
    }

    //register business details into the table that stores the pharmacy info
    //check if post array is empty
    $post = (!empty($_POST)) ? true : false;

    //if post array is not empty execute  
    if($post){
        if(isset($_POST['drug_name'])){
               $drug_name_id = filter_input(INPUT_POST, 'drug_name', FILTER_SANITIZE_STRING);
        }
        
        if(isset($_POST['drug_price'])){
               $drug_price = filter_input(INPUT_POST, 'drug_price', FILTER_SANITIZE_EMAIL);
        }
        
        if(isset($_POST['pharmacy_name'])){
               $pharmacy_name_id = filter_input(INPUT_POST, 'pharmacy_name', FILTER_SANITIZE_STRING);
        }
    }
    if (isset($_POST['add_drug'])) {
       //a query for inserting POST array data into database table
       $query1= "INSERT INTO drugrepo_has_pharmacy (drugrepo_Repo_ID,Pharmacy_Shop_ID,drug_price) VALUES ('$drug_name_id','$pharmacy_name_id','$drug_price')";       
       $result1 = mysql_query($query1) or die ($query1."<br/><br/>".mysql_error());//query the database by inserting the values
    
       if (!$result1) {
            header( "refresh:5;url=http://localhost/LBS/register.html" ); 
            echo 'Sorry! Registration of the drug was unsuccessful. You\'ll be redirected in about 5 secs. If not, click <a href="http://localhost/LBS/addDrug.php">here</a>.';
        }
        else {
            
            header( "refresh:5;url=http://localhost/LBS/profile.php" ); 
            echo 'Your registration was successful. You\'ll be redirected in about 5 secs. If not, click <a href="http://localhost/LBS/profile.php">here</a>.';
        }
       //close database server connection
       mysql_close($connect);
    }