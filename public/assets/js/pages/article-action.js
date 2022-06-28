$(document).ready(function(){
    let articleId;
    let currentRow;
    let agreeStatus;
    let confirmModal = $('#confirmActionModal');
    let confirmModalVio = $('#confirmActionModal-violation');
    let confirmModalNonVio = $('#confirmActionModal-non-violation');
    let violationCodeModal = $('#selectCodeModal');
    let lowercaseRole = CURRENT_ROLE.toLowerCase();
    let actionStep;
    let isLoading = false;

    var documentElement = document.querySelector('.modal-title');
    $(document).on('click', '.check-status', function() {
        document.documentElement.style.overflow = 'hidden';
        document.body.scroll = "no";
        currentRow = $(this).parents('.scroll-table');
        articleId = currentRow.attr('data-id');
        agreeStatus = $(this).attr('attr-status');
        let botStatus = currentRow.find('.bot-status').attr('data-status');
        if(agreeStatus === DISAGREE) {
            if(botStatus === STATUS_VIOLATION) {
                confirmModal.show();
            }else {
                actionStep = ACTION_CHECK_STATUS;
                violationCodeModal.show();
                // confirmModalNonVio.show()
            }
        }else if(botStatus === STATUS_NONE_VIOLATION && agreeStatus === AGREE) {
            confirmModal.show();
        }else if(botStatus === STATUS_VIOLATION && agreeStatus === AGREE) {
            confirmModalVio.show()
        }
    })

    $(document).on('click', '.check-violation-code', async function() {
        if($(this).hasClass('check-true-disabled') || $(this).hasClass('check-false-disabled')) {return}
        if($(this).hasClass("dishable_overlay")){
            document.documentElement.style.overflow = 'hidden';
            document.body.scroll = "no";
        }
        currentRow = $(this).parents('.scroll-table');
        articleId = currentRow.attr('data-id');
        agreeStatus = $(this).attr('attr-status');
        if(agreeStatus === DISAGREE) {
            actionStep = ACTION_CHECK_CODE;
            violationCodeModal.show();
        }else {
            let response = await action_moderate_article(ACTION_CHECK_CODE, STATUS_VIOLATION);
            isLoading = false;
            hide_overlay();
            if(response.success) {
                show_success(response.message);
                updateDetectionColumnAfterSelectViolationCode(response.data);
            }else {
                show_error(response.message);
            }
        }
    });

    $('.open-modal').on('click', '.close', function() {
        violationCodeModal.hide();
        confirmModalVio.hide()
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
        $('input[type=checkbox]').each(function()
        {
            this.checked = false;
        });
        confirmModal.hide();
    });

    $('.btn-confirm-non-violation').click(async function() {
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_NONE_VIOLATION);
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
        isLoading = false;
        hide_overlay();
        if(response.success) {
            show_success(response.message);
            if(CURRENT_ROLE === SUPERVISOR_ROLE) {
                currentRow.find(`.${lowercaseRole}-violation-type`).html('')
                currentRow.find(`.${lowercaseRole}-violation-code`).html(
                    `<div class="entry-title-threee entry-title-tyle reviewing-title"></div>`
                );
                currentRow.find(`.${lowercaseRole}-violation-action`).html(
                    `<div class="entry-title-threee entry-title-tyle reviewing-title">
                        <p class="status-title unviolation-color">Non-violation</p>
                    </div>`
                );
                confirmModal.hide();
            }else if(CURRENT_ROLE === OPERATOR_ROLE) {
                removeCurrentRow();
            }
        }else {
            show_error(response.message);
        }
    });

    
    $('.btn-confirm-violation').click(async function() {
        updateStatusViolationColumnAndEnableReviewViolationCodeButton();
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
        confirmModalVio.hide()
    });

    $('.btn-select-code').click(async function() {
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
        let violationCode = $("input[name='violation_code[]']:checked").map(function(){
            return $(this).val();
        }).get();

        if(violationCode.length === 0) {
            return false;
        }
        let response = await action_moderate_article(actionStep, STATUS_VIOLATION, violationCode);
        isLoading = false;
        hide_overlay();
        if(response.success) {
            updateDetectionColumnAfterSelectViolationCode(response.data);
            violationCodeModal.hide();
            show_success(response.message);
        }else {
            show_error(response.message);
        }
    });

    // SEARCH ARTICLE_CODE MODAL
    $(".search_code_article").on("keyup",function(e){
        let value = e.target.value.toLowerCase()
            $(".col-md-4").filter(function(){
                $(this).toggle($(this).find('.checkbox-code').find(".check_box_code").text().toLowerCase().indexOf(value) > -1)
            })
    })


    function updateDetectionColumnAfterSelectViolationCode(data) {
        let codeString = '';
        for (let i = 0; i < data.violation_code.length; i++) {
            codeString += `<p>${data.violation_code[i].name}</p>`
        }
        let typeString = '';
        for (let i = 0; i < data.violation_types.length; i++) {
            typeString += `<p>${data.violation_types[i].name}</p>`
        }

        if(CURRENT_ROLE === SUPERVISOR_ROLE) {
            // Update status label
            let colorClass = data.status === STATUS_VIOLATION ? 'violation-color' : 'unviolation-color';
            let violationLabel = data.status === STATUS_VIOLATION ? 'Violation' : 'Non-violation';
            currentRow.find(`.${lowercaseRole}-violation-action`).html(
                `<div class="entry-title-threee entry-title-tyle reviewing-title">
                    <p class="status-title ${colorClass}">${violationLabel}</p>
                </div>`
            );

            currentRow.find(`.${lowercaseRole}-violation-type`).html(typeString)
            currentRow.find(`.${lowercaseRole}-violation-code`).html(
                `<div class="entry-title-threee entry-title-tyle reviewing-title">
                    ${codeString}
                </div>`
            );
        }else if(CURRENT_ROLE === OPERATOR_ROLE) {
            removeCurrentRow();
        }
    }

    function removeCurrentRow() {
        $(`tr[data-id="${articleId}"]`).fadeOut('slow');
        $(`div[data-id="${articleId}"]`).fadeOut('slow');
        violationCodeModal.hide();

        confirmModal.hide();
    }

    async function updateStatusViolationColumnAndEnableReviewViolationCodeButton() {
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_NONE_VIOLATION);
        isLoading = false;
        hide_overlay();
        if(response.success) {
            show_success(response.message);
            // Update status label
            currentRow.find(`.${lowercaseRole}-violation-action`).html(
                `<div class="entry-title-threee entry-title-tyle reviewing-title">
                    <p class="status-title violation-color">Violation</p>
                </div>`
            );

            currentRow.find(`.${lowercaseRole}-violation-code`).html(
                `<div class="btn-status">
                    <a attr-status="${AGREE}" class="check-true check-violation-code" href="javascript:void(0)"></a>
                    <a attr-status="${DISAGREE}" class="check-false check-violation-code dishable_overlay" href="javascript:void(0)"></a>
                </div>`
            );
        }else {
            show_error(response.message);
        }
    }

    async function action_moderate_article(action, status, violationCode = []) {
        if(isLoading) {return}
        show_overlay();
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