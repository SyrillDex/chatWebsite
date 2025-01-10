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
  <link rel="stylesheet" href="styles/signup.css">
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <title>Chat Now! (Sign Up)</title>
</head>
<body>
  <div class="container">
    <div class="app-logo">
      <img src="images/logo.png" alt="Chat Now">
    </div>
    <form action="signup.php" method="post" class="signup-form">
      <h2>Sign up now!</h2>
      <p>Create a free account</p>
      <div class="signup-with">
        <p>Sign up with</p>
        <div class="logo">
          <img src="svg/google.svg" alt="google">
          <img src="svg/facebook.svg" alt="facebook">
          <img src="svg/insta.svg" alt="instagram">
        </div>
      </div>
      <p>or</p>
      <p class="prompt" id="p1">Please complete the form</p>
      <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?= $username ?>">
      <p class="prompt" id="p2">Please enter a valid format</p>
      <p class="prompt" id="p3">Username already taken</p>
      <input type="password" name="password" placeholder="Password" value="<?= $password ?>">
      <input type="password" name="password1" placeholder="Confirm password">
      <p class="prompt" id="p4">Password didn't match</p>
      <p class="prompt" id="p5">Password must be atleast 8 character</p>
      <input type="submit" name="signup" value="Sign up">
      <p>Already have an account? <a href="index.php">Log in</a></p>
    </form>
    <div class="image-div">
      <img src="images/signup.jpg" alt="Image">
    </div>
  </div>
  <script src="script/signup.js"></script>
</body>
</html>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($username) || empty($password)){ 
      ?> <script>showPrompt(prompt1);</script> <?php
    } elseif(!preg_match('/^[a-zA-Z0-9 ]+$/', $username)) {
      ?> <script>showPrompt(prompt2);</script> <?php
    } else if(strlen($password) < 8){
      ?> <script>showPrompt(prompt5);</script> <?php
    } else if(strcmp($password, $password1)){
      ?> <script>showPrompt(prompt4);</script> <?php
    }else{
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          ?> <script>showPrompt(prompt3);</script> <?php
        } else {
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);
            
            try {
                $stmt->execute();
                $sql = "SELECT * FROM users WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();  
                $row = $result->fetch_assoc();  
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                header("Location: add-info.php");
            } catch (mysqli_sql_exception $e) {
                echo "Something went wrong: " . $e->getMessage();
            }
        }
        $stmt->close();
        $conn->close();
    }
  }
?>