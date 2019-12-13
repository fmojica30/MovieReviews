<?php

// Connect to the MySQL database
$host = 'fall-2019.cs.utexas.edu';
$user = 'cs329e_mitra_milica96';
$pwd = 'crux$Crept*task';
$dbs = 'cs329e_mitra_milica96';
$port = '3306';
$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

if(empty($connect))
{

}

$table = "reviews";
$movie_id = $_GET["movie_id"];

$data = [];

$result = mysqli_query ($connect, "select * from $table");

if (empty($result))
{
  $response = " , , , , , ";
}
else
{
  while($row = $result->fetch_row()){
    $response = $row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5];
    array_push($data, $response);
  };
}

echo json_encode($data);
$result->free();

// Close connection to the database
mysqli_close($connect);
?>
