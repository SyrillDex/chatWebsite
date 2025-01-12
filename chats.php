<?php
  include "sidebar.php";
  require "connection/database.php";
  $conn = connection();

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
    </div>
    <div class="conversation">
      <div class="convo-header">
        <div class="header">
          <div class="receiver">
            <img class="receiver-profile" src="images/man-avatar.png" alt="">
            <h2><?php echo $_SESSION['username'] ?></h2>
          </div>
          <div>
            <i class="fa-solid fa-phone"></i>
            <i class="fa-solid fa-video"></i>
            <i class="fa-solid fa-circle-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>

