$(document).ready(function(){
    let articleId;
    let currentRow;
    let agreeStatus;
    let confirmModal = $('#confirmActionModal');
    let confirmModalVio = $('#confirmActionModal-violation');
    let violationCodeModal = $('#selectCodeModal');
    let confirmArticleAsViolationModal = $('#confirmArticleAsViolation');
    let lowercaseRole = CURRENT_ROLE.toLowerCase();
    let actionStep;
    let isLoading = false;
    let botStatus;

    $(document).on('click', '.check-status', function() {
        scrollScreen.disable()
        currentRow = $(this).parents('.scroll-table');
        articleId = currentRow.attr('data-id');
        agreeStatus = $(this).attr('attr-status');
        botStatus = currentRow.find('.bot-status').attr('data-status');
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

    function setDefaulSearchModal(){
        $(".search").val("")
        $(".check__box").css("display", "block")
    }

    $(document).on('click', '.check-violation-code', async function() {
        if($(this).hasClass('check-true-disabled') || $(this).hasClass('check-false-disabled')) {return}
        if($(this).hasClass("dishable_overlay")){
            scrollScreen.disable()
        }
        currentRow = $(this).parents('.scroll-table');
        articleId = currentRow.attr('data-id');
        agreeStatus = $(this).attr('attr-status');
        botStatus = currentRow.find('.bot-status').attr('data-status');
        let reviewStatus;
        if(CURRENT_ROLE === SUPERVISOR_ROLE) {
            reviewStatus = currentRow.find('.supervisor-violation-action .status-title').attr('data-status')
        }else if(CURRENT_ROLE === OPERATOR_ROLE) {
            reviewStatus = currentRow.find('.operator-violation-action .status-title').attr('data-status')
        }
        if(agreeStatus === DISAGREE || (botStatus === STATUS_NONE_VIOLATION && reviewStatus === STATUS_VIOLATION) ) {
            actionStep = ACTION_CHECK_CODE;
            violationCodeModal.show();
            $(".mdl-js").css("overflow-y","hidden");
        }else {
            let response = await action_moderate_article(ACTION_CHECK_CODE, STATUS_VIOLATION);
            isLoading = false;
            if(response.success) {
                show_success(response.message);
                updateDetectionColumnAfterSelectViolationCode(response.data);
            }else {
                show_error('Evaluation failed!');
                hide_overlay();
            }
        }
        hide_overlay();
    });

    $('.open-modal').on('click', '.close', function() {
        setDefaulSearchModal()
        closeCodeModal();
        confirmModalVio.hide();
        addOverlayScroll();
        $('input[type=checkbox]').each(function()
        {
            this.checked = false;
        });
        confirmModal.hide();
        confirmArticleAsViolationModal.hide();
    });

    $('.btn-confirm-non-violation').click(async function() {
        confirmModal.hide()
        $(".mdl-js").css("overflow-y","scroll");
        let response = await action_moderate_article(ACTION_CHECK_STATUS, STATUS_NONE_VIOLATION);
        addOverlayScroll();
        isLoading = false;
        if(response.success) {
            show_success(response.message);
            if(CURRENT_ROLE === SUPERVISOR_ROLE) {
                confirmModal.hide();
                currentRow.find(`.${lowercaseRole}-violation-type`).html('')
                currentRow.find(`.${lowercaseRole}-violation-code`).html(
                    `<div class="entry-title-threee entry-title-tyle reviewing-title"></div>`
                );
                currentRow.find(`.${lowercaseRole}-violation-action`).html(
                    `<div class="entry-title-threee entry-title-tyle reviewing-title">
                        <p data-status="${STATUS_NONE_VIOLATION}" class="status-title unviolation-color">Non-violation</p>
                    </div>`
                );
            }else if(CURRENT_ROLE === OPERATOR_ROLE) {
                removeCurrentRow();
            }
        }else {
            show_error('Evaluation failed!');
            confirmModal.hide();
        }
        hide_overlay();
    });

    $('.btn-confirm-violation').click(async function() {
        updateStatusViolationColumnAndEnableReviewViolationCodeButton();
        addOverlayScroll();
        confirmModalVio.hide();
        // hide_overlay();
    });

    $('.btn-select-code').click(async function() {
        setDefaulSearchModal()
        let violationCode = $("input[name='violation_code[]']:checked").map(function(){
            return $(this).val();
        }).get();

        if(violationCode.length === 0) {
            show_error("Please select as least 1 type of violation.");
            return false;
        }
        agreeStatus = DISAGREE;
        let response = await action_moderate_article(actionStep, STATUS_VIOLATION, violationCode);
        isLoading = false;
        hide_overlay();
        closeCodeModal()
        if(response.success) {
                addOverlayScroll();
                updateDetectionColumnAfterSelectViolationCode(response.data);
                closeCodeModal();
                show_success(response.message);
        }else {
            show_error('Evaluation failed!');
            hide_overlay();
        }
    });

    // SEARCH ARTICLE_CODE MODAL
    $(".search_code_article").on("keyup",function(e){
        let value = e.target.value.toLowerCase()
            $(".col-md-4").filter(function(){
                $(this).toggle($(this).find('.checkbox-code').find(".check_box_code").text().toLowerCase().indexOf(value) > -1)
            })
    })

    $('.btn-confirm-violation-and-choose-code').click(async function() {
        $(".mdl-js").css("overflow-y","scroll");
        confirmArticleAsViolationModal.hide();
        let disabledDisagreeBtn = true;
        await updateStatusViolationColumnAndEnableReviewViolationCodeButton(disabledDisagreeBtn)
    });

    function updateDetectionColumnAfterSelectViolationCode(data) {
        let codeString = '';
        for (let i = 0; i < data.violation_code.length; i++) {
            codeString +=
                        `<div>
                            <a>
                                ${data.violation_code[i].name}
                            </a>
                        </div>`
        }
        let typeString = '';
        for (let i = 0; i < data.violation_types.length; i++) {
            typeString += `<p style=color:${data.violation_types[i].color}>${data.violation_types[i].name}</p>`
        }

        if(CURRENT_ROLE === SUPERVISOR_ROLE) {
            // Update status label
            let colorClass = data.status === STATUS_VIOLATION ? 'violation-color' : 'unviolation-color';
            let violationLabel = data.status === STATUS_VIOLATION ? 'Violation' : 'Non-violation';
            currentRow.find(`.${lowercaseRole}-violation-action`).html(
                `<div class="entry-title-threee entry-title-tyle reviewing-title">
                    <p data-status="${data.status}" class="status-title ${colorClass}">${violationLabel}</p>
                </div>`
            );
            data.violation_code.length
            currentRow.find(`.${lowercaseRole}-violation-type`).html(typeString)
            currentRow.find(`.${lowercaseRole}-violation-code`).html(
                `<div class="style__code--article" style="display:block; width: 100%; ${data.violation_code.length < 7 ? "display:block; width: 100%;justify-content: center":"display:block; width: 100%"}">
                    ${codeString}
                </div>`
            );
        }else if(CURRENT_ROLE === OPERATOR_ROLE) {
            removeCurrentRow();
        }
        hide_overlay();
    }

    function removeCurrentRow() {
        $(`tr[data-id="${articleId}"]`).fadeOut();
        $(`div[data-id="${articleId}"]`).fadeOut();
        closeCodeModal();
        confirmModal.hide();
    }

    function addOverlayScroll() {
        scrollScreen.enable()
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
        isLoading = false;
        if(response.success) {
            show_success(response.message);
            // Update status label
            currentRow.find(`.${lowercaseRole}-violation-action`).html(
                `<div class="entry-title-threee entry-title-tyle reviewing-title">
                    <p data-status="${STATUS_VIOLATION}" class="status-title violation-color">Violation</p>
                </div>`
            );
            currentRow.find(`.${lowercaseRole}-violation-code`).html(
                `<div class="btn-status">
                    <a attr-status="${AGREE}" class="check-true check-violation-code" href="javascript:void(0)"></a>
                    <a attr-status="${DISAGREE}" class="check-false${disabledDisagreeBtn ? '-disabled' : ''} check-violation-code dishable_overlay" href="javascript:void(0)"></a>
                </div>`
            );

        }else {
            show_error('Evaluation failed!');
        }
        hide_overlay();
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
