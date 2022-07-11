let modalconfim = $('.modal-confirm-title')
let btnSwitch = $('.btn-switch');
let span = $('.close');
let articleId;
let csrf = $('meta[name="csrf-token"]').attr('content')
let url
let id

btnSwitch.click(function () {
    $(".mdl-js").css("overflow-y","hidden");
    id = $(this).attr("data-id")
    url = ""+id+"/action-reset";
    modalconfim.show();
    currentRow = $(this).parents('.scroll-table');
    articleId = currentRow.attr('data-id');
});
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
function removeCurrentRow() {
    $(`tr[data-id="${articleId}"]`).fadeOut('slow');
    $(`div[data-id="${articleId}"]`).fadeOut('slow');
    // $(`div[data-id="${articleId}"]`).remove();
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



