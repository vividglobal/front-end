$(document).ready(function() {
    let isLoading = false;
    $('#submit_form').on('click', function() {
        if(isLoading) {
            show_error('Please wait');
            return false;
        }
        let formData = new FormData;
        let label_type = $('input[name="label_type"]:checked').val();
        let text = $('textarea[name="text"]').val();
        let country = $('.select_country_manual > p').attr('data-id') || $(".country_mobile").find("> p:visible").attr('data-id') || '';

        if(label_type == LABEL_TYPE_IMAGE) {
            let file = $('input[name="image"]')[0].files[0]
            let fileName = file ? file.name : "";
            let regexFile = /\.(jpe?g|png)$/i.test(fileName)

            if(!regexFile && file){
                show_error('Please upload file is image');
                return false;
            }

            if(!file && text == "") {
                show_error('Please Enter your text or upload an image');
                return false;
            }

            if($('input[name="image"]')[0].files.length > 0) {
                formData.append('image', $('input[name="image"]')[0].files[0]);
            }
            if(text != '') {
                formData.append('caption', text);
            }

        }else if(label_type == LABEL_TYPE_URL) {
            if(!validURL(text)) {
                show_error('Please enter valid url');
                return false;
            }
            formData.append('url', text)
        }

        // From : capcha.blade.php
        if(captchaToken === null) {
            show_error('Please verify capcha');
            return false;
        }

        isLoading = true;
        show_overlay();
        scrollScreen.disable()

        formData.append('request_type', label_type);
        formData.append('capcha_token', captchaToken);
        formData.append('country_id', country);

        $.ajax({
            url: '/articles/manual-label-violation',
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                isLoading = false;
                hide_overlay();
                show_success(response.message);
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const page = parseInt(urlParams.get("page"));
                let geturl = window.location.href
                let replace;
                if(page){
                    replace = geturl.replace(`&page=${page}`,`&page=1`)
                }else{
                    replace = geturl
                }
                
                setTimeout(() => {
                    window.location.href = replace
                }, 3000);
            },
            error: (err) => {
                isLoading = false;
                hide_overlay();
                show_error(err.responseJSON.message);
                setTimeout(() => {
                    window.location.href = window.location.href
                }, 3000);
            }
        });
    })
});

function validURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
      '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
      '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
      '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
      '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
      '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
}
