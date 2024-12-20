<?php
  session_start();
  if(!isset($_SESSION['username']) && ($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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