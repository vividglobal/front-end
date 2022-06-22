$(document).ready(function () {
    var captionModal = $('#captionModal');
    var imageModal = $('#imageModal')
    var uploadModal = $("#uploadModal");
    var btn = $('.btn-caption');
    var clickimg = $('.clickimg');
    var uploadfile = $('.upload-file');
    var loading = $(".div-loading")
    var btnuploadfile = $(".btn-uploadfile")
    var span = $('.close');
    let csrf = $('meta[name="csrf-token"]').attr('content');

    clickimg.click(function () {
        let imgSrc = $(this).attr('src')
        let brandName = $(this).parents('tr').find('.brand-name').text();
        imageModal.find('.head-modal h1').text(brandName)
        imageModal.find('img').attr('src', imgSrc)
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
        btnuploadfile.hide();
        $('.div-item').remove();
    });
    $(window).on('click', function (e) {
        if ($(e.target).is('.modal-title')) {
            captionModal.hide();
        }
        if ($(e.target).is('.modal-upload-file')) {
            uploadModal.hide();
            btnuploadfile.hide();
            $('.div-item').remove();
        }
        if ($(e.target).is('.modalimg')) {
            imageModal.hide();
        }
    });
    
    let rowId =""
    uploadfile.click(function(e) {
        $(this).addClass("check")
        uploadModal.show();
        show_overlay()
        rowId = $(this).attr("data-id")
        renderFileItem(rowId)
    })
    $(document).on('change', '.file-input', async function(){
        let form = new FormData();
        let files = $('#upload')[0].files;
        form.append("document", files[0]);
        form.append("article_id", rowId);
        show_overlay()
        if(files.length === 1){
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
            let repsonse = await $.ajax(settings)
                if(JSON.parse(repsonse).success) {
                    let date = JSON.parse(repsonse).data.modified
                    let now = moment.utc(date,"YYYY-MM-DD\THH:mm:ss\Z").format("DD/MM/YYYY");
                    fileHtmlItems = `<div class="col-sm-3 col-md-3 col-lg-3 mb-2 items_file div-item">
                    <div class="content_file p-2">
                    <div class=" d-flex justify-content-between align-items-center">
                                <div class="item-one-file">
                                    <div class="div-file">
                                        <img src="../assets/image/icon-pdf.png" alt="">
                                        <a href=${JSON.parse(repsonse).data.url} class="doc-file" target="_blank"> ${JSON.parse(repsonse).data.name} </a>
                                    </div>
                                    <div class="div-delete">
                                        <span id-delete=${JSON.parse(repsonse).data._id} class="delete-file">&times;</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> `
                    $('#box_list_file').prepend(fileHtmlItems);
                    if(JSON.parse(repsonse).data.article_id === rowId){
                        $(".check").attr('src','http://localhost:8099/assets/image/dislega2.png');
                        $(".date-penalty").find(`#${rowId}`).text(now)
                    }
                }
                hide_overlay()
            $('#upload').val('');
        }
    })
    
    function renderFileItem(rowId) {
        
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
                hide_overlay()
            }
        });
    }
    
    $(document).on("click", '.delete-file', async function (){
        let rowIdelemnet = $(this).attr("id-delete");
        let parentItem = $(this).parents('.items_file')
        show_overlay()
        let repsonse = await $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            method: "DELETE",
            url:"/articles-document/"+rowIdelemnet+"",
        });
        hide_overlay()
        if(repsonse.success) {
            parentItem.remove();
            let item = $('.div-item')
            if(item.length === 0){
                $(".entry").find(`#${rowId}`).attr("src","http://localhost:8099/assets/image/lega1.png")
                $(".date-penalty").find(`#${rowId}`).text("")
            }
        }else {
        }
    })
});
