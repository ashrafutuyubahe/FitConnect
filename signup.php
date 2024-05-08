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
  <form action="register.php" method="post">
    <div class="container">
      <div>
        <h1 class="header">Sign up</h1>
      </div>
      <div class="sub-header">
        <h2>Create your account !</h2>
      </div>
      <div>
        <input type="text" name="name" id="name" placeholder="Name" />
      </div>
      <div>
        <input type="email" name="email" id="email" placeholder="Email or Phone number" />
      </div>
      <div>
        <input type="password" name="password" id="password" placeholder="Password" />
      </div>
      <div>
        <button type="submit" class="sign-up-btn">Sign up</button>
      </div>
      <p>OR</p>
      <div>
        <button type="submit" class="google">Sign in with Google</button>
      </div>
      <p class="text-bottom">
        Already have an account ? <a href="login.html">Login</a>
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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $useremail = $_POST['useremail'];
  $userpassword = $_POST['userpassword'];
  require_once 'connection.php';

  $insert = "INSERT INTO users(user_name,user_email,user_password) values('$username','$useremail','$userpassword')"; 
  if (!$result) {
    die('error in registration' . $conn->error);
  } else {
    echo "<script>alert('Registration is successfully done');</script>";
    echo "<script>window.location.href = 'homepage.html';</script>";
    exit;
    exit;
  }
} else {
  echo "Invalid request method. Please try again.";
}


?>