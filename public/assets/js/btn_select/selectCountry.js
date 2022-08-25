$("document").ready(function(){

    var selectCountry = $(".slc_general");
    var selectOneCountry = $(".option_general");
    var btnCountry = $(".ctr_general");

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const paramCountry = urlParams.get('country')

    if(paramCountry === null){
        $(".option_general:first-child").addClass("background-gray")
        $(".option_general:first-child").find("img").show()
    }

    selectOneCountry.on("click", function(){
        var value = $(this).find("p").html()
        var id = $(this).find("p").attr("data-id");
        if(value.indexOf("Select country") === -1){
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
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        //select country
        if(width >1113){
            if (!btnCountry.is(e.target) && btnCountry.has(e.target).length === 0 ) {
                selectCountry.hide()
                $(".no_search_result").hide()
            }
        }

        $(".select__one--country").css("display", "flex")
        $(".search--country").val("")
    });
})
