$("document").ready(function(){
    var selectBrand = $(".select--company-or-brand");
    var selectOneBrand = $(".select__one");
    var btnBrand = $(".list--company--brand");

    $(".select__one:first-child").addClass("background-gray")

    selectOneBrand.on("click", function(){
        var value = $(this).find("p").html()
        var id = $(this).find("p").attr("data-id");
        if(value.indexOf("-") === -1){
            btnBrand.find("> p").html(value)
        }else{
            btnBrand.find("> p").html("Brand/Company")
        }
        btnBrand.find("> p").attr("data-id",id)
        selectOneBrand.removeClass("background-gray")
        selectOneBrand.find("img").hide()
        $(this).addClass("background-gray")
        $(this).find("img").show()
    })

    $(document).mouseup(function(e){
        var input = $(".search--input");
            if (!btnBrand.is(e.target) && btnBrand.has(e.target).length === 0) {
                selectBrand.hide()
            }else{
                if (!input.is(e.target) && input.has(e.target).length === 0)
                    {
                        selectBrand.slideToggle(300,'linear');
                    }
            }
    });

})
