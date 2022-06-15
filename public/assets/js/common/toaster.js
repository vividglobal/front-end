function show_success(message) {
    render_toaster('success', message)
}

function show_error(message) {
    render_toaster('error', message)
}

function render_toaster(cssClass, message) {
    const toaster = document.createElement("div");
    toaster.setAttribute('id', 'toaster') // Set unique id
    toaster.classList.add('snackbar') // Style toaster and it is hidden toaster by default
    toaster.classList.add('show') // Display toaster
    toaster.classList.add(cssClass) // success or error styles
    toaster.innerText = message // Set toaster message
    document.body.appendChild(toaster)

    setTimeout(() => {
        document.getElementById('toaster').remove();
    }, 3000); // Show toaster in 3 sec then remove it
}