<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'dbconnection.php';

    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];

    //checking valid email
    if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Please provide a valid email address.');
                setTimeout(function() {
                    window.location.href = '/xamm-php/GymFit/FitConnect-Manene_Frontend/sign_up.html';
                }, 10);
              </script>";
        exit;
    }
    
    $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);

    $checkEmailQuery = "SELECT * FROM users WHERE User_email = '$useremail'";
    $checkEmailResult = mysqli_query($dbconn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "<script>
                alert('The email address is already registered. Please provide a different email address.');
                setTimeout(function() {
                    window.location.href = '/xamm-php/GymFit/FitConnect-Manene_Frontend/sign_up.html';
                }, 50);
              </script>";
    } else {

        $insert = "INSERT INTO users(User_name, User_email, User_password) VALUES('$username', '$useremail', '$hashedPassword')";
        $result = mysqli_query($dbconn, $insert);

        if (!$result) {
            $error_message = 'Error in registration: ' . mysqli_error($dbconn);
            echo "<script>alert('$error_message');</script>";
        } else {

            echo "<script>
            alert('Your registration is successfully done.');
                setTimeout(function() {
                    window.location.href = '  /xamm-php/GymFit/FitConnect-Manene_Frontend/USER--DASHBOARD/dashboard.html';
                }, 10);
              </script>";
            exit;
        }
    }
} else {
    echo "Invalid request method. Please try again.";
}
