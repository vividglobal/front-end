$(document).ready(function(){
    let articleId;
    let currentRow;
    let agreeStatus;
    let confirmModal = $('#confirmActionModal');
    let violationCodeModal = $('#selectCodeModal');
    let lowercaseRole = CURRENT_ROLE.toLowerCase();
    let actionStep;

    $(document).on('click', '.check-status', function() {
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
            }
        }else if(botStatus === STATUS_NONE_VIOLATION && agreeStatus === AGREE) {
            confirmModal.show();
        }else if(botStatus === STATUS_VIOLATION && agreeStatus === AGREE) {
            updateStatusViolationColumnAndEnableReviewViolationCodeButton();
        }
    })

    $(document).on('click', '.check-violation-code', async function() {
        currentRow = $(this).parents('.container-scroll');
        articleId = currentRow.attr('data-id');
        agreeStatus = $(this).attr('attr-status');

        if(agreeStatus === DISAGREE) {
            actionStep = ACTION_CHECK_CODE;
            violationCodeModal.show();
        }else {
            let response = await action_moderate_article(ACTION_CHECK_CODE, STATUS_VIOLATION);
            if(response.success) {
                updateDetectionColumnAfterSelectViolationCode(response.data);
            }
        }
    });

    $('.open-modal').on('click', '.close', function() {
        violationCodeModal.hide();
        confirmModal.hide();
    });

    $('.btn-confirm-non-violation').click(async function() {
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_NONE_VIOLATION);
        if(response.success) {
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
                // remove row
                $(`[data-id="${articleId}"]`).remove();
                violationCodeModal.hide();
                confirmModal.hide();
            }
        }
    });

    $('.btn-select-code').click(async function() {
        let violationCode = $("input[name='violation_code[]']:checked").map(function(){
            return $(this).val();
        }).get();
        if(violationCode.length === 0) {
            return false;
        }
        let response = await action_moderate_article(actionStep, STATUS_VIOLATION, violationCode);
        if(response.success) {
            updateDetectionColumnAfterSelectViolationCode(response.data);
            violationCodeModal.hide();
        }
    });

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
            // remove row
            $(`[data-id="${articleId}"]`).remove();
            violationCodeModal.hide();
            confirmModal.hide();
        }
    }

    async function updateStatusViolationColumnAndEnableReviewViolationCodeButton() {
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_NONE_VIOLATION);
        if(response.success) {
            // Update status label
            currentRow.find(`.${lowercaseRole}-violation-action`).html(
                `<div class="entry-title-threee entry-title-tyle reviewing-title">
                    <p class="status-title violation-color">Violation</p>
                </div>`
            );

            currentRow.find(`.${lowercaseRole}-violation-code`).html(
                `<div class="btn-status">
                    <a attr-status="${AGREE}" class="check-true check-violation-code" href="javascript:void(0)"></a>
                    <a attr-status="${DISAGREE}" class="check-false check-violation-code" href="javascript:void(0)"></a>
                </div>`
            );
        }
    }

    async function action_moderate_article(action, status, violationCode = []) {
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