<?php

$cookie_name = 'username';

if (!isset($_COOKIE[$cookie_name]))
{
 header("location:index.php");
}


$host = 'localhost';
$user = 'admin';
$pwd = 'randomPassword';
$dbs = 'movi';
$connect = mysqli_connect ($host, $user, $pwd, $dbs);

if (empty($connect))
{
  die("mysqli_connect failed: " . mysqli_connect_error());
}


$table = "user";
$username = $_COOKIE[$cookie_name];

$result = mysqli_query($connect, "SELECT * FROM user WHERE username='$username';");
$row = $result->fetch_row();
$str = $row[3]." ".$row[2];
$genre = $row[5];

print <<<TOP
<html>
<head>
<title> My Page </title>
<meta charset="UTF-8">
<link href="./css/myPage.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
	
 <script>

 function update_movie_data(movie_id, field) {
  var data = "{}";

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      const info = JSON.parse(this.responseText);
      field.textContent = info["original_title"];
      
    }
  });
  var url = 
  xhr.open("GET", `https://api.themoviedb.org/3/movie/`+ movie_id + `?api_key=6564f1b545f85dd02cc8e9efe58744a6&language=en-US`);

  xhr.send(data);
}
</script>


	<div class="wrapper">

	<div class="header">
          <div class="header_sep">
        	<img src="./images/logo_blue.png" alt="Logo" class="logo">
        	<h1>Movi</h1>
          </div>
        </div>
	
	<div class="navBar">
	<div class="nav">
	<a href="registration.php">Sign Up</a>        
        <a href="index.php">Home</a>
	<a href="logOut.php">Logout</a>	

      </div>
    </div>
	<div class='welcome'><p>$str's page!</p>
	</div>
      <div class="recom_head"> 
          <h2>Recommendations for you</h2>
       </div>
		
	<form class="featured" action="./pages/template/template.php" method="POST">

        <div class="movie_1 movie_display">
          <button type="submit" name="movie_id" id="movie_id_1" value="522939" class="movie_submit">
            <img src="./images/fordvferrari.png" alt="Ford V Ferrari" id="feat_1">
          </button>
        </div>
        <div class="movie_2 movie_display">
	     <button type="submit" name="movie_id" id="movie_id_2" value="522939" class="movie_submit">    
	     <img src="./images/Frozen_2.jpg" alt="Frozen 2" id="feat_2">
          </button>
        </div>
        <div class="movie_3 movie_display">
          <button type="submit" name="movie_id" id="movie_id_3" value="522939" class="movie_submit">
            <img src="./images/Spies_in_Disguise.jpeg" alt="Spies in Disguise" id="feat_3">
          </button>
	</div>
	 <div class="movie_4 movie_display">
          <button type="submit" name="movie_id" id="movie_id_4" value="522939" class="movie_submit">
            <img src="./images/fordvferrari.png" alt="Ford V Ferrari" id="feat_4">
          </button>
        </div>
 	<div class="movie_5 movie_display">
          <button type="submit" name="movie_id" id="movie_id_5" value="522939" class="movie_submit">
            <img src="./images/fordvferrari.png" alt="Ford V Ferrari" id="feat_5">
          </button>
        </div>
 	<div class="movie_6" movie_display>
          <button type="submit" name="movie_id" id="movie_id_6" value="522939" class="movie_submit">
            <img src="./images/fordvferrari.png" alt="Ford V Ferrari" id="feat_6">
          </button>
        </div>
	
      
    </form>

	<div class = "toWatch">
	<form id = "buttons" method = "post" action="">
	
		<div class="toWatch_head">
		<h2>What-to-watch list</h2>
		</div>
TOP;
	$result1 = mysqli_query($connect, "SELECT DISTINCT movie_id FROM list WHERE username='$username';");
	
	
	print ("<table class= 'movies1'>");
	$n=0;
	while ($row = $result1->fetch_row()){
		$str = $row[0];
		print <<<TABLE
			<tr>
				<td class='mname'> 
<form method="post" action="./pages/template/template.php" class="inline">
  <input type="hidden" name="movie_id" value="$str">
  <button type="submit" name="movie_id" value="$str" class="link-button"  id = 'field$n'> >
THIS is the button
     </button>
</form></td>
				<td class = 'but'><button type="submit" name = "delete" id = "$str" value = "$str">Delete</button></td>
				<td class = 'but'><button type="submit" name ="move" id ="$str" value = "$str">Wathced</button></td>
				<script>
					var field = document.getElementById("field$n");
					update_movie_data($str, field);
				</script>
			</tr>
TABLE;
	$n+=1;
	}
	$result1->free();

	print "</table> </form></div>";
	print "<div class = 'watched'> <div class='watched_head'><h2>Already Wathced Movies</h2></div><table class = 'movies2'>";
	$result2 = mysqli_query($connect, "SELECT DISTINCT movie_id FROM watched WHERE username='$username';");
	$n=0;
	
	while ($row = $result2->fetch_row()){	
		$str = $row[0];
		print <<<TABLE
			<tr>
				<td class= 'mname'>  
<form method="post" action="./pages/template/template.php" class="inline">
  <input type="hidden" name="movie_id" value="$str">
  <button type="submit" name="movie_id" value="$str" class="link-button" id = 'f$n'> >
this is the button
     </button>
</form></td>
			
	 <script>
                                        var field = document.getElementById("f$n");
                                        update_movie_data($str, field);
                                </script>
				
			</tr>
TABLE;

 	$n+=1;
	}
	$result2->free();

	print "</table> </div>";
	print "<div class='reviews'><div class='reviews_head'><h2>My Reviews</h2></div>";
	$result3 = mysqli_query($connect, "SELECT * from reviews where username='$username';");
	print <<<TABLE
	<table class = "rev_tab">
  	<tr>
		<th>Movie</th>
		<th>Title</th>
		<th>Comment</th>
  	</tr>
TABLE;
	
	while ($row = $result3->fetch_row()){
		$str = $row[5];

			print "<tr><td id='rev$n'></td><td>".$row[3]."</td><td>".$row[4]."</td></tr>";

			print "<script>";
			print 'var field = document.getElementById("rev'.$n.'");';
			print "update_movie_data($str, field);";
			print "</script>";		
	
	

	}
	print "</table>";
	$result3->free();
		

	if(isset($_POST['delete'])){
		$str= strval($_POST['delete']);
		
		mysqli_query($connect, "DELETE from list where username='$username' and movie_id ='$str';");
		
		header("Refresh:0");


	}
 	if(isset($_POST['move'])){
		$str= strval($_POST['move']);
				
		mysqli_query($connect, "DELETE from list where username='$username' and movie_id ='$str';");
		
		$stmt = mysqli_prepare ($connect, "INSERT INTO watched VALUES (?, ?)");
		mysqli_stmt_bind_param ($stmt, 'si', $username, $str);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("Refresh:0");
		
	}

	print <<<BOTTOM
</div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <script src="./js/myPage.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

</body>
</html>
BOTTOM;


?>



