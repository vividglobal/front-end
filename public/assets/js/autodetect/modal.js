$(document).ready(function () {
    let captionModal = $('#captionModal');
    let imageModal = $('#imageModal')
    let uploadModal = $("#uploadModal");
    let btn = $('.btn-caption');
    let clickimg = $('.clickimg');
    let uploadfile = $('.upload-file');
    let loading = $(".div-loading")
    let btnuploadfile = $(".btn-uploadfile")
    let span = $('.close');
    let checklogin = ""
    let csrf = $('meta[name="csrf-token"]').attr('content');
    let elementExists = document.querySelector(".modal-title");

    clickimg.click(function () {
        let imgSrc = $(this).attr('src')
        let brandName = $(this).parents('tr').find('.brand-name').text();
        imageModal.find('.head-modal h1').text(brandName)
        imageModal.find('img').attr('src', imgSrc)
        imageModal.show();
        $(".mdl-js").css("overflow-y","hidden");

    });

    btn.click(function () {
        let caption = $(this).find('a').text();
        let brandName = $(this).parents('tr').find('.brand-name').text();
        captionModal.find('.head-modal h1').text(brandName)
        captionModal.find('.title-modal').text(caption)
        captionModal.show();
        $(".mdl-js").css("overflow-y","hidden");
    });
    span.click(function () {
        captionModal.hide();
        imageModal.hide();
        uploadModal.hide();
        btnuploadfile.hide();
        $('.div-item').remove();
        $('.no-file-remove').remove();
        $(".mdl-js").css("overflow-y","scroll");

    });
    $(window).on('click', function (e) {
        if ($(e.target).is('.modal-title')) {
            captionModal.hide();
            $(".mdl-js").css("overflow-y","scroll");

        }
        if ($(e.target).is('.modal-upload-file')) {
            uploadModal.hide();
            btnuploadfile.hide();
            $('.div-item').remove();
            $('.no-file-remove').remove();
            $(".mdl-js").css("overflow-y","scroll");

        }
        if ($(e.target).is('.modalimg')) {
            imageModal.hide();
        $(".mdl-js").css("overflow-y","scroll");
        }
        // $(".mdl-js").css("overflow-y","scroll");
    });

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

    $(document).on('change', '.file-input', async function(){
        $('.no-file-remove').remove();
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
                    return false;
                }
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
                show_overlay()
                $.ajax(settings)
                .done(function(res) {
                    let response = JSON.parse(res)
                    show_success(response.message);
                    let date = response.data.modified;
                    let now = moment.utc(date,"YYYY-MM-DD\THH:mm:ss\Z").format("MM-DD-YYYY");
                    fileHtmlItems = `<div class="col-sm-3 col-md-3 col-lg-3 mb-2 items_file div-item">
                    <div class="content_file p-2">
                    <div class=" d-flex justify-content-between align-items-center">
                                <div class="item-one-file">
                                    <div class="div-file">
                                        <img src="../assets/image/icon-pdf.png" alt="">
                                        <a href=${response.data.url} class="doc-file" target="_blank"> ${response.data.name} </a>
                                    </div>
                                    <div class="div-delete">
                                        <span id-delete=${response.data._id} class="delete-file">&times;</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> `
                    $('#box_list_file').prepend(fileHtmlItems);
                    if(response.data.article_id === rowId){
                        $(".check").attr('src','../assets/image/dislega2.png');
                        $(".date-penalty").find(`#${rowId}`).text(now)
                        let progressStatus =  $(`#${rowId}`).find(".track:nth-child(8)").find(".entry").find(".list--status")
                        .find(".select--status").find(".select__one--status:nth-child(3)")
                        if(progressStatus.hasClass("hide")){
                            progressStatus.addClass("show").removeClass("hide")
                        }
                    }
                    hide_overlay();
                })
                .fail(function(err) {
                    let errResponse = JSON.parse(err.responseText)
                    hide_overlay();
                    show_error(errResponse.message)
                })

            }
            // hide_overlay()
            $('#upload').val('');
        }
    })

    function renderFileItem(rowId,user) {
        $.ajax({
            url: "/articles/"+rowId+"/documents",
            method: 'GET',
            dataType:'JSON',
            success: function(res){
                if(res){
                    loading.hide()
                    btnuploadfile.show()
                    if((res.data).length>0){
                        for(let i = 0 ; i<(res.data).length;i++){
                            fileHtmlItems = `<div class="col-sm-3 col-md-3 col-lg-3 mb-2 items_file div-item">
                            <div class="content_file p-2">
                            <div class=" d-flex justify-content-between align-items-center">
                                        <div class="item-one-file">
                                            <div class="div-file">
                                                <img src="../assets/image/icon-pdf.png" alt="">
                                                <a href=${res.data[i].url} class="doc-file" target="_blank"> ${res.data[i].name} </a>
                                            </div>
                                            <div class= ${!checklogin ? "hide-div" : "div-delete"}>
                                                <span id-delete=${res.data[i].id} class="delete-file">&times;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                            $('#box_list_file').prepend(fileHtmlItems);
                        }
                    }else{
                        if(user.toUpperCase() !== "OPERATOR"){
                            fileHtmlItems = `<div class="no-file-remove" style="
                            display: flex;
                            justify-content: center;">
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

    function DeleteFile(rowIdelemnet,parentItem,filesNumber){
        show_overlay()
        let getTextStatus = $(`#${rowId}`).find(".track:nth-child(8)").find(".entry").find(".list--status").find("> p")
        console.log(getTextStatus);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            data :{
                "article_id": filesNumber <= 1 && getTextStatus.text().trim() == "Completed" ? rowId : ""
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
                if(item.length === 0){
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
});
