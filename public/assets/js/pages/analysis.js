$(document).ready(function(){
      // -------------------------
    let generalStrParams = '?1=1';
    let brandStrParams = '?1=1';
    let codeStrParams = '?1=1';
    let mapStrParams = '?1=1';

    let generalIdEl = '#general';
    let brandIdEl = '#vio-based-brand';
    let codeIdEl = '#vio-based-code';
    let mapEl = '#world-map';

    // Init
    getGeneralData();
    getViolationBasedBrand();
    getViolationBasedCode();
      // General

    // OPEN DATE RANGER
    $('.is_apply').find('input[name="daterange"]').daterangepicker({
        autoUpdateInput: false,
        autoApply: false,
        maxDate: new Date(),
        drops: "up",
        opens: "right",
        drops: "down",
        locale: {
            firstDay: 1,
            format: "DD/MM/YYYY",
        },
    });

    $('.no_apply').find('input[name="daterange"]').daterangepicker({
        autoUpdateInput: false,
        autoApply: true,
        maxDate: new Date(),
        drops: "up",
        opens: "right",
        drops: "down",
        locale: {
            firstDay: 1,
            format: "DD/MM/YYYY",
        },
    });
    // ------------------------------------
    // SET DATE
    $('input[name="daterange"]').on(
        "apply.daterangepicker",
        function (ev, picker) {
            let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            let value = picker.startDate.format("MM/DD/YYYY") + " - " + picker.endDate.format("MM/DD/YYYY")
            $(this).val(value);
            if(width <= 500){
                checkDate(value)
                fillterTableBrand()
                let sortField = $(".sort_mobi").find("> p:visible").attr("data-by");
                let sortValue = $(".sort_mobi").find("> p:visible").attr("data-value");
                let getTable = $(".sort_mobi").find("> p:visible").attr("data-table");

                if(getTable !== undefined){
                    sortForAnalysis(sortField,sortValue,getTable,"mobi")
                }
                getGeneralData();
                getViolationBasedBrand();
                getViolationBasedCode();
                getViolationBasedCountry();
            }
            startDate = picker.startDate.format("DD-MM-YYYY");
            endDate = picker.endDate.format("DD-MM-YYYY");
        }
    );

    function checkDate(date){
        let dateRange = date
        let startDate = "";
        let endDate = "";
        if(dateRange) {
            let arr = date.split("-");
            let startDatePicker = arr[0].split("/")
            let endDatePicker = arr[1].split("/")
            startDate = `${startDatePicker[1].trim()}-${startDatePicker[0].trim()}-${startDatePicker[2].trim()}`
            endDate = `${endDatePicker[1].trim()}-${endDatePicker[0].trim()}-${endDatePicker[2].trim()}`
            generalStrParams = brandStrParams = codeStrParams = mapStrParams = `?1=1&start_date=${startDate}&end_date=${endDate}`;
            $(".btn--export--excel").attr("href",`${window.location.href}?1=1&start_date=${startDate}&end_date=${endDate}&export=true`)
        }else{
            generalStrParams = brandStrParams = codeStrParams = mapStrParams = '?1=1'
            $(".btn--export--excel").attr("href",`${window.location.href}?1=1&export=true`)
        }
    }
    // ------------------------------------
    // BTN APPLY DATE
    $("#apply_date").click(function(){
        let date = $('input[name="daterange"]:visible').val()
        if(date !== ""){
            checkDate(date)
        }else{
            checkDate("")
        }
        fillterTableBrand()
        let sortField = $(".sort_mobi").find("> p:visible").attr("data-by");
        let sortValue = $(".sort_mobi").find("> p:visible").attr("data-value");
        let getTable = $(".sort_mobi").find("> p:visible").attr("data-table");

        if(getTable !== undefined){
            sortForAnalysis(sortField,sortValue,getTable,"mobi")
        }

        getGeneralData();
        getViolationBasedBrand();
        getViolationBasedCode();
        getViolationBasedCountry();
    })

     // REMOVE DATERANGE
     $(".remove_daterange").click(function(){
        let date = $('input[name="daterange"]:visible').val()
        if(date !== ""){
            $('input[name="daterange"]').val("")
        }
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width <= 500){
            checkDate("")
            getGeneralData();
            getViolationBasedBrand();
            getViolationBasedCode();
            getViolationBasedCountry();
        }
    })
    // ------------------------------------

    // PAGINATION BTN
    $(document).on('click', ".pagination li", function(){
        let page = parseInt($(this).find("a").text());
        if(page) {
            let getTableId = $(this).parents('.table-wrapper').attr('id');
            pageTable(getTableId,page)
        }
    })
    // NEXT BTN
    $(document).on('click', ".pagination li:last-child", function(){
        let getTableId = $(this).parents('.table-wrapper').attr('id');
        let lengthPagination = $(this).closest('.pagination').find("li:nth-last-child(2)").find("a").text()
        if(lengthPagination){
            pageTable(getTableId,lengthPagination)
        }
    })
    // PREV BTN
    $(document).on('click', ".pagination li:first-child", function(){
        let getTableId = $(this).parents('.table-wrapper').attr('id');
        let lengthPagination = $(this).closest('.pagination').find("li:nth-child(2)").find("a").text()
        if(lengthPagination){
            pageTable(getTableId,lengthPagination)
        }
    })

    function pageTable (getTableId,perPage){
        if(getTableId === 'vio-based-brand') {
            let newParams = removeParamFromList(brandStrParams.split('&'), 'page')
            newParams.push('page='+perPage);
            brandStrParams = newParams.join('&');
            getViolationBasedBrand();
            $([document.documentElement, document.body]).animate({
                scrollTop: $(`#tb_brand`).offset().top
            });
        }else if(getTableId === 'vio-based-code') {
            let newParams = removeParamFromList(codeStrParams.split('&'), 'page')
            newParams.push('page='+perPage);
            codeStrParams = newParams.join('&');
            getViolationBasedCode();
            $([document.documentElement, document.body]).animate({
                scrollTop: $(`#tb_code`).offset().top
            });
        }
    }
    // ------------------------------------
    // BTN APPLY FILLTER BRAND
    $(".btn__apply").on("click",function(){
        fillterTableBrand()
        let sortField = $(".sort_mobi").find("> p:visible").attr("data-by");
        let sortValue = $(".sort_mobi").find("> p:visible").attr("data-value");
        let getTable = $(".sort_mobi").find("> p:visible").attr("data-table");
        $(".no_search_result").hide()
        if(getTable !== undefined){
            sortForAnalysis(sortField,sortValue,getTable,"mobi")
        }

        if(getTable == "vio-based-code"){
            getViolationBasedCode();
        }else{
            getViolationBasedBrand();
        }
        resetFiter()
    })

    function fillterTableBrand(){
        newParams = [];
        let brandCompanyId = $(".list--company--brand").find("> p").attr("data-id");
        if(brandCompanyId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'brand_id')
            newParams.push('brand_id='+brandCompanyId);
            const new_arr = removeParamFromList(newParams, 'brand_id=0')
            brandStrParams = new_arr.join('&');
        }
        let countryId = $(".list--country").find("> p").attr("data-id");
        if(countryId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'country_id')
            newParams.push('country_id='+countryId);
            const new_arr = removeParamFromList(newParams, 'country_id=0')
            brandStrParams = new_arr.join('&');
        }

        let violationTypeId = $(".list--violation--type").find("> p").attr("data-id");
        if(violationTypeId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'violation_type_id')
            newParams.push('violation_type_id='+violationTypeId);
            const new_arr = removeParamFromList(newParams, 'violation_type_id=0')
            brandStrParams = new_arr.join('&');
        }
    }

    // BTN ICON SORT PC
    $(document).on('click', '.ico-sort', function() {
        let sortField = $(this).attr('data-sort-field');
        let sortValue = $(this).attr('data-sort-value');
        let getTableId = $(this).parents('.table-wrapper').attr('id');
        sortForAnalysis(sortField,sortValue,getTableId,"pc")
    });

    function sortForAnalysis(sortField,sortValue,getTable,device){
        let newParams = [];
        if(getTable === 'vio-based-brand') {
                newParams = removeParamFromList(brandStrParams.split('&'),"sort_value");
            if(sortField !== "None") {
                newParams.push(`sort_by=${sortField}`);
                if(sortValue == "A to Z" || sortValue == "ASC"){
                    newParams.push(`sort_value=ASC`);
                }else if(sortValue == "Z to A" || sortValue == "DESC"){
                    newParams.push(`sort_value=DESC`);
                }
            }
                brandStrParams = newParams.join('&');
                if(device !== "mobi"){
                    getViolationBasedBrand();
                }
        }else if(getTable === 'vio-based-code') {
                newParams = removeParamFromList(codeStrParams.split('&'),"sort_value")
            if(sortField !== "None"){
                newParams.push(`sort_by=${sortField}`);
                if(sortValue == "A to Z" || sortValue == "ASC"){
                    newParams.push(`sort_value=ASC`);
                }else if(sortValue == "Z to A" || sortValue == "DESC"){
                    newParams.push(`sort_value=DESC`);
                }
            }
                codeStrParams = newParams.join('&');
                if(device !== "mobi"){
                    getViolationBasedCode();
                }
        }
    }
    function removeParamFromList(list,item) {
        let newParams = list.filter(index=>{
            return index.indexOf("sort_by") == -1 && index.indexOf(item) == -1
        })
        return newParams;
    }
    // ------------------------------------
    // URL
    async function getGeneralData() {
        add_loader(generalIdEl);
        let htmlResponse = await get('/analysis/general'+generalStrParams);
        $(generalIdEl).html(htmlResponse)
        remove_loader(generalIdEl);
    }

    async function getViolationBasedBrand() {
        add_loader(brandIdEl);
        let htmlResponse = await get('/analysis/violation-by-brand'+brandStrParams);
        $(brandIdEl).html(htmlResponse)
        remove_loader(brandIdEl)
    }

    async function getViolationBasedCode() {
        add_loader(codeIdEl);
        let htmlResponse = await get('/analysis/violation-by-code'+codeStrParams);
        $(codeIdEl).html(htmlResponse)
        remove_loader(codeIdEl)
    }

    async function getViolationBasedCountry() {
        let mapUrl = '/analysis/violation-by-country'+mapStrParams;
        $(mapEl).attr('src', mapUrl);
    }

    async function get(url) {
        return await $.ajax({
            url : url,
            method : 'GET',
            data : {
                _token : csrf
            }
        });
    }

    // FILTER BTN
    $(".fillter_brand").find(".open_Nav_filter").click(function(){
        $(".sort_based_on_code").hide()
        $('.sort_based_on_brands').show()
        $(".checkbox_mobi").show()
        $(".border_gray").show()
        $(".text_brand").show()
        $(".text_code").hide()
    })

    $(".fillter_code").find(".open_Nav_filter").click(function(){
        $(".sort_based_on_code").show()
        $('.sort_based_on_brands').hide()
        $(".checkbox_mobi").hide()
        $(".checkbox_mobi:first-child").show()
        $(".border_gray").hide()
        $(".border_sort").show()
        $(".text_brand").hide()
        $(".text_code").show()

    })

    function resetFiter(){
        navigation.hide("#myFilter")
        overlay.hide()
        $(".checkbox_mobi").find("#toggle").hide()
        scrollScreen.enable()
    }

    $(".close__filter").click(function() {
        resetFiter()
        $(".no_search_result").hide()
    })

    $(".list--company--brand").find("> p").text("Brand/Company")
    $(".list--country").find("> p").text("Country")
    $(".list--violation--type").find("> p").text("Violation type")
})

