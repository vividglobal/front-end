function show_overlay() {
    const loaderContainer = document.createElement("div");
    loaderContainer.setAttribute('id', 'loader-container');
    loaderContainer.classList.add('text')
    loaderContainer.classList.add('loading-overlay')
    document.body.appendChild(loaderContainer)
}

function hide_overlay() {
    document.getElementById('loader-container').remove();
}

function add_loader(el) {
    $(el).html('<div class="loader"></div>')
}

function remove_loader(el) {
    $(el).find('.loader').remove();
}