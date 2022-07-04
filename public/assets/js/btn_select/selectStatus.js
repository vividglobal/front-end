$("document").ready(function(){
    var selectViolation = $(".select--status");
    var selectOneViolation = $(".select__one--status");
    var btnViolation = $(".list--status");

    let targetEL ;
    btnViolation.filter(function(){
        let getData_id = $(this).find("> p").attr("data-id");
        $(this).find(".select--status").find(`> #${getData_id}`).addClass("background-gray")
        $(this).find(".select--status").find(`> #${getData_id}`).find("img").show()
    })

    selectOneViolation.on("click", function(){
        var value = $(this).find("p").html()
        var id = $(this).find("p").attr("data-id");
        var idrow = $(`#${targetEL}`).attr("data-idEL");
        $(`#${targetEL}`).find("> p").html(value)
        $(`#${targetEL}`).find("> p").attr("data-id",id)
        $(`#${targetEL}`).find(".select--status").find(".select__one--status").removeClass("background-gray")
        $(`#${targetEL}`).find(".select--status").find(".select__one--status").find("img").hide()
        $(this).addClass("background-gray")
        $(this).find("img").show()

        const url = `${idrow}/switch-progress-status`;
        let csrf = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            method: "PUT",
            url: url,
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            data:{
                "progress_status" : id.toUpperCase(),
            }
        })
        .done(function( msg ) {
            window.location.href = window.location.href
        });
    })

    btnViolation.click(function(event) {
        let idEl = $(this).attr("id")
        targetEL = idEl;
        $(".list--status").not(this).find(".select--status").hide()
        $(this).find(".select--status").toggle();


    });

    $(document).mouseup(function(e){
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            if(width > 1113){
                if (!btnViolation.is(e.target) && btnViolation.has(e.target).length === 0) {
                    selectViolation.hide()
                }
            }
    });
})
