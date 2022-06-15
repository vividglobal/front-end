// Search find select option
$("document").ready(function(){
    $(".search--brand").on("keyup",function(e){
     let value = e.target.value
         $(".select__one").filter(function(){
             $(this).toggle($(this).find("p").text().toLowerCase().indexOf(value) > -1)
         })
     })

    $(".search--country").on("keyup",function(e){
        let value = e.target.value
            $(".select__one--country").filter(function(){
                $(this).toggle($(this).find("p").text().toLowerCase().indexOf(value) > -1)
            })
    })

    $(".btn--export--excel").on("click",function(){
        window.location.replace(`${window.location.pathname}?export=${true}`)
    })

    $(".list--showing").find("select").on("change",function(){
        let value = parseInt($("option:selected" ).text());
        window.location.replace(`${window.location.pathname}?perpage=${value}`)
    })

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const perpage = urlParams.get('perpage')
    if(perpage !== null){
        $(".list--showing").find("select").val(parseInt(perpage))
    }
})
