<?php
  include "sidebar.php";
  require "connection/database.php";
  $conn = connection();
  $id = $_SESSION['user_id'];

  if(empty($_SESSION['user_id'])){
    header("Location: index.php");
  }
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql) or die($conn->error);
  $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="styles/chats.css">
  <title>Chat Now! (Chats)</title>
</head>
<body>
  <div class="container">
    <div class="chats-container">
      <div class="chats-header">
        <div class="header">
          <h2>Chats</h2>
          <i class="fa-regular fa-pen-to-square"></i>
        </div>
        <div class="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="search" placeholder="Search chats">
        </div>
      </div>
      <div class="chat-list">
        
      </div>
    </div>
    <div class="conversation">
      <div class="convo-header">
        <div class="header">
          <div class="receiver">
            <img class="receiver-profile" src="images/man-avatar.png" alt="">
            <h2><?php echo $_SESSION['username'] ?></h2>
          </div>
          <div class="receiver-nav">
            <i class="fa-solid fa-phone"></i>
            <i class="fa-solid fa-video"></i>
            <i class="fa-solid fa-circle-info"></i>
          </div>
        </div>
      </div>
      <div class="convo-body">
        
      </div>
      <div class="convo-footer">
        <a href=""><i class="fas fa-plus"></i></a>
        <a href=""><i class="fas fa-image"></i></a>
        <a href=""><i class="fas fa-file"></i></a>
        <form action="chats.php" method="post" class="message-form">
          <div class="message-box">
            <input type="text" name="message" id="text-box" placeholder="Send a message" autocomplete="off">
            <a href=""><i class="fas fa-smile"></i></a>
          </div>
          <input type="submit" name="send" class="fa send" value="&#xf1d8">
        </form>
      </div>
    </div>
  </div>
  <script src="script/chats.js"></script>
</body>
</html>
<?php
  if($_SERVER['REQUEST_METHOD'] === "POST"){
    $message = $_POST["message"];
    if(isset($_POST['send'])){
      ?> 
        <script>
          sendMessage(<?php echo json_encode($message); ?>);
        </script>
      <?php
    }
  }
?>

