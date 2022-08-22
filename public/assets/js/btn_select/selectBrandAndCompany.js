$("document").ready(function(){
    var selectBrand = $(".select--company-or-brand");
    var selectOneBrand = $(".select__one");
    var btnBrand = $(".list--company--brand");


    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const parambrands = urlParams.get('company_brand_id')
    if(parambrands === null){
        $(".select__one:first-child").addClass("background-gray")
        $(".select__one:first-child").find("img").show()
    }

    selectOneBrand.on("click", function(){
        var value = $(this).find("p").html()
        var id = $(this).find("p").attr("data-id");
        if(value.indexOf("Select brand") === -1){
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

    btnBrand.click(function(e){
        if(e.target !== $(".search--brand")[0]){
            selectBrand.slideToggle(300,'linear');
            $(".no_search_result").hide()
        }
    })

    $(document).mouseup(function(e){
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width > 1113){
            if (!btnBrand.is(e.target) && btnBrand.has(e.target).length === 0) {
                selectBrand.hide()
                $(".no_search_result").hide()
            }
        }
            $(".select__one").css("display", "flex")
            $(".search--brand").val("")
    });

})
