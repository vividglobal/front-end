$(document).ready(function (){

    $(".search_admin > div").find(".open_Nav_filter").click(function(){
        $(".checkbox_mobi").hide()
        $(".border_gray").hide()
        $(".select--showing").closest(".checkbox_mobi").show()
        $(".border_gray:last-child").show()
    })
})
