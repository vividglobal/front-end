function BackUrl(name1,name2){
    setTimeout(() => {
        window.location.replace(window.location.pathname.replace(articleId + name1, name2));
    },2000);
}
function ClickButonLink(){
    $('.onclick-link-check').click(function() {
        show_error('Link does not exist')
    })
}