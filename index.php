<?php
  require "connection/database.php";
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_hashed_password = $row['password'];

    if (password_verify($password, $stored_hashed_password)) {
      session_start();
      $_SESSION['username'] = $row['username'];
      $_SESSION['user_id'] = $row['id'];
      header("Location: home.php");
    } else {
      echo "Wrong password";
    }
  } else {
    echo "Username not found";
  }
  $stmt->close();
  $conn->close();
}
?>