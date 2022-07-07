let modalconfim = $('.modal-confirm-title')
let btnSwitch = $('.btn-switch');
let span = $('.close');
let articleId;

btnSwitch.click(function () {
    let id = $(this).attr("data-id")
    modalconfim.show();
    $(".mdl-js").css("overflow-y","hidden");
    let url = ""+id+"/action-reset"
    let csrf = $('meta[name="csrf-token"]').attr('content')
    currentRow = $(this).parents('.scroll-table');
    articleId = currentRow.attr('data-id');
    $("#confirm-yes").click(function(){
        show_overlay()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            method: "PUT",
            url: url,
        })
        .done(function( msg ) {
            removeCurrentRow()
            hide_overlay()
            if(msg){
                show_success("This post has been moved to auto - detect violation list");
            }
        })
        .fail(function(){
            hide_overlay()
            show_error("This post go to failed state");
        })
        modalconfim.hide();
        $('input[type=checkbox]').each(function()
        {
                this.checked = false;
        });
        $(".mdl-js").css("overflow-y","scroll");
    });
});
function removeCurrentRow() {
    $(`tr[data-id="${articleId}"]`).fadeOut('slow');
    $(`div[data-id="${articleId}"]`).fadeOut('slow');
}

span.click(function () {
    modalconfim.hide();
    $(".mdl-js").css("overflow-y","scroll");
});

$(window).on('click', function (e) {
    if ($(e.target).is('.modal-confirm-title')) {
        modalconfim.hide();
        $(".mdl-js").css("overflow-y","scroll");
    }
});
