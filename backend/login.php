<?php
  session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnection.php';
  


    if (isset($_POST['useremail']) && isset($_POST['userpassword'])) {
        $password = $_POST['userpassword'];
        $email = $_POST['useremail'];
        
        $sql = "SELECT User_password FROM users WHERE User_email='$email'";
        $result = mysqli_query($dbconn, $sql);

        if (!$result) {
            echo "Failed to retrieve password";
        } else {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['User_password'];

            if (password_verify($password, $storedPassword)) {
               // Set session variables
              
               $_SESSION['id'] = $row['id'];
               $_SESSION['useremail'] = $email; 
               $_SESSION['userpassword'] = $password; 


               echo "<script>
               console.log('Session ID: ".$_SESSION['id']."');
               console.log('Session Email: ".$_SESSION['useremail']."');
               console.log('Session Password: ".$_SESSION['userpassword']."');
                alert('You are logged in.');
                    setTimeout(function() {
                        window.location.href = '/xamm-php/GymFit/FitConnect-Manene_Frontend/FitConnect-Corene_frontend/LANDING--PAGE/index.php';
                    }, 10);
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
} else {
    echo "Invalid request method. Please try again.";
}
?>
