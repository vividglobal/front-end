$(".list--company--brand").find("> p").text("Brand/Company")
$(".list--country").find("> p").text("Country")
$(".list--violation--type").find("> p").text("Violation type")

$(document).ready(function(){
    // FILTER MOBI BTN
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

    // OPEN DATE RANGER
    // BTN APPLY
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
    //NO BTN APPLY
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

    $('input[name="daterange"]').on(
        "apply.daterangepicker",
        function (ev, picker) {
            let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            let value = picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY")
            $(this).val(value);
            if(width <= 500){
                checkDate(value)
            }
            startDate = picker.startDate.format("DD-MM-YYYY");
            endDate = picker.endDate.format("DD-MM-YYYY");
        }
    );

    // -------------------------
    let generalStrParams = '?1=1';
    let brandStrParams = '?1=1';
    let codeStrParams = '?1=1';

    let generalIdEl = '#general';
    let brandIdEl = '#vio-based-brand';
    let codeIdEl = '#vio-based-code';

    // Init
    getGeneralData();
    getViolationBasedBrand();
    getViolationBasedCode();

    // General

    function checkDate(date){
        let dateRange = date
        let startDate = "";
        let endDate = "";
        if(dateRange) {
            let arr = dateRange.split('-');
            startDate = arr[0].trim().replace(/[/]/g,"-");
            endDate = arr[1].trim().replace(/[/]/g,"-");
            generalStrParams = brandStrParams = codeStrParams = `?1=1&start_date=${startDate}&end_date=${endDate}`;
        }else{
            generalStrParams = brandStrParams = codeStrParams = '?1=1'
        }
        getGeneralData();
        getViolationBasedBrand();
        getViolationBasedCode();
    }

     // REMOVE DATERANGE
     $(".remove_daterange").click(function(){
        let date = $('input[name="daterange"]:visible').val()
        if(date !== ""){
            $('input[name="daterange"]').val("")
        }
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width <= 500){
            checkDate("")
        }
    })


    $(document).on('click', ".pagination li", function(){
        let page = parseInt($(this).find("a").text());
        if(page) {
            let getTableId = $(this).parents('.table-wrapper').attr('id');
            if(getTableId === 'vio-based-brand') {

                let newParams = removeParamFromList(brandStrParams.split('&'), 'page')
                newParams.push('page='+page);
                brandStrParams = newParams.join('&');
                getViolationBasedBrand();
            }else if(getTableId === 'vio-based-code') {
                let newParams = removeParamFromList(codeStrParams.split('&'), 'page')
                newParams.push('page='+page);
                codeStrParams = newParams.join('&');
                getViolationBasedCode();
            }
        }
    })

    $(".btn__apply").on("click",function(){
        let dateRange = $("input[name=daterange]:visible").val();

        let brandCompanyId = $(".list--company--brand").find("> p").attr("data-id");
        newParams = [];

        if(brandCompanyId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'brand_id')
            newParams.push('brand_id='+brandCompanyId);
            const new_arr = newParams.filter(item => item !== 'brand_id=0');
            brandStrParams = new_arr.join('&');
        }
        let countryId = $(".list--country").find("> p").attr("data-id");
        if(countryId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'country_id')
            newParams.push('country_id='+countryId);
            const new_arr = newParams.filter(item => item !== 'country_id=0');
            brandStrParams = new_arr.join('&');
        }
        let violationTypeId = $(".list--violation--type").find("> p").attr("data-id");
        if(violationTypeId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'violation_type_id')
            newParams.push('violation_type_id='+violationTypeId);
            const new_arr = newParams.filter(item => item !== 'violation_type_id=0');
            brandStrParams = new_arr.join('&');
        }

        let sortField = $(".sort_mobi").find("> p:visible").attr("data-by");
        let sortValue = $(".sort_mobi").find("> p:visible").attr("data-value");
        let getTable = $(".sort_mobi").find("> p:visible").attr("data-table");

        if(getTable !== undefined){
            sortForAnalysis(sortField,sortValue,getTable)
        }

        checkDate(dateRange)
        resetFiter()
    })

    $(document).on('click', '.ico-sort', function() {
        let sortField = $(this).attr('data-sort-field');
        let sortValue = $(this).attr('data-sort-value');
        let getTableId = $(this).parents('.table-wrapper').attr('id');
        sortForAnalysis(sortField,sortValue,getTableId)
    });

    function sortForAnalysis(sortField,sortValue,getTable){
        let newParams = [];
        if(getTable === 'vio-based-brand') {
                newParams = removeParamFromList(brandStrParams.split('&'));
                newParams.push(`sort_by=${sortField}`);
            if(sortValue == "A to Z" || sortValue == "ASC"){
                newParams.push(`sort_value=ASC`);
            }else if(sortValue == "Z to A" || sortValue == "DESC"){
                newParams.push(`sort_value=DESC`);
            }
                brandStrParams = newParams.join('&');
                getViolationBasedBrand();
        }else if(getTable === 'vio-based-code') {
                newParams = removeParamFromList(codeStrParams.split('&'))
                newParams.push(`sort_by=${sortField}`);
            if(sortValue == "A to Z" || sortValue == "ASC"){
                newParams.push(`sort_value=ASC`);
            }else if(sortValue == "Z to A" || sortValue == "DESC"){
                newParams.push(`sort_value=DESC`);
            }
            codeStrParams = newParams.join('&');
            getViolationBasedCode();
        }
    }

    function removeParamFromList(list) {
        let newParams = list.filter(index=>{
            return index.indexOf("sort_value") == -1 && index.indexOf('sort_by') == -1
        })
        return newParams;
    }

    function resetFiter(){
        $("#myFilter").removeClass("open_menu")
        $(".overlay").css({"width":"0%","display":"none"})
        $(".checkbox_mobi").find("#toggle").hide()
        scrollScreen.enable()
    }

    $(".close__filter").click(function() {
        resetFiter()
    })

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

    async function get(url) {
        return await $.ajax({
            url : url,
            method : 'GET',
            data : {
                _token : csrf
            }
        });
    }
})
