// Search find select option
$("document").ready(function(){
    $(".search--brand").on("input",function(e){
     let value = e.target.value.toLowerCase().trim()
         $(".select__one").filter(function(){
             $(this).toggle($(this).find("p").text().toLowerCase().includes(value))
         })
        if($(".select__one:visible").length <= 0){
            $(".no_search_result").show()
        }else{
            $(".no_search_result").hide()
        }
     })

    $(".search--country").on("input",function(e){
        let value = e.target.value.toLowerCase().trim()
            $(".select__one--country").filter(function(){
                $(this).toggle($(this).find("p").text().toLowerCase().includes(value))
            })
        if($(".select__one--country:visible").length == 0){
            $(".no_search_result").show()
        }else{
            $(".no_search_result").hide()
        }
    })

})
