<?php
  require "connection/database.php";
  $conn = connection();

  (!isset($_POST["username"])) ? $username = "" : $username = $_POST["username"];
  (!isset($_POST["password"])) ? $password = "" : $password = $_POST["password"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="styles/index.css">
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <title>Chat Now! (Log In)</title>
</head>

<body>
  <div class="container">
    <div class="app-logo">
      <img src="images/logo.png" alt="Chat Now">
    </div>
    <div class="image-div">
      <img src="images/login.jpg" alt="Image">
    </div>
    <form action="index.php" method="post" class="login-form">
      <h2>Welcome back!</h2>
      <p>Hello, you've been missed!</p>
      <p class="prompt">Invalid username / password</p>
      <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?= $username ?>">
      <input type="password" name="password" placeholder="Password" value="<?= $password ?>">
      <p>Don't have an account? <a href="signup.php">Sign up</a></p>
      <input type="submit" name="login" value="Log in">
      <p>or continue with</p>
      <div class="logo">
        <img src="svg/google.svg" alt="google">
        <img src="svg/facebook.svg" alt="facebook">
        <img src="svg/insta.svg" alt="instagram">
      </div>
    </form>
  </div>
  <script src="script/index.js"></script>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($row) {
    if(strcmp($row['username'], $username) === 0){
      $stored_hashed_password = $row['password'];

      if (password_verify($password, $stored_hashed_password)) {
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['id'];
        header("Location: chats.php");
        exit();
      } else { ?> <script>showPrompt();</script> <?php }
    } else { ?> <script>showPrompt();</script> <?php }
  } else { ?> <script>showPrompt();</script> <?php }
  $stmt->close();
  $conn->close();
}
?>