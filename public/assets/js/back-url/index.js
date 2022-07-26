function BackUrl(name1,name2){
    setTimeout(() => {
        window.location.replace(window.location.pathname.replace(articleId + name1, name2));
    },2000);
}