<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'connection.php';

    $password = $_POST['userpassword'];
    $email = $_POST['useremail'];

    $sql = "SELECT password FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Failed to retrieve password";
    } else {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        if ($storedPassword == $password) {
           $_SESSION['id']=$_POST['id'];
           $_SESSION['username']=$_POST['username'];
           $_SESSION['userpassword']=$_POST['userpassword'];


            echo "<script>alert('You are logged in');</script>";
            header('Location: homepage.html');
            exit;
        } else {
            echo "<script>alert('Invalid email or password. Please use correct credentials');</script>";
            header('Location: login.html');
            exit;
        }
    }
} else {
    echo "Invalid request method. Please try again.";
}
?>
