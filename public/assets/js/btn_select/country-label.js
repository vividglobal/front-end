$("document").ready(function(){

    var selectCountry = $(".slc_suspected");
    var selectOneCountry = $(".option_suspected");
    var btnCountry = $(".ctr_suspected");
    var searchCountry = $(".search_suspected");

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const paramCountry = urlParams.get('country')

    if(paramCountry === null){
        $(".option_suspected:first-child").addClass("background-gray")
        $(".option_suspected:first-child").find("img").show()
    }

    selectOneCountry.on("click", function(){
        var value = $(this).find("p").html()
        var id = $(this).find("p").attr("data-id");
        if(value.indexOf("-") === -1){
            btnCountry.find("> p").html(value)
        }else{
            btnCountry.find("> p").html("Country")
        }
        btnCountry.find("> p").attr("data-id",id)
        selectOneCountry.removeClass("background-gray")
        selectOneCountry.find("img").hide()
        $(this).addClass("background-gray")
        $(this).find("img").show()
    })

    btnCountry.click(function(e){
        if(e.target !== $(this).find(".search--country")[0]){
            selectCountry.slideToggle(300,'linear');
            $(".no_search_result").hide()
        }
    })

    $(document).mouseup(function(e){
        //select country
        if (!btnCountry.is(e.target) && btnCountry.has(e.target).length === 0) {
                selectCountry.hide()
                $(".no_search_result").hide()
            }
    });
})
