const cookie = document.cookie;

function parse_cookie(c) {
  let p1 = c.split(";");
  let obj = {};
  p1.forEach(element => {
    let p2 = element.split("=");
    obj[p2[0]] = p2[1];
  });
  return obj;
}

const cookie_obj = parse_cookie(cookie);

const movie_id = cookie_obj['movie_id'];

const changers = {
  "title": document.querySelector(".movie_head_title"),
  "poster": document.querySelector(".movie_poster"),
  "description": document.querySelector(".movie_head_description"),
  "vid1": document.getElementById("vid_review_1"),
  "vid2": document.getElementById("vid_review_2"),
  "preview": document.getElementById("preview"),
  "header": document.getElementById("favicon_change")
}

function set_videos(movie_id) {
	axios
		.get(`https://api.themoviedb.org/3/movie/${movie_id}?api_key=6564f1b545f85dd02cc8e9efe58744a6&language=en-US`)
		.then(res => {
      axios.get(`https://www.googleapis.com/youtube/v3/search?part=snippet&q=${res.data.original_title + 'preview'}&key=AIzaSyAKrJPn18AtQQIMxUCVUQL8BivItTZMZhY`)
        .then(res => {
            changers.preview.src = `http://www.youtube.com/embed/${res.data.items[0].id.videoId}?enablejsapi=1`;
          }
        )
        .catch(err => console.log(err));
      
      axios.get(`https://www.googleapis.com/youtube/v3/search?part=snippet&q=${res.data.original_title + 'review'}&key=AIzaSyAKrJPn18AtQQIMxUCVUQL8BivItTZMZhY`)
        .then(res => {
            changers.vid1.src = `http://www.youtube.com/embed/${res.data.items[0].id.videoId}?enablejsapi=1`;
            changers.vid2.src = `http://www.youtube.com/embed/${res.data.items[1].id.videoId}?enablejsapi=1`;
          }
        )
        .catch(err => console.log(err));
    })
  	.catch(err => console.log(err))

}

function update_movie_data(movie_id) {
  var data = "{}";

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      const info = JSON.parse(this.responseText);
      changers["title"].textContent = info["original_title"];
      changers["description"].textContent = info["overview"];
      changers["poster"].src = `https://image.tmdb.org/t/p/w500/${info["poster_path"]}`;
      changers["header"].textContent = info["original_title"] + " || Movi";
    }
  });

  xhr.open("GET", `https://api.themoviedb.org/3/movie/${movie_id}?api_key=6564f1b545f85dd02cc8e9efe58744a6&language=en-US`);

  xhr.send(data);
}

function get_movie_data(movie_id) {
  var data = "{}";

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      const info = JSON.parse(this.responseText);
      return info;
    }
  });

  xhr.open("GET", `https://api.themoviedb.org/3/movie/${movie_id}?api_key=6564f1b545f85dd02cc8e9efe58744a6&language=en-US`);

  xhr.send(data);
}

function get_movie_reviews_api(movie_id) {
  var data = "{}";

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      console.log(this.responseText);
      const revs = (JSON.parse(this.responseText))["results"];
      console.log(revs);
      revs.forEach(display_api_review);
    }
  });

  xhr.open("GET", `https://api.themoviedb.org/3/movie/${movie_id}/reviews?page=1&language=en-US&api_key=6564f1b545f85dd02cc8e9efe58744a6`);

  xhr.send(data);

}

function display_api_review(current) {
  const author = current["author"];
  const content = current["content"];
  document.getElementById('review_list_verif').insertAdjacentHTML("beforeend", `
      <div class="review">
        <img src="./images/logo_blue.png" alt="Logo" class="review_image">
        <p class="review_user">${author}</p>
        <p class="review_content">${content}</p>
      </div>`)
}

function display_review(current) {
  const values = current.split(",");
  const username = values[0];
  const review = values[2];
  const title = values[3];
  const final_title = title + " By: " + username;
  document.getElementById('review_list_user').insertAdjacentHTML("beforeend", `
      <div class="review">
        <img src="./images/logo_blue.png" alt="Logo" class="review_image">
        <p class="review_user">${final_title}</p>
        <p class="review_content">${review}</p>
      </div>`)
}

function get_reviews_db(movie_id) {
  var xhr = new XMLHttpRequest();
  var url = "/cs329e-mitra/moviereviews/db_php/get_review.php?movie_id=" + escape(movie_id);
  xhr.open("GET", url, true);
  xhr.addEventListener("readystatechange", function() {
    if(this.readyState === this.DONE) {
      console.log(this.responseText);
      const data = JSON.parse(this.responseText);
      console.log(data);
      data.forEach(display_review);
    }
  });
  xhr.send(null);
}

set_videos(movie_id);
update_movie_data(movie_id);
get_reviews_db(movie_id);
get_movie_reviews_api(movie_id);
