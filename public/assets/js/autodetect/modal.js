$(document).ready(function () {
    var captionModal = $('#captionModal');
    var imageModal = $('#imageModal')
    var uploadModal = $("#uploadModal");
    var btn = $('.btn-caption');
    var clickimg = $('.clickimg');
    var uploadfile = $('#upload-file');
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
    uploadfile.click(function(e) {
        var id = $(this).attr("data-id")
        uploadModal.show();
    })

    span.click(function () {
        captionModal.hide();
        imageModal.hide();
        uploadModal.hide();
    });
    $(window).on('click', function (e) {
        if ($(e.target).is('.modal-title')) {
            captionModal.hide();
        }
        if ($(e.target).is('.modal-upload-file')) {
            uploadModal.hide();
        }
        if ($(e.target).is('.modalimg')) {
            imageModal.hide();
        }
    });
});