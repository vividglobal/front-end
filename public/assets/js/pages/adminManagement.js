$(document).ready(function (){
    $(".search_admin").find(".list--search").keyup(function(){
        let value = $(this).find("input").val().toLowerCase();
        var div = $(".tbody_admin")
        div.filter(function(){
            $(this).toggle($(this).find("li").text().toLowerCase().indexOf(value) > -1)
            $(".no_search_reusult").hide()
            if(!div.is(':visible')){
                $(".no_search_reusult").show()
            }
        })
    });
})
