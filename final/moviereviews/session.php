<?php

   session_start();
   
   $user_check = $_SESSION['username']; 



   if(!isset($_SESSION['username']) || !isset($_COOKIE["username"])){
      header("location:index.php");
      die();
   }
?>
