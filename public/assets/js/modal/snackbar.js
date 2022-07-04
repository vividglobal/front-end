function openSnackBar(text,time) {
    var x = document.getElementById("snackbar");
    x.className = "show_snackbar";
    x.innerText = text;
    setTimeout(function () {
    x.className = x.className.replace("show", "");
    }, time);
}
