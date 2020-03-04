function display_review(current) {
  const values = current.split(",");
  const username = values[0];
  const review = values[1];
  const title = values[2];
  const final_title = title + " By: " + username;
  document.getElementById("review_list_user").insertAdjacentHTML(
    "beforeend",
    `
      <div class="review">
        <img src="./images/logo_blue.png" alt="Logo" class="review_image">
        <p class="review_user">${final_title}</p>
        <p class="review_content">${review}</p>
      </div>`
  );
}

function get_reviews_db(movie_id) {
  var xhr = new XMLHttpRequest();
  var url = "../db_php/get_all_reviews.php?movie_id=" + escape(movie_id);
  xhr.open("GET", url, true);
  xhr.addEventListener("readystatechange", function() {
    if (this.readyState === this.DONE) {
      console.log(this.responseText);
      const data = JSON.parse(this.responseText);
      console.log(data);
      data.forEach(display_review);
    }
  });
  xhr.send(null);
}
function set_videos() {
      axios.get(`https://www.googleapis.com/youtube/v3/search?part=snippet&q=${'movie' + 'trailers'}&key=AIzaSyAKrJPn18AtQQIMxUCVUQL8BivItTZMZhY`)
        .then(res => {
            document.getElementById('preview1').src = `http://www.youtube.com/embed/${res.data.items[3].id.videoId}?enablejsapi=1`;
            document.getElementById('preview2').src = `http://www.youtube.com/embed/${res.data.items[1].id.videoId}?enablejsapi=1`;
          }
        )
        .catch(err => console.log(err));

}
get_reviews_db(330457);
set_videos();
