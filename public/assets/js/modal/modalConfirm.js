let modalconfim = $('.modal-confirm-title')
let btnSwitch = $('.btn-switch');
let span = $('.close');
let articleId;
let csrf = $('meta[name="csrf-token"]').attr('content')
let url
let id



btnSwitch.click(function () {
    id = $(this).attr("data-id")
    url = ""+id+"/action-reset";
    modalconfim.show();
    $(".mdl-js").css("overflow-y","hidden");
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
    });
    modalconfim.hide();
    $('input[type=checkbox]').each(function()
    {
        this.checked = false;
    });
    show_success("This post has been successfully moved to auto-dectect violation!");
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
