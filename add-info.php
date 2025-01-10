<?php
  require "connection/database.php";
  $conn = connection();
  session_start();

  (!isset($_POST["age"])) ? $username = "" : $username = $_POST["age"];
  (!isset($_POST["birth-date"])) ? $password = "" : $password = $_POST["birth-date"];
  (!isset($_POST["phone-number"])) ? $username = "" : $username = $_POST["phone-number"];
  (!isset($_POST["email"])) ? $username = "" : $username = $_POST["email"];
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
  <h1>Hello <?php echo $_SESSION['username']; ?>!</h1> 
  <p>You are one step away on completing your profile</p>
  <form action="add-info.php" method="post">
    <input type="number" name="age" placeholder="Age" required>
    <input type="date" name="birth-date" placeholder="Birthday" required>
    <input type="text" name="phone-number" placeholder="Phone number" required>
    <input type="email" name="email" placeholder="Email">
    <input type="submit" name="submit" value="Done">
  </form>
</body>
</html>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $age = filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT);
    $birthDate = $_POST["birth-date"];
    $phoneNumber = filter_input(INPUT_POST, "phone-number", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $id = $_SESSION["user_id"];

    if(isset($_POST['submit'])){
      if (!preg_match('/^[0-9]+$/', $age)){
        echo "Please enter a valid input";
      } else if($age < 0){
        echo "Please enter a valid age";
      } else if(!preg_match('/^[0-9]+$/', $phoneNumber)){
        echo "Please enter a valid phone number";
      } else if(strlen($phoneNumber) != 11){
        echo "Phone number must be 11 digits";
      } else {
        $sql = "UPDATE users SET age = ?, birth_day = ?, phone_number = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $age, $birthDate, $phoneNumber, $email, $id);
        $stmt->execute();
        header("Location: home.php");
      }
    }
  }
?>
