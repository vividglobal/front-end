let modalconfim = $('.modal-confirm-title')
let btnSwitch = $('.btn-switch');
let span = $('.close');
let articleId;
let csrf = $('meta[name="csrf-token"]').attr('content')
let url
let id

ClickButonLink()

let checkdataType = ""
btnSwitch.click(function () {
    let dataType = $(this).attr('data-type')
    checkdataType = dataType
    if(dataType === "MANUAL"){
        $("#content_status_progress p").text("Are you sure to move this post back to submit violations?")
    }else{
        $("#content_status_progress p").text("Are you sure to move this post back to auto-detect violations?")
    }
    scrollScreen.disable()
    id = $(this).attr("data-id")
    url = ""+id+"/action-reset";
    modalconfim.show();
    currentRow = $(this).parents('.scroll-table');
    articleId = currentRow.attr('data-id');
});

$("#confirm-yes").click(function(){
    let childrenlength = $('#children-length >tr').length -1
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
            if(checkdataType  === "MANUAL"){
                show_success("This post has been successfully moved to submit violation");
                
            }else{
                show_success("This post has been successfully moved to auto-detect violation");
            }
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
    if(childrenlength === 15){
        location.reload(true);
    }

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const page = parseInt(urlParams.get("page"));
    let geturl = window.location.href
    if(childrenlength === 0 && page > 1){
            let replace = geturl.replace(`&page=${page}`,`&page=${page - 1}`)
            window.location.href = replace
    }

    if(childrenlength === 0 && !page || page == 1){
        window.location.href = geturl
    }
    scrollScreen.enable()
});
function removeCurrentRow() {
    $(`tr[data-id="${articleId}"]`).fadeOut('slow');
    $(`div[data-id="${articleId}"]`).fadeOut('slow');
    $(`tr[data-id="${articleId}"]`).remove()
}

span.click(function () {
    modalconfim.hide();
    scrollScreen.enable()
});

$(window).on('click', function (e) {
    if ($(e.target).is('.modal-confirm-title')) {
        modalconfim.hide();
        $(".mdl-js").css("overflow-y","scroll");
    }
});



