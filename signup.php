<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup</title>
  <link rel="stylesheet" href="styles/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
</head>

<body>
  <form method="post">
    <div class="container">
      <div>
        <h1 class="header">Sign up</h1>
      </div>
      <div class="sub-header">
        <h2>Create your account !</h2>
      </div>
      <div>
        <input type="text" name="username" id="username" placeholder="Name" />
      </div>
      <div>
        <input type="email" name="useremail" id="useremail" placeholder="Email or Phone number" />
      </div>
      <div>
        <input type="password" name="userpassword" id="userpassword" placeholder="Password" />
      </div>
      <div>
        <input type="submit" name="signup" class="submit-input" value="Signup">
      </div>
      <p>OR</p>
      <div>
        <button type="submit" class="google">Sign in with Google</button>
      </div>
      <p class="text-bottom">
        Already have an account ? <a href="login.php">Login</a>
      </p>
    </div>
  </form>
  <footer>
    <img src="images/top.png" alt="" />
    <img src="images/bottom.png" alt="" />
  </footer>
</body>

</html>

<?php

if(isset($_POST['signup'])){
  include_once('connection.php');
  $username = $_POST['username'];
  $useremail = $_POST['useremail'];
  $userpassword = $_POST['userpassword'];

  // Escape user inputs for security
  $username = mysqli_real_escape_string($conn, $username);
  $useremail = mysqli_real_escape_string($conn, $useremail);
  $userpassword = mysqli_real_escape_string($conn, $userpassword);

  // Insert user data into the database
  $insert = "INSERT INTO users(user_name, user_email, user_password) VALUES ('$username', '$useremail', '$userpassword')";
  $executeQuerry = $conn->query($insert);
  if (!$executeQuerry) {
      die('Error in registration: ' . $conn->error);
  } else {
      echo "<script>alert('Registration is successfully done');</script>";
      echo "<script>window.location.href = 'home.php';</script>";
      exit;
  }
}
?>

<?php
$host= 'localhost';
$usernm='root';
$pass= '123'; // Enclose password in single quotes
$dbnm='gymfitness';
$conn= new mysqli($host,$usernm,$pass,$dbnm);
if($conn->connect_error){
    exit("connection failed:".$conn->connect_error);
} 

echo "connection is set"; // Fixed typo in 'connection' word
?>
