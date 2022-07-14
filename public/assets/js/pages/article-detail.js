$(document).ready(function(){
    let articleId;
    let currentRow;
    let agreeStatus;
    let botStatus;
    let confirmModal = $('#confirmActionModal');
    let confirmModalVio = $('#confirmActionModal-violation');
    let confirmArticleAsViolationModal = $('#confirmArticleAsViolation')
    let span = $('.close');
    let openselectcode = $('.open-modal-mobile-code')
    let actionStep;
    let lowercaseRole = CURRENT_ROLE.toLowerCase();

    span.click(function () {
        confirmModal.hide();
        confirmModalVio.hide();
        confirmArticleAsViolationModal.hide()
        openselectcode.hide();
    });
    $(".history-back").click(function(){
        history.back(1);
    })

    $(document).on('click', '.check-status', function() {
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
            confirmModalVio.show()
        }
    })

    $('.btn-confirm-violation-and-choose-code').click(async function() {
        let disabledDisagreeBtn = true;
        await updateStatusViolationColumnAndEnableReviewViolationCodeButton(disabledDisagreeBtn)
        confirmArticleAsViolationModal.hide();
    })

    $('.btn-confirm-violation').click(async function() {
        updateStatusViolationColumnAndEnableReviewViolationCodeButton();
        addOverlayScroll();
        confirmModalVio.hide();
        // hide_overlay();
    });


    $('.btn-confirm-non-violation').click(async function() {
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_NONE_VIOLATION);
        addOverlayScroll();
        if(response.success) {
            if(CURRENT_ROLE === SUPERVISOR_ROLE) {
                $('.table-button-all').remove();
                fileHtmlItems = `
                    <div class="table-code-top">
                        <h2>Supervisor</h2>
                        <p class="status-title unviolation-color" data-status="NON_VIOLATION">Non-violation</p>
                    </div>`
                    $('#table-add').prepend(fileHtmlItems);
            }else if(CURRENT_ROLE === OPERATOR_ROLE) {
                removeCurrentRow();
            }
        }else {
            show_error('Evaluation failed!');
        }
        confirmModal.hide();
    })

    $('.add-violation-code').click(async function() {
        openselectcode.show();
        articleId = $(this).attr('data-id');
    })

    $('.btn-select-code').click(async function() {
        $('#violation-code-item').remove()
        actionStep = ACTION_CHECK_CODE;
        openselectcode.hide();
        let violationCode = $("input[name='violation_code[]']:checked").map(function(){
            return $(this).val();
        }).get();
        if(violationCode.length === 0) {
            show_error("Please select as least 1 type of violation.");
            return false;
        }
        agreeStatus = DISAGREE;
        let response = await action_moderate_article(actionStep, STATUS_VIOLATION, violationCode)
        if(response.success) {
            addOverlayScroll();
            updateDetectionColumnAfterSelectViolationCode(response.data);
            closeCodeModal();
            show_success(response.message);
        }else {
            show_error('Evaluation failed!');
            hide_overlay();
        }
    })

    function updateDetectionColumnAfterSelectViolationCode(data) {
        let codelish = '';
        for (let i = 0; i < data.violation_code.length; i++) {
            codelish += `
                <div>
                    <h4 class="p-style" href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
                        ${data.violation_code[i].name}
                    </h4>
                </div>
            `
        }
        let typelishcode = '';
        for (let i = 0; i < data.violation_types.length; i++) {
            typelishcode += `
            <div style="display: flex;align-items: center;">
                <div class="color-circle-big" >
                    <div class="color-circle" style="background: #6F6F6F;"></div>
                </div>
                <h4 class="p-style"> ${data.violation_types[i].name}</h4>
            </div>
            `
        }
        fileHtmlItems = `
            <div id="table-box">
                <div class="table-code-top">
                    <h2>Supervisor</h2>
                    <p class="status-title violation-color" data-status="VIOLATION">Violation</p>
                </div>
                <div class="table-code-aticle">
                    <img class="img-icon-detail" src="http://localhost:8099/assets/image/dis-code.png" alt="">
                    <div>
                        <h4 class="p-style">Code article</h4>
                        ${codelish}

                    </div>
                </div>
                <div class="table-code-tile">
                    ${typelishcode}
                </div>
            </div>
        `
        $('#table-add').prepend(fileHtmlItems);
        $('#table-code-buton-all').remove()
    }

    function removeCurrentRow() {
        $(`tr[data-id="${articleId}"]`).fadeOut('slow');
        $(`div[data-id="${articleId}"]`).fadeOut('slow');
        closeCodeModal();
        confirmModalVio.hide();
    }

    function addOverlayScroll() {
        scrollScreen.enable()
    }

    $(document).on('click', '.check-violation-code', async function() {
        if(botStatus === STATUS_VIOLATION) {
            articleId = $(this).attr('data-id');
            agreeStatus = $(this).attr('attr-status');
        }
        $('#violation-code-item').remove()
        let response = await action_moderate_article(ACTION_CHECK_CODE, STATUS_VIOLATION);
        if(response.success) {
            show_success(response.message);
            updateDetectionColumnAfterSelectViolationCode(response.data);
        }else {
            show_error('Evaluation failed!');
            hide_overlay();
        }
    })


    async function updateStatusViolationColumnAndEnableReviewViolationCodeButton(disabledDisagreeBtn = false) {
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_VIOLATION);
        if(response.success) {
        // Update status label
        $('#table-code-buton-supervisor').remove();

        if(botStatus === STATUS_VIOLATION && agreeStatus === AGREE) {
            violationitem =`
            <div class="table-code-top" id="violation-code-item">
                <h2>Supervisor</h2>
                <p class="status-title violation-color" data-status="VIOLATION">Violation</p>
            </div>
            `
            $('#table-add').prepend(violationitem);

            fileHtmlItems = `
                <div class="table-code-buton" id="table-code-buton-supervisor">
                    <div data-id="${articleId}" attr-status="AGREE" class="check-true check-violation-code  btn-violation">
                        <h2>Agree code article</h2>
                    </div>
                    <div data-id="${articleId}" attr-status="DISAGREE" class="check-false add-violation-code btn-non-violation">
                        <h2>Reselect code article</h2>
                    </div>
                </div>
            `
        }else{
        violationitem =`
        <div class="table-code-top" id="violation-code-item">
            <h2>Supervisor</h2>
            <p class="status-title violation-color" data-status="VIOLATION">Violation</p>
        </div>
        `
        $('#table-add').prepend(violationitem);

        fileHtmlItems = `
            <div class="table-code-buton" id="table-code-buton-supervisor">
                <div data-id="${articleId}" attr-status="${AGREE}" class="check-true add-violation-code btn-violation btn-violation-code check-violation-code">
                    <h2>Select code article</h2>
                </div>
            </div>`;
        }
        $('#table-code-buton-all').prepend(fileHtmlItems);
        $('.add-violation-code').click(async function() {
            openselectcode.show();
        })
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
