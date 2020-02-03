<?php

if (isset($_POST['movie_id'])) {
  //Deleting the existing cookie and setting a new one according to the users pick
  $value = $_POST['movie_id'];
  setcookie('movie_id', $value, time()+3600);
}
date_default_timezone_set('America/Monterrey');
print <<< HEAD
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title id="favicon_change">|| Movi ||</title>
    <link rel="stylesheet" href="./css/template.css">
  </head>
  <body>
    <div class="wrapper">
      <div class="header">
        <div class="header_sep">
            <img src="./images/logo_blue.png" alt="Logo" class="logo">
            <h1>Movi</h1>
        </div>
      </div>
HEAD;
//Logging in to the databse
$host = 'localhost';
$user = 'admin';
$pwd = 'randomPassword';
$dbs = 'movi';
$connect = mysqli_connect ($host, $user, $pwd, $dbs);

// $test = $_COOKIE['username'];
// echo $test;

if (empty($connect)) {
  die("mysqli_connect failed: " . mysqli_connect_error());
}

$table = "user";

$script = $_SERVER['PHP_SELF'];

if (isset($_COOKIE['not_in_db'])) {
  echo "<script type='text/javascript'>alert('Username/Password not found');</script>";
  $cookie_name = 'not_in_db';
  unset($_COOKIE[$cookie_name]);
  // empty value and expiration one hour before
  $res = setcookie($cookie_name, '', time() - 3600);
}

if (isset($_COOKIE['username'])) {
  print <<<SIGN
<div class="navBar">
<div class="nav">
<a href="../../myPage.php">My Page</a>       
<a href="../../index.php">Home</a>
<a href="../../logOut.php">Log Out</a>
</div>
</div>
SIGN;
} else {
  print <<<NOTIN
<div class="navBar">
<div class="nav">
<a href="#login-form" rel="modal:open" class="login">Login</a>
<form id="login-form" method="post" action="../../logIn.php" class="modal">
<div class="login_modal">
<label for="username">Username: </label>
<input type="text" name="username" />
<label for="password">Password</label>
<input type="password" name="password">
<input type="submit" value="Login"/>
<input type="reset" value="Reset" />
</div>
</form>
<a href="../../index.php">Home</a>
<a href="../../registration.php">Sign Up</a>
</div>
</div>
NOTIN;
}

print<<< CONT
<div class="movie_image">
      <img src="#" alt="#" class="movie_poster">
    </div>
    <div class="movie_head">
      <div class="title_prev">
        <h3 class="movie_head_title">loading</h3>
        <div class="preview">
          <iframe width="641" height="312" src="https://www.youtube.com/embed/bwzLiQZDw2I"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
	    class="preview"></iframe>
        </div>
      </div>
      <div class="vote_desc">
         <p class="movie_head_description"></p>
         <span class="likebtn-wrapper" data-theme="bootstrap" data-ef_voting="wobble" data-identifier="item_1"></span>
      </div>
    </div>
    <div class="vid_reviews">
      <div class="vid_head">
        <h2>Video Reviews</h2>
      </div>
      <div class="vid_review">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/1O3MLYlwmXQ"
          allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="vid_review_1"></iframe>
      </div>
      <div class="vid_review">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/hHkFQSCOjLM"
          allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
          id="vid_review_2"></iframe>
      </div>
    </div>
CONT;

if (isset($_COOKIE['username'])) {
  echo "
  <div class='comment_sub'>
  <form action='".$_SERVER['PHP_SELF']."' method='POST'>
    <input type='hidden' name='username' value='anonymous'>
    <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
    <div>
    <label for='title' class='review_title'>Title: </label>
    <input type='text' name='title'></inpput>
    </div>
    <div>
    <textarea name='review' cols='30' rows='10'></textarea>
    </div>
    <div>
      <button type='submit' name='comment_submit' class='review_button'>Review!</button>
      <form method ='post' action = '".$script."'>
      <button type='submit' name = 'add' class='review_button'>Want to watch</button>
      <button type='submit' name ='watched' class='review_button'>Already wathced</button>
      </form>
    </div>
  </form>
</div>
";
} else {
  echo "<div class='comment_sub'>
  <form action='#' method='POST'>
    <input type='hidden' name='username' value='anonymous'>
    <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
    <div>
    <label for='title' class='review_title'>Title: </label>
    <input type='text' name='title'></inpput>
    </div>
    <div>
    <textarea name='review' cols='30' rows='10'></textarea>
    </div>
  </form>
  <div>
  <button type='submit' name='submit' class='not_logged review_button'>Review!</button>
  </div>
  <script>
  document.querySelector('.not_logged').addEventListener('click', () => {
  alert('Please sign in to leave a review');
  })
  </script>
</div>
<div class='option_buttons'>
  <form method ='post' action = '".$script."'>
			<button type='submit' name = 'add'>Want to watch</button>
			<button type='submit' name ='watched'>Already wathced</button>
		</form>
</div>";
}

if(isset($_POST["comment_submit"])) {
  $host = 'localhost';
  $user = 'admin';
  $pwd = 'randomPassword';
  $dbs = 'movi';
  $connect = mysqli_connect ($host, $user, $pwd, $dbs);

  $username = $_COOKIE["username"];
  $date = $_POST["date"];
  $review = $_POST["review"];
  $movie_id = $_COOKIE["movie_id"];
  $title = $_POST["title"];
  $sql = "insert into reviews (username, date, review, title, movie_id)  values ('$username', '$date', '$review', '$title','$movie_id');";
  $result = mysqli_query ($connect, $sql);
}


 if(isset($_POST['add']))
 {

 	if  (isset($_COOKIE['username'])){
		$id = $_COOKIE["movie_id"];
		$username = $_COOKIE['username'];
		$stmt = mysqli_prepare ($connect, "INSERT INTO list VALUES (?, ?);");
		mysqli_stmt_bind_param ($stmt, 'si', $username, $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	else {
		print "<script>alert('Please sign in to add to wish list')</script>";

							}
 }

 if(isset($_POST['watched']))
 {
	if  (isset($_COOKIE['username'])){
		$id =  $_COOKIE["movie_id"];
		$username = $_COOKIE['username'];
		$stmt = mysqli_prepare ($connect, "INSERT INTO watched VALUES (?, ?);");
		mysqli_stmt_bind_param ($stmt, 'si', $username, $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	else {
		print "<script>alert('Please sign in to add to watched list')</script>";
	}
 }

////////////////////////////////////


//Viewing the user reviews
echo "<div class='reviews'>";
print <<<USER_REV
<div class="user_reviews">
  <h3>User Reviews</h3>
  <div class="review_list" id="review_list_user">
    
  </div>
</div>
USER_REV;

print <<<OUT_REV
<div class="other_reviews">
  <h3>Verified Reviews</h3>
  <div class="review_list" id="review_list_verif">
  </div>
</div>
OUT_REV;
echo "</div>";



print <<<END
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script src="./js/template.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</body>
</html>
END;


?>
