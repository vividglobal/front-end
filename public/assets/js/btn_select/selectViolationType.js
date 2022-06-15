$("document").ready(function(){
    var selectViolation = $(".select--violation--type");
    var selectOneViolation = $(".select__one--violation--type");
    var btnViolation = $(".list--violation--type");

    $(".select__one--violation--type:first-child").addClass("background-gray")

    selectOneViolation.on("click", function(){
        var value = $(this).find("p").html()
        if(value.indexOf("-") === -1){
            btnViolation.find("> p").html(value)
        }else{
            btnViolation.find("> p").html("Violation type")
        }

        selectOneViolation.removeClass("background-gray")
        selectOneViolation.find("img").hide()
        $(this).addClass("background-gray")
        $(this).find("img").show()
    })

    $(document).mouseup(function(e){
        if (!btnViolation.is(e.target) && btnViolation.has(e.target).length === 0) {
            selectViolation.hide()
        }else{
            selectViolation.slideToggle(300,'linear');
        }
    });
})
