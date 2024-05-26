<?php
session_start();
require_once '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnection.php'; 
    // $GOOGLE_CLIENTID="232507004935-suji0ibu8gibvfjsmjd517ag5lhd2umv.apps.googleusercontent.com";
    // $GOOGLE_CLIENT_SECRETE="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";
    //  $RedirectURLS="http://localhost:8080/xamm-php/GymFit/FitConnect-Manene_Frontend/USER--DASHBOARD/dashboard.html";

// //goole login logic
// $client = new Google_Client();
// $client->setClientId( $GOOGLE_CLIENTID);
// $client->setClientSecret($GOOGLE_CLIENT_SECRETE);
// $client->setRedirectUri( $RedirectURLS);
// $client->addScope("email");
// $client->addScope("profile");

    if (isset($_POST['google_login'])) {
        $authUrl = $client->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        exit;    
   
        //normal login logic
    } else {
       
        if (isset($_POST['useremail']) && isset($_POST['userpassword'])) {
            $password = $_POST['userpassword'];
            $email = $_POST['useremail'];
            
            $sql = "SELECT * FROM users WHERE User_email='$email'";
            $result = mysqli_query($dbconn, $sql);

            if (!$result) {
                echo "Failed to retrieve user";
            } else {
                $row = mysqli_fetch_assoc($result);
                $storedPassword = $row['User_password'];

                if (password_verify($password, $storedPassword)) {
                   
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['useremail'] = $email;
                    $_SESSION['username'] = $row['User_name'];

                 
                    echo "<script>
                        alert('You are logged in.');
                        window.location.href = '  /xamm-php/GymFit/FitConnect-Manene_Frontend/userDash.php';
                                               
                    </script>";
                    exit;
                } else {
                    echo "<script>
                        alert('Invalid email or password. Please use correct credentials');
                        setTimeout(function() {
                            window.location.href = '/xamm-php/GymFit/FitConnect-Manene_Frontend/login.html';
                        }, 50);
                    </script>";
                    exit;
                }
            }
        } else {
            echo "Email and password are not set.";
        }
    }
} else {
    echo "Invalid request method. Please try again.";
}
?>
