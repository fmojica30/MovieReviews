const genre_data = {};

function set_movie_id_cookie(value) {
  document.cookie = `movie_id=${value}`;
}

function get_random_numbers() {
  let nums = []
  while (nums.length <= 6){
    r = Math.floor(Math.random() * 10);
    if (nums.indexOf(r) === -1) {
      nums.push(r);
    }
  }
  return nums
}

function display_results_data(data) {
  const rand_nums = get_random_numbers();
  const movies_posters = {
    'first_movie': data['results'][rand_nums[0]]['poster_path'],
    'second_movie': data['results'][rand_nums[1]]['poster_path'],
    'third_movie': data['results'][rand_nums[2]]['poster_path'],
    'forth_movie': data['results'][rand_nums[3]]['poster_path'],
    'fifth_movie': data['results'][rand_nums[4]]['poster_path'],
    'sixth_movie': data['results'][rand_nums[5]]['poster_path'],

  };

  const movie_ids = {
    'first_movie': data['results'][rand_nums[0]]['id'],
    'second_movie': data['results'][rand_nums[1]]['id'],
    'third_movie': data['results'][rand_nums[2]]['id'],
    'forth_movie': data['results'][rand_nums[3]]['id'],
    'fifth_movie': data['results'][rand_nums[4]]['id'],
    'sixth_movie': data['results'][rand_nums[5]]['id'],

  };
  console.log(movie_ids);
  document.getElementById('movie_id_1').value = movie_ids['first_movie'];
  document.getElementById('movie_id_2').value = movie_ids['second_movie'];
  document.getElementById('movie_id_3').value = movie_ids['third_movie'];
  document.getElementById('movie_id_4').value = movie_ids['fortf_movie'];
  document.getElementById('movie_id_5').value = movie_ids['fifth_movie'];
  document.getElementById('movie_id_6').value = movie_ids['sixth_movie'];
  document.getElementById('feat_1').src = `https://image.tmdb.org/t/p/w500/${movies_posters['first_movie']}`;
  document.getElementById('feat_2').src = `https://image.tmdb.org/t/p/w500/${movies_posters['second_movie']}`;
  document.getElementById('feat_3').src = `https://image.tmdb.org/t/p/w500/${movies_posters['third_movie']}`;
  document.getElementById('feat_4').src = `https://image.tmdb.org/t/p/w500/${movies_posters['forth_movie']}`;
  document.getElementById('feat_5').src = `https://image.tmdb.org/t/p/w500/${movies_posters['fifth_movie']}`;
  document.getElementById('feat_6').src = `https://image.tmdb.org/t/p/w500/${movies_posters['sixth_movie']}`;
}




function get_top_rated() {
  var data = "{}";

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      const data1 = JSON.parse(this.responseText);
      console.log(data1);
      display_results_data(data1);
    }
  });

  xhr.open("GET", "https://api.themoviedb.org/3/movie/top_rated?page=1&language=en-US&api_key=6564f1b545f85dd02cc8e9efe58744a6");

  xhr.send(data);

}

function get_now_playing(genre) {
  alert (genre);
  var id = document.cookie.split(";")[3];
  var data = "{}";
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      const data2 = JSON.parse(this.responseText);
      console.log(data2);
      display_results_data(data2);
    }
  });

  xhr.open("GET", "https://api.themoviedb.org/3/movie/129/similar?api_key=6564f1b545f85dd02cc8e9efe58744a6");

  xhr.send(data);
}


window.addEventListener('load', get_top_rated);
//document.getElementById('now_play_button').addEventListener('click', get_now_playing);
//get_now_playing();
