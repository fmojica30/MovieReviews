<?php
$cookie_name = 'movie_id';
unset($_COOKIE[$cookie_name]);
// empty value and expiration one hour before
$res = setcookie($cookie_name, '', time() - 3600);
//comment
print <<< HEAD
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Movie Reviews</title>
    <link rel="stylesheet" href="./css/index.css">
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
// Logging in to the databse
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
<a href="myPage.php">My Page</a>      
<a href="#">Home</a>
<a href="logOut.php">Log Out</a>
</div>
</div>
SIGN;
} else {
print <<<NOTIN
<div class="navBar">
<div class="nav">
<a href="#login-form" rel="modal:open">Login</a>
<form id="login-form" method="post" action="./logIn.php" class="modal">
<div class="login_modal">
<label for="username">Username: </label>
<input type="text" name="username" />
<label for="password">Password</label>
<input type="password" name="password">
<input type="submit" value="Login" name="submit"/>
<input type="reset" value="Reset" />
</div>
</form>
<a href="#">Home</a>
<a href="./registration.php">Sign Up</a>
</div>
</div>
NOTIN;
}

print<<< CONT
<div class="genres">
        <h4>Genres</h4>
        <button id="popular_button">Popular</button>
        <button id="now_play_button">Now Playing</button>
        <button id="top_rated_button">Top Rated</button>
        <button id="upcoming_button">Upcoming</button>
        <button>Historical</button>
        <button>Disney</button>
        <button>Latest</button>
      </div>
      <form class="featured" action="./pages/template/template.php" method="POST">
        <div class="feat_head">
          <h2 id="feat_title">Featured Movies</h2>
        </div>
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
      </form>
      <div class="vidReviews">
        <div class="vid_head">
          <h2>Featured Previews</h2>
        </div>
        <div class="trailer" id="trailer_1">
          <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/I3h9Z89U9ZA?controls=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
          <iframe width="560" height="315" src="https://www.youtube.com/embed/BVZDhunTrYA?controls=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="trailer" id="trailer_2">
          <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/BVZDhunTrYA?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
          <iframe width="560" height="315" src="https://www.youtube.com/embed/I3h9Z89U9ZA?controls=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
      <div class="reviews">
        <div class="user_review_header">
          <h2>Latest User Reviews</h2>
        </div>
        <div class="user_reviews" id="review_list_user">
        </div>
        <div class="creator_review_header">
          <h2>Latest Creator Reviews</h2>
        </div>
        <div class="creator_reviews">
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/dynam.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  </body>
</html>
CONT;
?>
