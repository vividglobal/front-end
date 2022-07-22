let modalconfim = $('.modal-confirm-title')
let btnSwitch = $('.btn-switch-mobile');
let uploadfile = $('.upload-file-mobile');
let uploadModal = $("#uploadModal");
let checklogin = ""
let span = $('.close');
let articleId;
let csrf = $('meta[name="csrf-token"]').attr('content')
let url
let id

$(".history-back").click(function(){
    history.back(1);
})

btnSwitch.click(function () {
    $(".mdl-js").css("overflow-y","hidden");
    id = $(this).attr("data-id")
    // url = ""+id+"/action-reset";
    $('#confirm-mobile').attr('data-id',id)
    modalconfim.show();
    currentRow = $(this).parents('.scroll-table');
    articleId = currentRow.attr('data-id');
    articleId = $('.btn-switch-mobile').attr('data-id');

});

span.click(function () {
    $('.div-item').remove();
    modalconfim.hide();
    $(".mdl-js").css("overflow-y","scroll");
});


$("#confirm-mobile").click(function(){
    url_reset =  "action-reset"
    show_overlay()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        method: "PUT",
        url: url_reset,
    })
    .done(function( msg ) {
        // removeCurrentRow()
        hide_overlay()
        if(msg){
            show_success("This post has been moved to auto - detect violation list");
            $('#toaster').addClass('toaster-style-mobile')
            setTimeout(() => {
                window.location.replace(window.location.pathname.replace(articleId + "/non-violation", "non-violation"));
            },3000);
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

$('#copy-link').click(function(){
    let Url = $(this).attr("link-copy");
    var isiOSDevice = navigator.userAgent.match(/ipad|iphone/i);
        if (!isiOSDevice) {
            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', Url);
                e.preventDefault();
            }, true);
        } else {
            copyToClipboard(Url);
        }
        document.execCommand('copy');
        if (Url != "" && Url != "javascript:void(0)") {
            show_success('Copy link successful')
        } else {
            show_error('The URL does not exist')
        }
})

function copyToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    document.body.appendChild(textArea);
    textArea.select();
    try {
        var successful = document.execCommand('copy');
    } catch (err) {
        return
    }
    document.body.removeChild(textArea);
}