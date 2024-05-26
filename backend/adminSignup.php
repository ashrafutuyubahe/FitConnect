<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'dbconnection.php';

    $Admin_name = $_POST['adminname'];
    $Admin_email = $_POST['adminemail'];
    $Admin_password = $_POST['adminpassword'];

    //checking valid email
    if (!filter_var($Admin_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Please provide a valid email address.');
                setTimeout(function() {
                    window.location.href = '/xamm-php/GymFit/FitConnect-Manene_Frontend/sign_up.html';
                }, 10);
              </script>";
        exit;
    }
    
    $hashedPassword = password_hash($Admin_password, PASSWORD_DEFAULT);

    $checkEmailQuery = "SELECT * FROM   Admin_table WHERE Admin_email = '$Admin_email'";
    $checkEmailResult = mysqli_query($dbconn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "<script>
                alert('The email address is already registered. Please provide a different email address.');
                setTimeout(function() {
                    window.location.href = '/xamm-php/GymFit/FitConnect-Manene_Frontend/sign_up.html';
                }, 50);
              </script>";
    } else {

        $insert = "INSERT INTO Admin_table (Admin_name, Admin_email, Admin_password) VALUES('$Admin_name', '$Admin_email', '$hashedPassword')";
        $result = mysqli_query($dbconn, $insert);

        if (!$result) {
            $error_message = 'Error in registration: ' . mysqli_error($dbconn);
            echo "<script>alert('$error_message');</script>";
        } else {

            echo "<script>
            alert('Your registration is successfully done.');
                setTimeout(function() {
                    window.location.href = '/xamm-php/GymFit/FitConnect-Manene_Frontend/FitConnect-Corene_frontend/LANDING--PAGE/index.php';
                }, 10);
              </script>";
            exit;
        }
    }
} else {
    echo "Invalid request method. Please try again.";
}
