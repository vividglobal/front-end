$(document).ready(function () {
    var captionModal = $('#captionModal');
    var imageModal = $('#imageModal')
    var uploadModal = $("#uploadModal");
    var btn = $('.btn-caption');
    var clickimg = $('.clickimg');
    var uploadfile = $('.upload-file');
    var submitUpload = $("#upload-save-file")
    var loading = $(".loading-icon")
    var btnuploadfile = $(".btn-uploadfile")
    var span = $('.close');
    
    clickimg.click(function () {
        let imgSrc = $(this).attr('src')
        let brandName = $(this).parents('tr').find('.brand-name').text();
        captionModal.find('.head-modal h1').text(brandName)
        captionModal.find('img').attr('src', imgSrc)
        imageModal.show();
    });
    btn.click(function () {
        let caption = $(this).find('a').text();
        let brandName = $(this).parents('tr').find('.brand-name').text();
        captionModal.find('.head-modal h1').text(brandName)
        captionModal.find('.title-modal').text(caption)
        captionModal.show();
    });

    span.click(function () {
        captionModal.hide();
        imageModal.hide();
        uploadModal.hide();
        $('.div-item').remove();
        loading.show()
        btnuploadfile.hide()
    });
    $(window).on('click', function (e) {
        if ($(e.target).is('.modal-title')) {
            captionModal.hide();
        }
        if ($(e.target).is('.modal-upload-file')) {
            uploadModal.hide();
            $('.div-item').remove();
            loading.show()
            btnuploadfile.hide()
        }
        if ($(e.target).is('.modalimg')) {
            imageModal.hide();
        }
    });

    uploadfile.click(function(e) {
        uploadModal.show();
        var rowId = $(this).attr("data-id")
        let csrf = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            url: "/articles/"+rowId+"/documents",
            method: 'GET',
            dataType:'JSON',
            success: function(res){ 
                if(res){
                    loading.hide()
                    btnuploadfile.show()
                    for(let i = 0 ; i<(res.data).length;i++){
                        fileHtmlItems = `<div class="col-sm-3 col-md-3 col-lg-3 mb-2 items_file div-item">
                        <div class="content_file p-2">
                        <div class=" d-flex justify-content-between align-items-center">
                                    <div class="item-one-file">
                                        <div class="div-file">
                                            <img src="../assets/image/icon-pdf.png" alt="">
                                            <a href=${res.data[i].url} class="doc-file" target="_blank"> ${res.data[i].name} </a>
                                        </div>
                                        <div class="div-delete">
                                            <span id-delete=${res.data[i].id} class="delete-file">&times;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> `
                        $('#box_list_file').prepend(fileHtmlItems);
                    }
                }
                $('.delete-file').on("click", function (){
                    var rowId = $(this).attr("id-delete")
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                        },
                        method: "DELETE",
                        url:"/articles-document/"+rowId+"",
                    })
                    .done(function( msg ) {
                        window.location.href = window.location.href
                    });
                    uploadModal.show();
                })
            }
        });
        submitUpload.click(function(e) {
            var form = new FormData();
            var files = $('#upload')[0].files;
            form.append("article_id", rowId);
            form.append("document", files[0]);
            if(files.length > 0){
                var settings = {
                    "url": "/articles-document/upload",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Accept": "application/json",
                        'X-CSRF-TOKEN': csrf,
                    },
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form
                };
                $.ajax(settings).done(function (response) {
                    console.log(response);
                    window.location.href = window.location.href
                });
            }
        })
    })


});