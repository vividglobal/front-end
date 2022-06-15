var modalconfim = $('.modal-confirm-title')
var btnSwitch = $('.btn-switch');
var span = $('.close');

btnSwitch.click(function () {
    var id = $(this).attr("data-id")
    modalconfim.show();
    var url = ""+id+"/action-reset"
    let csrf = $('meta[name="csrf-token"]').attr('content')

    $("#confirm-yes").click(function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            method: "PUT",
            url: url,
        })
        .done(function( msg ) {
            window.location.href = window.location.href
        });
        modalconfim.hide();
    });
});
span.click(function () {
    modalconfim.hide();
});
$(window).on('click', function (e) {
    if ($(e.target).is('.modal-confirm-title')) {
        modalconfim.hide();
    }
});