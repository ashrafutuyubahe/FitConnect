<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'dbconnection.php';

    $username = $_POST['username'];  
    $useremail = $_POST['useremail']; 
    $userpassword = $_POST['userpassword'];
    
   
    $hashedPassword = md5($userpassword);
    
  
    $checkEmailQuery = "SELECT * FROM users WHERE User_email = '$useremail'";
    $checkEmailResult = mysqli_query($dbconn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "<script>alert('The email address is already registered. Please provide a different email address.');</script>";
    } else {
        
        $insert = "INSERT INTO users(User_name, User_email, User_password) VALUES('$username', '$useremail', '$hashedPassword')";
        $result = mysqli_query($dbconn, $insert);

        if (!$result) {
            $error_message = 'Error in registration: ' . mysqli_error($dbconn);
            echo "<script>alert('$error_message');</script>";
        } else {
            echo "<script>alert('Your registration is successfully done.');</script>";
            header('Location: /xamm-php/GymFit/FitConnect-Manene_Frontend/FitConnect-Corene_frontend/LANDING--PAGE/index.html');
            exit;
        }
    }
} else {
    echo "Invalid request method. Please try again.";
}
?>
