let geTtoken;
function onSubmit(token) {
    geTtoken = token
}

function validate(event,token) {
  event.preventDefault();
  if(geTtoken !== undefined && $(".suspected__text__area textarea").val()!== ""){

  }
}

function onload() {
  var element = document.getElementById('submit');
  element.onclick = validate;
}