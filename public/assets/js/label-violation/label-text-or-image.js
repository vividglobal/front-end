$("document").ready(function(){
    var inputs = document.querySelectorAll('.file-input_detect')
    for (var i = 0, len = inputs.length; i < len; i++) {
        customInput(inputs[i])
    }

    //Checkbox suspected
        $(".suspected__text__area textarea").val("")
        $(".checkbox__suspected:first-child").find("input").attr("checked",true)
        $(".suspected__text__area textarea").attr("placeholder","Enter the suspected text")
        $(".file-input_detect").show()
        $(".checkbox__suspected:first-child").addClass("active_checked")


    $(".checkbox__suspected").on("click", function(){
            $(".checkbox__suspected").removeClass("active_checked")
            $(this).addClass("active_checked")
            $(".suspected__text__area textarea").val("")
            $("#submit_form").css("background","var(--gray-C7)")
            $(".file-input_detect .label").text("Or drop the image here")
            $(".file-input_detect input").val("")
            if($(this).find("input").attr("id") === "image"){
                $(".suspected__text__area textarea").attr("placeholder","Enter the suspected text").focus()
                $(".file-input_detect").show()
                $(".check_demo").show()
                $(".check_country").show()
            }else{
                $(".suspected__text__area textarea").attr("placeholder","Enter the suspected link").focus()
                $(".file-input_detect").hide()
                $(".check_demo").hide()
                $(".check_country").hide()
            }
    })

    $(".suspected__text__area").on('input',function(e){
        let value = $(this).find("textarea").val().trim()
        if(value !== ""){
            $("#submit_form").css("background","var(--pink_new)")
        }else{
            $("#submit_form").css("background","var(--gray-C7)")
        }
    })

    function customInput (el) {
    const fileInput = el.querySelector('[type="file"]')
        fileInput.onchange =
        fileInput.onmouseout = function () {
            if (!fileInput.value) return
            var value = fileInput.value.replace(/^.*[\\\/]/, '')
            el.className += ' -chosen'
            $(".suspected__file__area").find(".file-input_detect").find(".label").text(value)
            $("#submit_form").css("background","var(--pink_new)")
        }
    }

})
