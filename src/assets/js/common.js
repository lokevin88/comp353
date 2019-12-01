function displayMessage(msg) {
  var error = document.getElementById("globalError");
  error.style.color = "red";
  error.innerHTML += `<div class='container-fluid'><div class='row'><div class='col-sm-12 d-flex justify-content-center'><h3>${msg}</h3></div></div></div>`;

  setTimeout(function() {
    error.innerHTML = "";
  }, 3000);
}

function displayReplies(e) {}
