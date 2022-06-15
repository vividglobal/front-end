$(document).ready(function () {
    var captionModal = $('#captionModal');
    var imageModal = $('#imageModal')
    var btn = $('.btn-caption');
    var clickimg = $('.clickimg');
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
    });
    span.click(function () {
        imageModal.hide();
    });

    $(window).on('click', function (e) {
        if ($(e.target).is('.modal-title')) {
            captionModal.hide();
        }
        if ($(e.target).is('.modalimg')) {
            imageModal.hide();
        }
    });
});