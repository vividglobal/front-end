$("document").ready(function(){

    var selectCountry = $("#language");
    var selectOneCountry = $(".select__one--country");
    var btnCountry = $("#btn-language");
    var searchCountry = $("#language-search");

    $(".select__one--country:first-child").addClass("background-gray")

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
        var inputCountry = $("#div-search")
        if (!btnCountry.is(e.target) && btnCountry.has(e.target).length === 0) {
                selectCountry.hide()
            }else{
                if (!inputCountry.is(e.target) && inputCountry.has(e.target).length === 0)
                {
                        selectCountry.slideToggle(300,'linear');
                        searchCountry.val("")
                }
        }
    });


})
