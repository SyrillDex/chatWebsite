<?php
  $db_server = "localhost";
  $db_user = "root";
  $db_name = "chat_website";
  $db_pass = "";
  $conn = null;

  try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
  } catch (mysqli_sql_exception){
    echo "Something went wrong";
  }
?>