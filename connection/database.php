<?php
  function connection(){
    $db_server = "localhost";
    $db_user = "root";
    $db_name = "chat_website";
    $db_pass = "nakalimutankona";
    $db_port  = "3306";
    $conn = null;
  
    try {
      $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name, $db_port);
      return $conn;
    } catch (mysqli_sql_exception){
      echo "Something went wrong";
    }
  }

?>