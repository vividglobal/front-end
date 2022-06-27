var modalconfim = $('.modal-confirm-title')
var btnSwitch = $('.btn-switch');
var span = $('.close');
let articleId;

btnSwitch.click(function () {
    var id = $(this).attr("data-id")
    modalconfim.show();
    var url = ""+id+"/action-reset"
    let csrf = $('meta[name="csrf-token"]').attr('content')
    currentRow = $(this).parents('.scroll-table');
    articleId = currentRow.attr('data-id');

    $("#confirm-yes").click(function(){
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
    console.log("hahaha");
}
span.click(function () {
    modalconfim.hide();
});

$(window).on('click', function (e) {
    if ($(e.target).is('.modal-confirm-title')) {
        modalconfim.hide();
    }
});
