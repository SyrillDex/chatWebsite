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
  <div class="signup-form">
    <form action="signup.php" method="post">
      <input type="text" name="username" placeholder="Username" autocomplete="off">
      <input type="password" name="password" placeholder="Password">
      <input type="number" name="age">
      <input type="submit" name="signup" value="Sign up">
      <a href="index.php">Log in</a>
    </form>
  </div>
</body>
</html>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $age = $_POST["age"];

    if(empty($username) || empty($password) || empty($age)){
      echo "Please complete the form";
    } elseif(!preg_match('/^[a-zA-Z0-9 ]+$/', $username)) {
      echo "Error: Username should only contain letters and numbers";
    } elseif($age < 18) {
      echo "You must be 18yrs old to enter this site";
    } else{
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Username already taken";
        } else {
            $sql = "INSERT INTO users (username, password, age) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $username, $hashed_password, $age);
            
            try {
                $stmt->execute();
                echo "Registration successful!";
            } catch (mysqli_sql_exception $e) {
                echo "Something went wrong: " . $e->getMessage();
            }
        }
    }
    $stmt->close();
    $conn->close();
  }
?>