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
let checkdataType = ""
ClickButonLink()

$(".history-back").click(function(){
    history.back(1);
})

btnSwitch.click(function () {
    scrollScreen.disable();
    let dataType = $(this).attr('data-type')
    checkdataType = dataType
    if(dataType === "MANUAL"){
        $("#content_status_progress p").text("Are you sure to move this post back to submit violations?")
    }else{
        $("#content_status_progress p").text("Are you sure to move this post back to auto-detect violations?")
    }
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
    scrollScreen.enable();
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
            if(msg){
                if(checkdataType  === "MANUAL"){
                    show_success("This post has been successfully moved to submit violation");
                    
                }else{
                    show_success("This post has been successfully moved to auto-detect violation");
                }
            }
            $('#toaster').addClass('toaster-style-mobile')
            BackUrl("/non-violation", "unable-to-detect")
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
   scrollScreen.enable();
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

