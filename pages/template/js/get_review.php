<?php

// Connect to the MySQL database
$host = 'localhost';
$user = 'admin';
$pwd = 'randomPassword';
$dbs = 'movi';
$connect = mysqli_connect ($host, $user, $pwd, $dbs);

if(empty($connect))
{

}

$table = "reviews";
$movie_id = $_GET["movie_id"];

$data = [];

$result = mysqli_query ($connect, "select * from $table where movie_id = '$movie_id'");

if (empty($result))
{
  $response = " , , , , , ";
}
else
{
  while($row = $result->fetch_row()){
    $response = $row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].",".$row[6];
    array_push($data, $response);
  };
}

echo json_encode($data);
$result->free();

// Close connection to the database
mysqli_close($connect);
?>
