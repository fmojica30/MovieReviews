function authenticate() {
  return gapi.auth2.getAuthInstance()
    .signIn({
      scope: "https://www.googleapis.com/auth/youtube.force-ssl"
    })
    .then(function () {
        console.log("Sign-in successful");
      },
      function (err) {
        console.error("Error signing in", err);
      });
}

function loadClient() {
  gapi.client.setApiKey("AIzaSyB72uCM3V1V0tRfg9YFqyrHM56uktX61qI");
  return gapi.client.load("https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest")
    .then(function () {
        console.log("GAPI client loaded for API");
      },
      function (err) {
        console.error("Error loading GAPI client for API", err);
      });
}
// Make sure the client is loaded and sign-in is complete before calling this method.
function execute() {
  return gapi.client.youtube.search.list({
      "part": "snippet",
      "q": "frozen II trailer"
    })
    .then(function (response) {
        // Handle the results here (response.result has the parsed body).
        console.log("Response", response);
      },
      function (err) {
        console.error("Execute error", err);
      });
}
gapi.load("client:auth2", function () {
  gapi.auth2.init({
    client_id: "116897091444302278399"
  });
});