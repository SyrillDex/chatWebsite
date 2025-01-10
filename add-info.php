<?php
  require "connection/database.php";
  $conn = connection();
  session_start();

  (!isset($_POST["age"])) ? $age = "" : $age = $_POST["age"];
  (!isset($_POST["birth-date"])) ? $birthDate = "" : $birthDate = $_POST["birth-date"];
  (!isset($_POST["phone-number"])) ? $phoneNumber = "" : $phoneNumber = $_POST["phone-number"];
  (!isset($_POST["email"])) ? $email = "" : $email = $_POST["email"];
  if(empty($_SESSION['user_id'])){
    header("Location: index.php");
  }
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
  <link rel="stylesheet" href="styles/add-info.css">
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <title>Chat Now!</title>
</head>
<body>
  <div class="container">
    <div class="app-logo">
      <img src="images/logo.png" alt="Chat Now">
    </div>
    <h1>Hello <?php echo $_SESSION['username']; ?>!</h1> 
    <p>You are one step away on completing your profile!</p>
    <form action="add-info.php" method="post" class="addinfo-form">
      <div class="prompt"></div>
      <input type="number" name="age" placeholder="Age" autocomplete="off" value="<?= $age ?>" required>
      <input type="date" name="birth-date" placeholder="Birthday" autocomplete="off" value="<?= $birthDate ?>" required>
      <input type="text" name="phone-number" placeholder="Phone number" autocomplete="off" value="<?= $phoneNumber ?>" required>
      <input type="email" name="email" placeholder="Email" value="<?= $email ?>">
      <input type="submit" name="submit" value="Done">
    </form>
  </div>
  <script src="script/add-info.js"></script>
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
      if (!preg_match('/^[0-9]+$/', $age) || $age > 105){
        ?> <script>showPrompt("Please enter a valid age");</script> <?php
      } else if($age < 0){
        ?> <script>showPrompt("Please enter a valid age");</script> <?php
      } else if(!preg_match('/^[0-9]+$/', $phoneNumber)){
        ?> <script>showPrompt("Please enter a valid phone number");</script> <?php
      } else if(strlen($phoneNumber) != 11){
        ?> <script>showPrompt("Phone number must be 11 digits");</script> <?php
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
