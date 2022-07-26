let modalconfim = $('.modal-confirm-title')
let btnSwitch = $('.btn-switch-mobile');
let uploadfile = $('.upload-file-mobile');
let uploadModal = $("#uploadModal");
let selectOneViolation = $(".select__one--status");
let selectViolation = $(".select--status");
let btnViolation = $(".list--status");
let checklogin = "a"
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
    articleId = $('.btn-switch-mobile').attr('data-id');
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
            show_success("This post has been successfully moved to auto-dectect violation.");
            $('#toaster').addClass('toaster-style-mobile')
            setTimeout(() => {
                window.location.replace(window.location.pathname.replace(articleId + "/violation", "code-violation"));
            },3000);
        }
    })
    .fail(function(){
        hide_overlay()
        show_error("This post go to failed state.");
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
//upload
let rowId =""
uploadfile.click(function(e) {
    $(this).addClass("check")
    let user = $(this).attr("data-user")
    uploadModal.show();
    $(".mdl-js").css("overflow-y","hidden");
    show_overlay()
    rowId = $(this).attr("data-id")
    checklogin = $('.check-login').attr('t-login');
    renderFileItem(rowId,user)
})

function renderFileItem(rowId,user) {
    $.ajax({
        url: "/articles/"+rowId+"/documents",
        method: 'GET',
        dataType:'JSON',
        success: function(response){
            if(response){
                if((response.data).length>0){
                    for(let i = 0 ; i<(response.data).length;i++){
                        fileHtmlItems = `
                        <div class="item-lish div-item items_file items_file-style">
                                <div class="file-item">
                                    <img src="/assets/image/icon-pdf.png" alt="" style="width: 24px;height: 24px;">
                                    <a href=${response.data[i].url} class="doc-file"target="_blank">${response.data[i].name}</a>
                                </div>
                                <div class= ${!checklogin ? "hide-div" : "div-delete"}>
                                    <span id-delete=${response.data[i].id} class="delete-file">&times;</span>
                                </div>
                        </div> 
                        `
                        $('#add-file').prepend(fileHtmlItems);
                    }
                }else{
                    if(user.toUpperCase() !== "OPERATOR"){
                        fileHtmlItems = `<div class="no-file-remove" style="
                        display: flex;
                        justify-content: center;
                        margin-bottom: 10px;">
                        <p class="no-file-upload">No files</p>
                        </div>`
                        $('.no_files').prepend(fileHtmlItems);
                    }
                }
            }
            hide_overlay()
        }
    });
}

$(document).on("click", '.delete-file', async function (){
    let rowIdelemnet = $(this).attr("id-delete");
    let parentItem = $(this).parents('.items_file')
    let filesNumber = $(".item-one-file").length
    DeleteFile(rowIdelemnet,parentItem,filesNumber)
})

$(document).on('change', '.file-input', async function(){
    let flag = true
    let form = new FormData();
    let files = $('#upload')[0].files;
    if (files.length > 5) {
        flag = false
        show_error("You are only allowed to upload a maximum of 5 files at a time")
    }
    if(files.length !== 0 && flag){
        for(let i = 0; i < files.length; i++){
            let extension = (files[i].name).split('.').pop().toLowerCase();
            if ($.inArray(extension, ['pdf']) == -1) {
                show_error("You have uploaded files that are not in the correct PDF format")
                $('#toaster').addClass('toaster-style-mobile')
                return false;
            }
        }
        show_overlay()
        for(let i = 0; i < files.length; i++){
            $('.no-file-remove').remove();
            form.append("document", files[i]);
            form.append("article_id", rowId);
            let settings = {
                "url": "/articles-document/upload",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    // "Accept": "application/json",
                    'X-CSRF-TOKEN': csrf,
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };
            $.ajax(settings)
                .done(function(res) {
                    let response = JSON.parse(res)
                    show_success(response.message);
                    $('.completed').addClass('completed-show')
                    // let date = response.data.modified;
                    fileHtmlItems = `
                        <div class="item-lish div-item items_file">
                            <div class="file-item">
                                <img src="/assets/image/icon-pdf.png" alt="" style="width: 24px;height: 24px;">
                                <a href=${response.data.url} class="doc-file"target="_blank">${response.data.name}</a>
                            </div>
                            <div class= ${!checklogin ? "hide-div" : "div-delete"}>
                                <span id-delete=${response.data._id} class="delete-file">&times;</span>
                            </div>
                        </div> 
                    `
                    $('#add-file').prepend(fileHtmlItems);
                    hide_overlay();
                })
                .fail(function(err) {
                    let errResponse = JSON.parse(err.responseText)
                    hide_overlay();
                    show_error(errResponse.message)
                })
        }
        $('#upload').val('');
    }
})

let targetEL ;
btnViolation.filter(function(){
    let idselect = $(this).attr("data-idEL")
    $.ajax({
        url: "/articles/"+idselect+"/documents",
        method: 'GET',
        dataType:'JSON',
        success: function(response){
            if(response){
                if((response.data).length>0){
                    $('.completed').addClass('completed-show')
                }
            }
        }
    });

    let getData_id = $(this).find("> p").attr("data-id");
    $(this).find(".select--status").find(`> #${getData_id}`).addClass("background-gray ")
    $(this).find(".select--status").find(`> #${getData_id}`).find("img").show()
})

btnViolation.click(function(event) {
    let role = $(this).attr("data-role");
    if(role.toUpperCase() == "OPERATOR"){
        let idEl = $(this).attr("id")
        targetEL = idEl;
        $(".list--status").not(this).find(".select--status").hide()
        $(this).find(".select--status").toggle();
    }
});

selectOneViolation.on("click", function(){
    let value = $(this).find("p").html()
    let id = $(this).find("p").attr("data-id");
    let idrow = $(`#${targetEL}`).attr("data-idEL");
    $(`#${targetEL}`).find("> p").html(value)
    $(`#${targetEL}`).find("> p").attr("data-id",id)
    $(`#${targetEL}`).find(".select--status").find(".select__one--status").removeClass("background-gray")
    $(`#${targetEL}`).find(".select--status").find(".select__one--status").find("img").hide()
    $(this).addClass("background-gray")
    $(this).find("img").show()
    show_overlay()
    const url = `switch-progress-status`;
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
        if(msg){
            hide_overlay()
            show_success(msg.message)
        }
    })
    .fail(function( error ) {
        hide_overlay()
        show_error(error.responseJSON.message)
    })
})


span.click(function () {
    $('.div-item').remove();
    $('.no-file-upload').remove()
    uploadModal.hide();
    modalconfim.hide()
    $(".mdl-js").css("overflow-y","scroll");
});

$(window).on('click', function (e) {
    if ($(e.target).is('.modal-confirm-title')) {
        $('.div-item').remove();
        uploadModal.hide();
        $(".mdl-js").css("overflow-y","scroll");
    }
});


function DeleteFile(rowIdelemnet,parentItem,filesNumber){
    targetEL = 'status_1'
    show_overlay()
    let getTextStatus = $(`#${rowId}`).find(".track:nth-child(8)").find(".list--status").find("> p")
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        data :{
            "article_id": rowId
        },
        method: "DELETE",
        url:"/articles-document/"+rowIdelemnet+"",
    })
    .done(function( msg){
        if(msg){
            hide_overlay()
            parentItem.remove();
            show_success(msg.message);
            let item = $('.div-item')
            // if(item.length === 0){
            //     $('.completed').hide()
            //     getTextStatus.text("Not started").attr("data-id","not_started")
            // }
            if(item.length === 0){
                $('.completed').hide()
                getTextStatus.text("Not started").attr("data-id","not_started")
                $(`#${targetEL}`).find("> p").html("Not started")
                $(".entry").find(`#${rowId}`).attr("src","../assets/image/lega1.png")
                $(".date-penalty").find(`#${rowId}`).text("")
                var progressStatus =  $(`#${rowId}`).find(".track:nth-child(8)").find(".entry").find(".list--status")
                .find(".select--status")
                // HIDE COMPELTE
                if(progressStatus.find(".select__one--status:nth-child(3)").hasClass("show")){
                    progressStatus.find(".select__one--status:nth-child(3)").addClass("hide").removeClass("show")
                }
                // PROGRESS STATUS IS COMPLETE => NOT_STARTED
                if(getTextStatus.text().trim() == "Completed"){
                    progressStatus.find(".select__one--status:nth-child(1)").addClass("background-gray")
                    progressStatus.find(".select__one--status:nth-child(1)").find("img").show()
                    getTextStatus.text("Not started").attr("data-id","not_started")
                }
            }
        }
    })
    .fail(function(error){
        show_error(error.responseJSON.message);
        hide_overlay()
    })
}

$(window).on('click', function (e) {
    if(($(e.target).is('.list--status-mobile')) ==false ) {
        $('.select--status').hide() 
    }
})