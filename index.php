<?php
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
//Logging in to the databse
$host = 'fall-2019.cs.utexas.edu';
$user = 'cs329e_mitra_milica96';
$pwd = 'crux$Crept*task';
$dbs = 'cs329e_mitra_milica96';
$port = '3306';
$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

// $test = $_COOKIE['username'];
// echo $test;

if (empty($connect)) {
  die("mysqli_connect failed: " . mysqli_connect_error());
}

$table = "user";

$script = $_SERVER['PHP_SELF'];

if (isset($_COOKIE['username'])) {
  print <<<SIGN
<div class="navBar">
<div class="nav">
<a href="#">Welcome {$_COOKIE['username']}!</a>       
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
<form id="login-form" method="post" action=$script class="modal">
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
        <button>Latest</button>
        <button>Action</button>
        <button>Horror</button>
        <button>Family</button>
        <button>Historical</button>
        <button>Disney</button>
        <button>Latest</button>
      </div>
      <div class="featured">
        <div class="feat_head">
          <h2>Upcoming Movies</h2>
        </div>
        <div class="movie_1 movie_display">
          <a href="#">
            <img src="./images/fordvferrari.png" alt="Ford V Ferrari">
          </a>
        </div>
        <div class="movie_2 movie_display">
          <a href="#">
            <img src="./images/Frozen_2.jpg" alt="Frozen 2">
          </a>
        </div>
        <div class="movie_3 movie_display">
          <a href="#">
            <img src="./images/Spies_in_Disguise.jpeg" alt="Spies in Disguise">
          </a>
        </div>
      </div>
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
        <div class="user_reviews">
          <div class="review">
            <p class="reviewTitle">Movie: Reviewer Name</p>
            <p class="reviewContent">Review Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat nihil sit obcaecati maiores ab sint, exercitationem aspernatur cum iure facere, rem fugiat vero voluptas inventore deserunt excepturi nulla vel ducimus sequi tenetur veniam eaque. Doloremque ipsam cum animi porro pariatur libero! Error officiis laboriosam dolorum odio excepturi necessitatibus et dolor quia ab, officia adipisci quidem ducimus voluptatum atque suscipit repudiandae quis nam vero itaque. Distinctio expedita quam, nihil tempora, voluptatibus eveniet molestias voluptatem beatae debitis voluptas ratione quos sunt totam?</p>
          </div>
          <div class="review">
            <p class="reviewTitle">Movie: Reviewer Name</p>
            <p class="reviewContent">Review Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat nihil sit obcaecati maiores ab sint, exercitationem aspernatur cum iure facere, rem fugiat vero voluptas inventore deserunt excepturi nulla vel ducimus sequi tenetur veniam eaque. Doloremque ipsam cum animi porro pariatur libero! Error officiis laboriosam dolorum odio excepturi necessitatibus et dolor quia ab, officia adipisci quidem ducimus voluptatum atque suscipit repudiandae quis nam vero itaque. Distinctio expedita quam, nihil tempora, voluptatibus eveniet molestias voluptatem beatae debitis voluptas ratione quos sunt totam?</p>
          </div>
          <div class="review">
            <p class="reviewTitle">Movie: Reviewer Name</p>
            <p class="reviewContent">Review Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat nihil sit obcaecati maiores ab sint, exercitationem aspernatur cum iure facere, rem fugiat vero voluptas inventore deserunt excepturi nulla vel ducimus sequi tenetur veniam eaque. Doloremque ipsam cum animi porro pariatur libero! Error officiis laboriosam dolorum odio excepturi necessitatibus et dolor quia ab, officia adipisci quidem ducimus voluptatum atque suscipit repudiandae quis nam vero itaque. Distinctio expedita quam, nihil tempora, voluptatibus eveniet molestias voluptatem beatae debitis voluptas ratione quos sunt totam?</p>            
          </div>
          <div class="review">
        
          </div>
        </div>
        <div class="creator_review_header">
          <h2>Latest Creator Reviews</h2>
        </div>
        <div class="creator_reviews">
          <div class="review">
            <p class="reviewTitle">Movie: Reviewer Name</p>
            <p class="reviewContent">Review Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat nihil sit obcaecati
              maiores ab sint, exercitationem aspernatur cum iure facere, rem fugiat vero voluptas inventore deserunt excepturi
              nulla vel ducimus sequi tenetur veniam eaque. Doloremque ipsam cum animi porro pariatur libero! Error officiis
              laboriosam dolorum odio excepturi necessitatibus et dolor quia ab, officia adipisci quidem ducimus voluptatum atque
              suscipit repudiandae quis nam vero itaque. Distinctio expedita quam, nihil tempora, voluptatibus eveniet molestias
              voluptatem beatae debitis voluptas ratione quos sunt totam?</p>
          </div>
          <div class="review">
            <p class="reviewTitle">Movie: Reviewer Name</p>
            <p class="reviewContent">Review Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat nihil sit obcaecati
              maiores ab sint, exercitationem aspernatur cum iure facere, rem fugiat vero voluptas inventore deserunt excepturi
              nulla vel ducimus sequi tenetur veniam eaque. Doloremque ipsam cum animi porro pariatur libero! Error officiis
              laboriosam dolorum odio excepturi necessitatibus et dolor quia ab, officia adipisci quidem ducimus voluptatum atque
              suscipit repudiandae quis nam vero itaque. Distinctio expedita quam, nihil tempora, voluptatibus eveniet molestias
              voluptatem beatae debitis voluptas ratione quos sunt totam?Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam officiis magnam assumenda, aut eum modi totam mollitia quae harum iste vel odio, aliquam id aspernatur sit nihil suscipit porro nam!</p>
          </div>
          <div class="review">
            <p class="reviewTitle">Movie: Reviewer Name</p>
            <p class="reviewContent">Review Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat nihil sit obcaecati
              maiores ab sint, exercitationem aspernatur cum iure facere, rem fugiat vero voluptas inventore deserunt excepturi
              nulla vel ducimus sequi tenetur veniam eaque. Doloremque ipsam cum animi porro pariatur libero! Error officiis
              laboriosam dolorum odio excepturi necessitatibus et dolor quia ab, officia adipisci quidem ducimus voluptatum atque
              suscipit repudiandae quis nam vero itaque. Distinctio expedita quam, nihil tempora, voluptatibus eveniet molestias
              voluptatem beatae debitis voluptas ratione quos sunt totam?</p>
          </div>
          <div class="review">
            <p class="reviewTitle">Movie: Reviewer Name</p>
            <p class="reviewContent">Review Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat nihil sit obcaecati
              maiores ab sint, exercitationem aspernatur cum iure facere, rem fugiat vero voluptas inventore deserunt excepturi
              nulla vel ducimus sequi tenetur veniam eaque. Doloremque ipsam cum animi porro pariatur libero! Error officiis
              laboriosam dolorum odio excepturi necessitatibus et dolor quia ab, officia adipisci quidem ducimus voluptatum atque
              suscipit repudiandae quis nam vero itaque. Distinctio expedita quam, nihil tempora, voluptatibus eveniet molestias
              voluptatem beatae debitis voluptas ratione quos sunt totam?</p>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  </body>
</html>
CONT;

function purge ($str){
  $purged_str = preg_replace("/\W/", "", $str);
  return $purged_str;
}

if(isset($_POST["submit"])) {
  $username = purge($_POST["username"]);
  $password = purge($_POST["password"]);
  $sql = "select * from user where username = '$username' and password = '$password'";
  $result = mysqli_query ($connect, $sql);
  $row = $result->fetch_row();

  if (empty($row)) {
    $message = "Username/Password does not exist";
    echo "<script type='text/javascript'>alert('$message');</script>";
  } else {
    $message = "Successfully Logged in";
    session_start();
    setcookie("username", $username, time()+3600);
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("location:index.php");
  }
}

?>