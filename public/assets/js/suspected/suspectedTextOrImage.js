$("document").ready(function(){
    var inputs = document.querySelectorAll('.file-input')
    for (var i = 0, len = inputs.length; i < len; i++) {
        customInput(inputs[i])
    }

    //Checkbox suspected
        $(".suspected__text__area textarea").val("")
        $(".checkbox__suspected:first-child").find("input").attr("checked",true)
        $(".suspected__text__area textarea").attr("disabled",true).attr("placeholder","Enter the suspected text")
        $(".file-input").show()
        $(".checkbox__suspected:first-child").addClass("active_checked")


    $(".checkbox__suspected").on("click", function(){
            $(".checkbox__suspected").removeClass("active_checked")
            $(this).addClass("active_checked")
            $(".suspected__text__area textarea").val("")
            if($(this).find("input").attr("id") === "image"){
                $(".suspected__text__area textarea").attr("disabled",true).attr("placeholder","Enter the suspected text")
                $(".file-input").show()
            }else{
                $(".suspected__text__area textarea").removeAttr("disabled").attr("placeholder","Enter the suspected link").focus()
                $(".file-input").hide()

            }
    })

    function customInput (el) {
    const fileInput = el.querySelector('[type="file"]')
    fileInput.onchange =
        fileInput.onmouseout = function () {
            if (!fileInput.value) return
            var value = fileInput.value.replace(/^.*[\\\/]/, '')
            el.className += ' -chosen'
            $(".suspected__text__area textarea").val(value)
        }
    }

    // $(".country_mobi").find(".slc_general").css({"display":"none"})
})
