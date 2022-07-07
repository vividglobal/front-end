$("document").ready(function(){
    var selectViolation = $(".select--violation--type");
    var selectOneViolation = $(".select__one--violation--type");
    var btnViolation = $(".list--violation--type");

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const paramViolation = urlParams.get('violation_type_id')
    if(paramViolation === null){
        $(".select__one--violation--type:first-child").addClass("background-gray")
        $(".select__one--violation--type:first-child").find("img").show()
    }
    selectOneViolation.on("click", function(){
        var value = $(this).find("p").html()
        var id = $(this).find("p").attr("data-id");
        if(value.indexOf("-") === -1){
            btnViolation.find("> p").html(value)
        }else{
            btnViolation.find("> p").html("Violation type")
        }
        btnViolation.find("> p").attr("data-id",id)
        selectOneViolation.removeClass("background-gray")
        selectOneViolation.find("img").hide()
        $(this).addClass("background-gray")
        $(this).find("img").show()
    })

    $(document).mouseup(function(e){
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            if(width > 1113){
                if (!btnViolation.is(e.target) && btnViolation.has(e.target).length === 0) {
                    selectViolation.hide()
                }else{
                    selectViolation.slideToggle(300,'linear');
                }
            }
    });

})
