<?php
  session_start();

  if(empty($_SESSION['user_id'])){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <title>Chat Now!</title>
</head>
<body>
  <h1>Welcome <?php echo $_SESSION['username']; ?></h1> 
  <form action="home.php" method="post">
    <input type="submit" name="logout" value="Log out">
  </form>
</body>
</html>

<?php
  if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
  }
?>