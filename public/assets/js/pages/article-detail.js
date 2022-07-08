$(document).ready(function(){
    let confirmModalVio = $('#confirm-violation');
    let confirmModal = $('#confirm-non-violation');
    let span = $('.close');
    let confirmArticleAsViolationModal = $('#confirmArticleAsViolation')
    let actionStep;
    let lowercaseRole = CURRENT_ROLE.toLowerCase();

    span.click(function () {
        confirmModalVio.hide();
        confirmModal.hide();
        confirmArticleAsViolationModal.hide()
    });
    $(".history-back").click(function(){
        history.back(1);
    })

    $(document).on('click', '.check-status', function() {
        // document.documentElement.style.overflow = 'hidden';
        currentRow = $(this).parents('.container-row-mobile');
        document.body.scroll = "no";
        articleId = $(this).attr('data-id');
        agreeStatus = $(this).attr('attr-status');
        botStatus = $('.bot-status').attr('data-status');
        if(agreeStatus === DISAGREE) {
            if(botStatus === STATUS_VIOLATION) {
                confirmModal.show();
            }else {
                actionStep = ACTION_CHECK_STATUS;
                confirmArticleAsViolationModal.show();
            }
        }else if(botStatus === STATUS_NONE_VIOLATION && agreeStatus === AGREE) {
            confirmModal.show();
        }else if(botStatus === STATUS_VIOLATION && agreeStatus === AGREE) {
            confirmModalVio.show();
        }
    })

    $('.btn-confirm-violation-and-choose-code').click(async function() {
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_NONE_VIOLATION);
        addOverlayScroll();
        if(response.success) {
            if(CURRENT_ROLE === SUPERVISOR_ROLE) {
                $('#table-box').remove();
                fileHtmlItems = `
                    <div class="table-code-top">
                        <h2>Supervisor</h2>
                        <p class="status-title unviolation-color" data-status="NON_VIOLATION">Non-violation</p>
                    </div>`
                $('#table-add').prepend(fileHtmlItems);
                $('.table-code-buton').remove();
            }
        }
        confirmArticleAsViolationModal.hide();
    })


    $('.btn-confirm-non-violation').click(async function() {
        let disabledDisagreeBtn = true;
        await updateStatusViolationColumnAndEnableReviewViolationCodeButton(disabledDisagreeBtn)
        fileHtmlItems = `
        <div data-id="{{ $article->_id }}" attr-status="AGREE" class="check-true check-status btn-violation">
            <h2>Reset code article</h2>
        </div>`
        $('#table-code-buton-supervisor').prepend(fileHtmlItems);
        confirmModal.hide();
    })


    function removeCurrentRow() {
        $(`tr[data-id="${articleId}"]`).fadeOut('slow');
        $(`div[data-id="${articleId}"]`).fadeOut('slow');
        closeCodeModal();
        confirmModal.hide();
    }

    function addOverlayScroll() {
        document.documentElement.style.overflow = 'unset';
        document.body.scroll = "yes";
    }

    function closeCodeModal() {
        violationCodeModal.hide();
        $('input[type=checkbox]').each(function()
        {
            this.checked = false;
        });
    }

    async function updateStatusViolationColumnAndEnableReviewViolationCodeButton(disabledDisagreeBtn = false) {
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_VIOLATION);
        if(response.success) {
        // Update status label
        $('#table-box').remove();
        fileHtmlItems = `
            <div class="table-code-top">
                <h2>Supervisor</h2>
                <p class="bot-status status-title violation-color" data-status="VIOLATION">Violation</p>
            </div>`
            $('#table-add').prepend(fileHtmlItems);
            $('.table-code-buton').remove();
        }
    }

    async function action_moderate_article(action, status, violationCode = []) {
        // if(isLoading) {return}
        // show_overlay();
        isLoading = true;
        return await $.ajax({
            url : `/articles/${articleId}/action-moderate?_method=PUT`,
            method : 'PUT',
            data : {
                _token : csrf,
                is_agreed: agreeStatus,
                action : action,
                status : status,
                violation_code : JSON.stringify(violationCode)
            }
        });
    }
})