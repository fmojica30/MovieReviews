<?php

session_start();
print <<<TOP
<html>
<head>
<title> Register to Movi </title>
<meta charset="UTF-8">
<link href="./css/registration.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
        <div class="wrapper">

	<div class="header">
          <div class="header_sep">
        	<img src="./images/logo_blue.png" alt="Logo" class="logo">
        	<h1>Movi</h1>
          </div>
        </div>
	
	<div class="navBar">
	<div class="nav">
        <a href="#login-form" rel="modal:open" method="POST">Login</a>
        <form id="login-form" class="modal">
          <div class="login_modal">
            <label for="usernameLogin">Username: </label>
            <input type="text" name="usernameLogin" />
            <label for="passwordLogin">Password</label>
            <input type="password" name="passwordLogin">
            <input type="submit" value="Login" name = "submitLogin"/>
            <input type="reset" value="Reset" />
	    <p id="wrong"> Wrong username or password!</p>

          </div>
        </form>
        <a href="index.php">Home</a>
        <a href="registration.php">Sign Up</a>
      </div>
    </div>


TOP;

// Connect to the MySQL database

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


// Add data to a table in the database
//

	$script = $_SERVER['PHP_SELF'];
	print <<<FIRST
	<form method = "post" action = $script id = "addForm" class="reg">
	<p id= "insertAll">Insert all information!</p>

	Username: <input type = "text" name = "username" id ="username" value="">
	<p id="exist">The Username already exist!</p> 
	Password: <input type = "password" name = "password" value=""><br>
	Last Name: <input type="text" name = "last" value = ""><br>
	First Name: <input type = "text" name = "first" value=""><br>
	Age: <input type = "text" name = "age" value="" maxlenght="3" lenght = "5"><br>
	Favoruite genre: <br/>
	<select name="genre">
	<option value="Action">Action</option>
  	<option value="Comedy">Comedy</option>
  	<option value="Drama">Drama</option>
	<option value="Horror">Horror</option>
	<option value="Family">Family</option>
  	<option value="Comedy">Comedy</option>
  	<option value="Historical">Historical</option>
 	<option value="Disney">Disney</option>
	<option value="Science Fiction">Science Fiction</option>
  	<option value="Other">Other</option>
 	
	</select><br/>
	<input type = "submit" name = "submit" id = "submit"><br /><br/>
	</div>
	</form>
	<script  type = "text/javascript">
		document.getElementById("addForm").username.onchange = callServer;
		var xhr;
		if (window.ActiveXObject)
	 	 	{
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			else if(window.XMLHttpRequest)
			{
				xhr = new XMLHttpRequest();
			}
		function callServer()
			{
				
				var user = document.getElementById("username").value;
			        var url = "./checkUsername.php?user=" + escape(user);
				xhr.open("GET", url, true);
			        xhr.onreadystatechange = updatePage;
			        xhr.send(null);
			}
  		function updatePage()
		{
			if ((xhr.readyState == 4) && (xhr.status == 200))
			{
				var response = xhr.responseText.split(",");
				if (response[1]==document.getElementById("username").value){			
					dom = document.getElementById("exist").style;
    					dom.visibility = "visible";

					}
				else{
					dom = document.getElementById("exist").style;
    					dom.visibility = "hidden";
				}
			}
		}
	</script>
FIRST;

function purge ($str)
	{
	$purged_str = preg_replace("/\W/", "", $str);
	return $purged_str;
	}
if(isset($_POST['submit']))
{
$username = purge($_POST["username"]);
$password = purge($_POST["password"]);
$last = purge($_POST["last"]);
$first = purge($_POST["first"]);
$age = $_POST["age"];
$genre = $_POST["genre"];

$result = mysqli_query ($connect, "select * from $table where username = \"$username\"");
 $row = $result->fetch_row();


if ($username=="" || $password=="" || $first=="" || $last=="" || $age=="" || $genre==""){
print<<<DOM
	<script>
	dom = document.getElementById("insertAll").style;
    	dom.visibility = "visible";
	</script>
DOM;

}

else if (empty($row))
 {

$stmt = mysqli_prepare ($connect, "INSERT INTO $table VALUES (?, ?, ?,?,? ,?);");
mysqli_stmt_bind_param ($stmt, 'ssssis', $username, $password,$last,$first,$age, $genre);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$_SESSION['username'] = $username;
setcookie("username", $username, time()+3600);
header("location: myPage.php");
}else {
print <<<DOM
	<script>
	dom = document.getElementById("exist").style;
    	dom.visibility = "visible";
	</script>
DOM;
}
}

if(isset($_POST['submitLogin'])){
	$user = purge($_POST["usernameLogin"]);
	$pass = purge($_POST["passwordLogin"]);
	$result = mysqli_query ($connect, "select * from $table where username = \"$user\"");
	$row = $result->fetch_row();
	if (empty($row)){
		print<<<DOM
		<script>
		dom = document.getElementById("wrong").style;
    		dom.visibility = "visible";
		</script>
DOM;

	}else{
		print<<<DOM
		<script>

		dom = document.getElementById("wrong").style;
    		dom.visibility = "hidden";
		</script>
DOM;

		setcookie("username", $user, time()+3600);
				header("location: myPage.php");
		

	}
	


}



print <<<BOTTOM
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

</body>
</html>
BOTTOM;

?>




