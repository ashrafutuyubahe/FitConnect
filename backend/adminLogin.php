<?php
session_start();
require_once '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnection.php'; 
    
    if (isset($_POST['google_login'])) {
      // Google login logic
        // $client = new Google_Client();
        // $client->setClientId("232507004935-suji0ibu8gibvfjsmjd517ag5lhd2umv.apps.googleusercontent.com");
        // $client->setClientSecret("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");
        // $client->setRedirectUri("http://localhost:8080/xamm-php/GymFit/FitConnect-Manene_Frontend/admin-dashboard/dashboard.php");
        // $client->addScope("email");
        // $client->addScope("profile");
        
        $authUrl = $client->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        exit;
    } elseif (isset($_POST['adminname']) && isset($_POST['adminemail']) && isset($_POST['adminpassword'])) {
        
        $adminname = $_POST['adminname'];
        $adminemail = $_POST['adminemail'];
        $adminpassword = password_hash($_POST['adminpassword'], PASSWORD_DEFAULT); // Hash the password
        
        
        $sql = "INSERT INTO admin_table (admin_name, admin_email, admin_password) VALUES ('$adminname', '$adminemail', '$adminpassword')";
        $result = mysqli_query($dbconn, $sql);

        if ($result) {
            
            echo "<script>
                alert('You have successfully signed up as admin.');
                window.location.href = '/xamm-php/GymFit/FitConnect-Manene_Frontend/admin-dashboard/dashboard.html'; 
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Failed to sign up as admin.');
                window.location.href = '/xamm-php/admin-signup.html'; 
            </script>";
            exit;
        }
    } else {
        echo "Admin name, email, and password are not set.";
    }
} elseif (isset($_GET['code'])) {
    // Google callback logic
    // $client = new Google_Client();
    // $client->setClientId("YOUR_CLIENT_ID");
    // $client->setClientSecret("YOUR_CLIENT_SECRET");
    // $client->setRedirectUri("YOUR_REDIRECT_URL");
    
    // $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        // Google login successful
        // Perform necessary actions like getting user info and processing
        
        // After processing, you can redirect the user to the dashboard or another page
        // header("Location: /dashboard.php");
        // exit();
    } else {
        // Error handling
        echo "Error: " . $token['error_description'];
    }
} else {
    echo "Invalid request method. Please try again.";
}
?>
