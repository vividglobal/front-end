$(document).ready(function(){
    $(".checkbox_title").click(function(){
        $(".checkbox_title").not(this).closest(".checkbox_mobi").find("#toggle").hide()
        $(this).closest(".checkbox_mobi").find("#toggle").slideToggle(300,'linear')
    })

    $(".select__one").change(function(){
        let value =  $(this).find("p").text()
        let id  = $(this).find("p").attr("data-id")
        $(".select__one").find("input").prop('checked',false)
        $(".select__one").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        $(this).closest(".contain--selection").closest(".select--company-or-brand").closest(".checkbox_mobi").find("> p").text(value)
        $(this).closest(".contain--selection").closest(".select--company-or-brand").closest(".checkbox_mobi").find("> p").attr("data-id",id)
    })

    $(".select__one--country").change(function(){
        let value =  $(this).find("p").text()
        let id  = $(this).find("p").attr("data-id")
        $("select__one--country").find("input").prop('checked',false)
        $(".select__one--country").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        $(this).closest(".contain--selection").closest(".select--country").closest(".checkbox_mobi").find("> p").text(value)
        $(this).closest(".contain--selection").closest(".select--country").closest(".checkbox_mobi").find("> p").attr("data-id",id)
    })

    $(".select__one--violation--type").change(function(){
        let value =  $(this).find("p").text()
        let id  = $(this).find("p").attr("data-id")
        $("select__one--violation--type").find("input").prop('checked',false)
        $(".select__one--violation--type").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        $(this).closest(".select--violation--type").closest(".checkbox_mobi").find("> p").text(value)
        $(this).closest(".select--violation--type").closest(".checkbox_mobi").find("> p").attr("data-id",id)
    })

    function resetFiter(){
        $("#myFilter").removeClass("open_menu")
        $(".overlay").css({"width":"0%","display":"none"})
        $(".checkbox_mobi").find("#toggle").hide()
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
    }

    $(".close__filter").click(function() {
        resetFiter()
    })

    // $(".btn__apply").click(function() {
    //     let date = $('input[name="daterange"]').val();
    //     let brand = $(".select--company-or-brand").closest(".checkbox_mobi").find("p").attr("data-id")
    //     let country = $(".select--country").closest(".checkbox_mobi").find("p").attr("data-id")
    //     let violation = $(".select--violation--type").closest(".checkbox_mobi").find("p").attr("data-id")
    //     // resetFiter()
    // })

})


