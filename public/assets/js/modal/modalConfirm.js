let modalconfim = $('.modal-confirm-title')
let btnSwitch = $('.btn-switch');
let span = $('.close');
let articleId;

btnSwitch.click(function () {
    let id = $(this).attr("data-id")
    modalconfim.show();
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
            // window.location.href = window.location.href
            removeCurrentRow()
            hide_overlay()
        });
        modalconfim.hide();
        $('input[type=checkbox]').each(function()
        {
                this.checked = false;
        });
    });
});
function removeCurrentRow() {
    $(`tr[data-id="${articleId}"]`).fadeOut('slow');
    $(`div[data-id="${articleId}"]`).fadeOut('slow');
}
span.click(function () {
    modalconfim.hide();
});

$(window).on('click', function (e) {
    if ($(e.target).is('.modal-confirm-title')) {
        modalconfim.hide();
    }
});
