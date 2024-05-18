<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'dbconnection.php';

    $username = $_POST['username'];  
    $useremail = $_POST['useremail']; 
    $userpassword = $_POST['userpassword'];
    
       
    $hashedPassword= md5($userpassword);
    $insert = "INSERT INTO users(User_name,User_email,User_password) values('$username','$useremail','$hashedPassword')";
    $result = mysqli_query($dbconn, $insert);

    
    if (!$result) {
         $error_message = 'Error in registration: ' . $dbconn->error;
        $error_message .= '<br>SQL Query: ' . $insert;
        die($error_message);
    } else {
        
        echo "<script>alert('Your  Registration is successfully done');</script>";
          header('Location:/xamm-php/GymFit/FitConnect-Manene_Frontend/FitConnect-Corene_frontend/LANDING--PAGE/index.html');
        exit;
    }
} else {

    echo "Invalid request method. Please try again.";
}
?>
