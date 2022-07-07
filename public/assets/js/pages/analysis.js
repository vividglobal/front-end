$(".list--company--brand").find("> p").text("Brand/Company")
$(".list--country").find("> p").text("Country")
$(".list--violation--type").find("> p").text("Violation type")

$(document).ready(function(){
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

    $('input[name="daterange"]').on(
        "apply.daterangepicker",
        function (ev, picker) {
            $(this).val(
                picker.startDate.format("DD/MM/YYYY") +
                    " - " +
                    picker.endDate.format("DD/MM/YYYY")
            );
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
    $('.btn__apply').click(function() {
        let dateRange = $('input[name="daterange"]').val();
        let startDate = "";
        let endDate = "";
        if(dateRange) {
            let arr = dateRange.split('-');
            startDate = arr[0].trim().replace(/[/]/g,"-");
            endDate = arr[1].trim().replace(/[/]/g,"-");
            generalStrParams = brandStrParams = codeStrParams = `&start_date=${startDate}&end_date=${endDate}`;

            getGeneralData();
            getViolationBasedBrand();
            getViolationBasedCode();
        }
    })

     // REMOVE DATERANGE
     $(".remove_daterange").click(function(){
        let date = $('.form--daterange').val() || $('.date_mobile').val();
        if(date !== ""){
            $('input[name="daterange"]').val("")
            window.location.href = window.location.href
        }
    })

    $(document).on('click', ".pagination li", function(){
        let page = parseInt($(this).find("a").text());
        if(page) {
            let parentTableId = $(this).parents('.table-wrapper').attr('id');
            if(parentTableId === 'vio-based-brand') {
                console.log(brandStrParams)
                let newParams = removeParamFromList(brandStrParams.split('&'), 'page')
                newParams.push('page='+page);
                brandStrParams = newParams.join('&');
                getViolationBasedBrand();
            }else if(parentTableId === 'vio-based-code') {
                let newParams = removeParamFromList(codeStrParams.split('&'), 'page')
                newParams.push('page='+page);
                codeStrParams = newParams.join('&');
                getViolationBasedCode();
            }
        }
    })

    $(".btn__apply").on("click",function(){
        let brandCompanyId = $(".list--company--brand").find("> p").attr("data-id");
        newParams = [];
        if(brandCompanyId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'brand_id')
            newParams.push('brand_id='+brandCompanyId);
            brandStrParams = newParams.join('&');
        }
        let countryId = $(".list--country").find("> p").attr("data-id");
        if(countryId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'country_id')
            newParams.push('country_id='+countryId);
            brandStrParams = newParams.join('&');
        }
        let violationTypeId = $(".list--violation--type").find("> p").attr("data-id");
        if(violationTypeId) {
            newParams = removeParamFromList(brandStrParams.split('&'), 'violation_type_id')
            newParams.push('violation_type_id='+violationTypeId);
            brandStrParams = newParams.join('&');
        }
        let sortFieldBrand = $(".sort_mobi").find(".text_brand").attr("data-sort-field");
        let sortValueBrand = $(".sort_mobi").find(".text_brand").attr("data-sort-value");
        let parentTableBrand = $(".sort_mobi").find(".text_brand").attr("data-table");

        let sortFieldCode = $(".sort_mobi").find(".text_code").attr("data-sort-field");
        let sortValueCode = $(".sort_mobi").find(".text_code").attr("data-sort-value");
        let parentTableCode = $(".sort_mobi").find(".text_code").attr("data-table");
        if(parentTableBrand !== undefined){
            sortForAnalysis(sortFieldBrand,sortValueBrand,parentTableBrand)
        }
        if(parentTableCode !== undefined){
            sortForAnalysis(sortFieldCode,sortValueCode,parentTableCode)
        }

        getViolationBasedBrand();
        resetFiter()
    })

    $(document).on('click', '.ico-sort', function() {
        let sortField = $(this).attr('data-sort-field');
        let sortValue = $(this).attr('data-sort-value');
        let parentTableId = $(this).parents('.table-wrapper').attr('id');
        sortForAnalysis(sortField,sortValue,parentTableId)
    });

    function sortForAnalysis(sortField,sortValue,parentTableId){
        let newParams = [];
        if(parentTableId === 'vio-based-brand') {
            newParams = removeParamFromList(brandStrParams.split('&'), 'sort_by');
            newParams.push(`sort_by=${sortField}`);
            newParams.push(`sort_value=${sortValue}`);
            brandStrParams = newParams.join('&');
            getViolationBasedBrand();
        }else if(parentTableId === 'vio-based-code') {
            newParams = removeParamFromList(codeStrParams.split('&'), 'sort_by')
            newParams.push(`sort_by=${sortField}`);
            newParams.push(`sort_value=${sortValue}`);
            codeStrParams = newParams.join('&');
            getViolationBasedCode();
        }
    }

    function removeParamFromList(list, name) {
        let newParams = [];
        for (let i = 0; i < list.length; i++) {
            if(!list[i].includes(name)) {
                newParams.push(list[i])
            }
        }
        return newParams;
    }

    function resetFiter(){
        $("#myFilter").removeClass("open_menu")
        $(".overlay").css({"width":"0%","display":"none"})
        $(".checkbox_mobi").find("#toggle").hide()
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
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
