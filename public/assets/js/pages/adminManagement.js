$(document).ready(function (){
    $(".search_admin").find(".list--search").keyup(function(){
        let value = $(this).find("input").val().toLowerCase();
        var div = $(".tbody_admin")
        div.filter(function(index,item){
            $(this).toggle(item.textContent.toLowerCase().indexOf(value) > -1)
            $(".no_search_reusult").hide()
            if(!div.is(':visible')){
                $(".no_search_reusult").show()
            }
        })
    });

    $(".search_admin > div:nth-child(2)").find(".open_Nav_filter").click(function(){
        $(".checkbox_mobi").hide()
        $(".border_gray").hide()
        $(".select--showing").closest(".checkbox_mobi").show()
        $(".border_gray:last-child").show()
    })
})
