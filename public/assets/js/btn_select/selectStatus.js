$("document").ready(function(){
    var selectCountry = $("#dropdown-language");
    var btn = $(".list--select-right");
    var dropdown = $(".dropdown-content");
    var selectOneCountry = $(".dropdown-items");
    var btnCountry = $("btn-select");
    // $(".dropdown-items:first-child").addClass("background-gray")
    $(btn).click(function(e){
        // dropdown.hide();
        $(this).find(dropdown).slideToggle(300,'linear');
    });

    selectOneCountry.on("click", function(){
        var value = $(this).find("p").html()
        var value = $(this).find("p").html()
        if(value.indexOf("-") === -1){
            btnCountry.find("p").html(value)
        }else{
            btnCountry.find("p").html("Country")
        }
    })
    // $(document).mouseup(function(e){
    //     dropdown.hide();
    // });
})
