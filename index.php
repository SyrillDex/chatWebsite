<?php
  include("connection/database.php");

  if(!isset($_SESSION)){
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Now!</title>
</head>
<body>
  <div class="login-form">
    <form action="index.php" method="post">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" name="login" value="Log in">
      <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </form>
  </div>
</body>
</html>