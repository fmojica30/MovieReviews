<?php
function purge ($str){
  $purged_str = preg_replace("/\W/", "", $str);
  return $purged_str;
}

if(isset($_POST["submit"])) {
  $host = 'fall-2019.cs.utexas.edu';
  $user = 'cs329e_mitra_milica96';
  $pwd = 'crux$Crept*task';
  $dbs = 'cs329e_mitra_milica96';
  $port = '3306';
  $connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);
  $table = 'user';

  $username = purge($_POST["username"]);
  $password = purge($_POST["password"]);
  $sql = "select * from user where username = '$username' and password = '$password'";
  $result = mysqli_query ($connect, $sql);
  $row = $result->fetch_row();

  if (empty($row)) {
    $message = "Username/Password does not exist";
    header("location:index.php");
    setcookie("not_in_db", 'Username/Password not found', time()+30);
    header("location:index.php");
  } else {
    $message = "Successfully Logged in";
    session_start();
    setcookie("username", $username, time()+3600);
    header("location:index.php");
  }
}
?>