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
  var url = "/cs329e-mitra/moviereviews/db_php/get_all_reviews.php?movie_id=" + escape(movie_id);
  xhr.open("GET", url, true);
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      console.log(this.responseText);
      const data = JSON.parse(this.responseText);
      console.log(data);
      data.forEach(display_review);
    }
  });
  xhr.send(null);
}



get_reviews_db(330457);