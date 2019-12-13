


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

 $user = $_GET["user"];
 $table = "user";

 $result = mysqli_query ($connect, "select * from $table where username = \"$user\"");
 $row = $result->fetch_row();

 if (empty($row))
 {
	$response = " , ";

 }
 else
 {
	     $response = $row[0].",".$row[0];
	     echo $response;
 }

 $result->free();

 // Close connection to the database
  mysqli_close($connect);
  ?>
