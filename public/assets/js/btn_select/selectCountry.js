$("document").ready(function(){

    var selectCountry = $(".slc_general");
    var selectOneCountry = $(".option_general");
    var btnCountry = $(".ctr_general");
    var searchCountry = $(".search_general");

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

    $(document).mouseup(function(e){
        //select country
        if (!btnCountry.is(e.target) && btnCountry.has(e.target).length === 0) {
                selectCountry.hide()
            }else{
                if (!searchCountry.is(e.target) && searchCountry.has(e.target).length === 0)
                {
                        selectCountry.slideToggle(300,'linear');
                        searchCountry.val("")
                }
        }
        $(".select__one--country").css("display", "flex")
        $(".search--country").val("")
    });
})
