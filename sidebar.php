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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="styles/sidebar.css">
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <title>Chat Now! (Chats)</title>
</head>
<body>
  <nav class="nav-bar">
   
    <div class="nav-links">
      <div class="app-logo">
        <img src="images/logo-blue.png" alt="Chat Now">
      </div>
      <a href="chats.php" class="active"><i class="fa-solid fa-comments"></i></a>
      <a href="#"><i class="fa-solid fa-user-group"></i></a>
      <a href="#" ><i class="fa-solid fa-box-archive"></i></a>
    </div>
    <div class="user-icon">
      <img class="user" src="images/man-avatar.png" alt="user">
    </div>
  </nav>
  <div class="options">
    <div>
      <i class="fa-solid fa-user-gear"></i>
      <a href="account-settings.php">Account settings</a>
    </div>
    <div>
      <i class="fa-solid fa-gear"></i>
      <a href="#">Preferences</a>
    </div>
    <div>
      <i class="fa-solid fa-shield-halved"></i>
      <a href="#">Privacy & safety</a>
    </div>
    <div>
      <i class="fa-solid fa-circle-question"></i> 
      <a href="#">Help</a>
    </div>
    <div>
      <i class="fa-solid fa-bug"></i>
      <a href="#">Report a problem</a>
    </div>
    <div>
      <i class="fa-solid fa-scroll"></i>
      <a href="#">Terms</a>
    </div>
    <div>
      <i class="fa fa-cookie"></i>
      <a href="#">Cookie policy</a>
    </div>
    <div>
      <i class="fa-solid fa-right-from-bracket"></i>
      <a href="logout.php">Log out</a>
    </div>
  </div>
  <script src="script/sidebar.js"></script>
</body>
</html>
