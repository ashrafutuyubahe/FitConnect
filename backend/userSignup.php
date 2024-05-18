<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  
    $useremail = $_POST['useremail']; 
    $userpassword = $_POST['userpassword'];
    require_once 'connection.php';
       
    $hashedPassword= md5($userpassword);
    $insert = "INSERT INTO users(user_name,user_email,user_password) values('$username','$useremail','$hashedPassword')";
    $result = mysqli_query($conn, $insert);

    
    if (!$result) {
         $error_message = 'Error in registration: ' . $conn->error;
        $error_message .= '<br>SQL Query: ' . $insert;
        die($error_message);
    } else {
        
        echo "<script>alert('Registration is successfully done');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
        exit;
    }
} else {

    echo "Invalid request method. Please try again.";
}
?>
