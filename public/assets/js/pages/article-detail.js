$(document).ready(function(){
    let modalconfim = $('.modal-title-mobile');


    $(".history-back").click(function(){
        console.log(true);
        history.back(1);
    })

    $(".btn-violation").click(function(){
        modalconfim.show();
        $("#confirm-violation").click(function(){
            
        })
    })
})