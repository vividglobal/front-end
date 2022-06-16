// Search find select option
$("document").ready(function(){
    $(".search--brand").on("keyup",function(e){
     let value = e.target.value.toLowerCase()
         $(".select__one").filter(function(){
             $(this).toggle($(this).find("p").text().toLowerCase().indexOf(value) > -1)
         })
     })

    $(".search--country").on("keyup",function(e){
        let value = e.target.value.toLowerCase()
            $(".select__one--country").filter(function(){
                $(this).toggle($(this).find("p").text().toLowerCase().indexOf(value) > -1)
            })
    })

    $(".btn--export--excel").on("click",function(){
        window.location.replace(`${window.location.pathname}?export=${true}`)
    })

})
