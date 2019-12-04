function displayReplies(e) {
  var replyID = e.currentTarget.id;
  var result = replyID.match(/\d+/g);
  var replyIDBlock = "replyBlock-" + result;

  var replyIdDom = document.getElementById(replyIDBlock);

  if (replyIdDom.style.display === "block") {
    replyIdDom.style.display = "none";
  } else {
    replyIdDom.style.display = "block";
  }
}

function displayMessage(msg) {
  var error = document.getElementById("globalError");
  error.innerHTML += `<div class='container-fluid'><div class='row'><div class='col-sm-12 d-flex justify-content-center'><h3>${msg}</h3></div></div></div>`;

  setTimeout(function() {
    error.innerHTML = "";
  }, 3000);
}
