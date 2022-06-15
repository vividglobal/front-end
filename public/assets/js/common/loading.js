function show_loading() {
    const loaderContainer = document.createElement("div");
    loaderContainer.setAttribute('id', 'loader-container');
    loaderContainer.classList.add('text')
    loaderContainer.classList.add('loading-overlay')
    document.body.appendChild(loaderContainer)
}

function hide_loading() {
    document.getElementById('loader-container').remove();
}