// $(document).ready(function () {
    var modal = $('.modal-title');
    var modalimg = $('.modalimg')
    var btn = $('.btn-caption');
    var clickimg = $('.clickimg');
    var span = $('.close');
    
    clickimg.click(function () {
        modalimg.show();
    });
    btn.click(function () {
        modal.show();
    });

    span.click(function () {
        modal.hide();
    });
    span.click(function () {
        modalimg.hide();
    });

    $(window).on('click', function (e) {
        if ($(e.target).is('.modal-title')) {
            modal.hide();
        }
        if ($(e.target).is('.modalimg')) {
            modalimg.hide();
        }
    });
// });