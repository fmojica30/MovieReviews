const movie_id = "330457";

const changers = {
  "title": document.querySelector(".movie_head_title"),
  "poster": document.querySelector(".movie_poster"),
  "description": document.querySelector(".movie_head_description"),
  "vid1": document.getElementById("vid_review_1"),
  "vid2": document.getElementById("vid_review_2")
}

function update_movie_data(movie_id) {
  var data = "{}";

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      console.log(this.responseText);
      const info = JSON.parse(this.responseText);
      changers["title"].textContent = info["original_title"];
      changers["description"].textContent = info["overview"];
      changers["poster"].src = `https://image.tmdb.org/t/p/w500/${info["poster_path"]}`;
    }
  });

  xhr.open("GET", `https://api.themoviedb.org/3/movie/${movie_id}?api_key=6564f1b545f85dd02cc8e9efe58744a6&language=en-US`);

  xhr.send(data);
}

function get_reviews(movie_id) {
  var data = "{}";

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      console.log(this.responseText);
      const reviews = JSON.parse(this.responseText);
      console.log(reviews)
    }
  });

  xhr.open("GET", `https://api.themoviedb.org/3/movie/${movie_id}/reviews?language=en-US&api_key=6564f1b545f85dd02cc8e9efe58744a6`);

  xhr.send(data);
}

update_movie_data(movie_id);
get_reviews(movie_id);

