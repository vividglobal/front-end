$("document").ready(function () {
    // DATERANGE SELECT
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

    $('input[name="daterange"]').on(
        "apply.daterangepicker",
        function (ev, picker) {
            $(this).val(
                picker.startDate.format("MM/DD/YYYY") +
                    " - " +
                    picker.endDate.format("MM/DD/YYYY")
            );
            startDate = picker.startDate.format("DD-MM-YYYY");
            endDate = picker.endDate.format("DD-MM-YYYY");
        }
    );

    // VALUE PARAMS
    const queryString = window.location.search;
    const urlParams = (new URL(document.location)).searchParams;
    const perpage = urlParams.get("perpage");
    const paramStart_date = urlParams.get("start_date");
    const paramKeyword = urlParams.get("keyword");
    const paramEnd_date = urlParams.get("end_date");
    const parambrands = urlParams.get("company_brand_id");
    const paramCountry = urlParams.get("country");
    const paramViolation = urlParams.get("violation_type_id");
    const paramSortBy = urlParams.get("sort_by");
    const paramSortValue = urlParams.get("sort_value");
    const violation_code_id = urlParams.get("violation_code_id");


    if (paramKeyword !== null) {
        $(".search").val(paramKeyword);
    }
    if (perpage !== null) {
        $(".list--showing").find("select").val(parseInt(perpage));
        $(".select--showing").closest(".checkbox_mobi").find("> p").text(perpage).attr("data-id",perpage); ;
        $(".select--showing").find(`#${perpage}`).find("input").attr("checked",true)
        $(".select--showing").find(`#${perpage}`).find("span").addClass("activeRadio")
    }

    if (paramStart_date !== null && paramEnd_date !== null) {
        let startDatePicker = paramStart_date.split("-")
        let endDatePicker = paramEnd_date.split("-")
        let startDay = `${startDatePicker[1].trim()}/${startDatePicker[0].trim()}/${startDatePicker[2].trim()}`
        let endDay = `${endDatePicker[1].trim()}/${endDatePicker[0].trim()}/${endDatePicker[2].trim()}`
        $('input[name="daterange"]').val(startDay + " - " + endDay);
    }

    if (parambrands !== null) {
        let name = $(".brand_pc");
        let nameMb = $(".brand_mobi");
        let list = $(".list--company--brand");
        let select = $(".select--company-or-brand");
        let option = ".select__one";
        returnTextButtonQuery(name, list, select, option, parambrands,nameMb);

    }else{
        $(".list--company--brand").find("> p").text("Brand/Company")
    }

    if (paramCountry !== null) {
        let name = $(".country_pc");
        let list = $(".ctr_general");
        let nameMb = $(".country_mobi");
        let select = $(".select--country");
        let option = ".option_general";
        returnTextButtonQuery(name, list, select, option, paramCountry,nameMb);
    }else{
        $(".list--country").find("> p").text("Country")
    }

    if (paramViolation !== null) {
        let name = $(".violation_pc");
        let list = $(".list--violation--type");
        let nameMb = $(".violation_mobi");
        let select = $(".select--violation--type");
        let option = ".select__one--violation--type";
        $(".bot-violation-code").find(`#${paramViolation}`).css({ "text-decoration": "underline" });
        returnTextButtonQuery(name, list, select, option, paramViolation,nameMb);
    }else{
        $(".list--violation--type").find("> p").text("Violation type")
    }

    if (violation_code_id !== null) {
        $(".style__code--article")
            .find("div")
            .find(`#${violation_code_id}`)
            .css({ "text-decoration": "underline" });
    }

    // SORT MOBI
    function sortByparam(img,btn,paramSortBy){
        let getDataValue =   $(".sort_mobi").find("> p").attr("data-value")
        switch (paramSortBy) {
            case "company_name":
                $(".sort_company").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Company`)
                $(".sort_mobi").find("> p").attr("data-name","Company")
                break;
            case "country_name":
                $(".sort_country").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Country`)
                $(".sort_mobi").find("> p").attr("data-name","Country")
                break;
            case "brand_name":
                $(".sort_brand").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Brand`)
                $(".sort_mobi").find("> p").attr("data-name","Brand")
                break;
            case "published_date":
                $(".sort_public_date").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Published date`)
                $(".sort_mobi").find("> p").attr("data-name","Published date")
                break;
            case "crawl_date":
                $(".sort_crawl_date").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Crawl date`)
                $(".sort_mobi").find("> p").attr("data-name","Crawl date")
                break;
            case "checking_date":
                $(".sort_checking_date").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Review date`)
                $(".sort_mobi").find("> p").attr("data-name","Review date")
                break;
            case "bot_status":
                $(".sort_crawl_date").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: VIVID's status`)
                $(".sort_mobi").find("> p").attr("data-name","VIVID's status")

                break;
            case "supervisor_status":
                $(".sort_supervisor").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Supervisor's status`)
                $(".sort_mobi").find("> p").attr("data-name","Supervisor's status")
                break;
            case "operator_status":
                $(".sort_operator").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Operator's status`)
                $(".sort_mobi").find("> p").attr("data-name","Operator's status")
                break;
            case "penalty_issued":
                $(".sort_penalty_issued").find(btn).attr("src", img);
                $(".sort_mobi").find("> p").text(`${getDataValue}: Penalty issued`)
                $(".sort_mobi").find("> p").attr("data-name","Penalty issued")
                break;
            default:
        }
    }

    ///ENABLE---- DISABLE SORT IMAGE
    if (paramSortBy !== null && paramSortValue !== null) {

            $(".sort_value").find(".container_checkbox").find("span").removeClass("activeRadio");
            $(".sort_value").find(".container_checkbox").find("input").prop('checked',false)
            $(".sort_by").find(`#${paramSortBy}`).find("span").addClass("activeRadio");
            $(".sort_by").find(`#${paramSortBy}`).find("input").prop('checked',true)
            $(".sort_mobi").find("> p").attr("data-by",paramSortBy)
        if (paramSortValue === "asc") {
            $(".sort_value").find(".asc").find("input").prop('checked',true)
            $(".sort_value").find(".asc").find("span").addClass("activeRadio");
            $(".sort_mobi").find("> p").attr("data-value","A to Z")
            var img = "../assets/image/Archive/up_disable.svg";
            var btn = ".sort_up";
            sortByparam(img,btn,paramSortBy)
        } else {
            $(".sort_value").find(".desc").find("input").prop('checked',true)
            $(".sort_value").find(".desc").find("span").addClass("activeRadio");
            $(".sort_mobi").find("> p").attr("data-value","Z to A")
            var img = "../assets/image/Archive/down_disable.svg";
            var btn = ".sort_down";
            sortByparam(img,btn,paramSortBy)
        }

    }

    // RETURN TEXT FILTER WHEN PARAMS IS EXIST
    function returnTextButtonQuery(nameBtn, textBtn, selectBtn, option, param,nameMb) {
        let name = $(textBtn).find(nameBtn).find(`#${param}`).find("> p").text() || $(`#${param}`).find("> p").text()  ;
        $(textBtn).find("> p").text(name);
        $(textBtn).find("> p").attr("data-id", param);
        $(selectBtn)
            .find(`.contain--selection ${option}`)
            .removeClass("background-gray");
        $(selectBtn).find(`#${param}`).find("img").show();
        $(selectBtn).find(`#${param}`).addClass("background-gray");
        $(nameMb).closest(".checkbox_mobi").find("> p").text(name)
        $(nameMb).closest(".checkbox_mobi").find("> p").attr("data-id",param)
        $(nameMb).find(`#${param}`).find("> input").prop('checked',true)
        $(nameMb).find(`#${param}`).find("> span").addClass("activeRadio")
    }
    //  ----------------------------

    //  CLOSE FILTER MOBI
    function resetFiter(){
        navigation.hide("#myFilter")
        $(".overlay").css({"width":"0%","display":"none"})
        $(".checkbox_mobi").find("#toggle").hide()
        scrollScreen.enable()
    }

    $(".close__filter").click(function() {
            $(".select__one").find("input").prop('checked',false)
            $(".select__one").find("span").removeClass("activeRadio")
            $("select__one--country").find("input").prop('checked',false)
            $(".select__one--country").find("span").removeClass("activeRadio")
            $("select__one--violation--type").find("input").prop('checked',false)
            $(".select__one--violation--type").find("span").removeClass("activeRadio")
            $("select__one--showing").find("input").prop('checked',false)
            $(".select__one--showing").find("span").removeClass("activeRadio")
            $(".checkbox_mobi").find("> p").text("")
        if(parambrands !== null){
            let name = $(".brand_pc");
            let nameMb = $(".brand_mobi");
            returnTextButtonQuery(name, "", "", "", parambrands,nameMb);
        }
        if(paramCountry !== null){
            let name = $(".country_pc");
            let nameMb = $(".country_mobi");
            returnTextButtonQuery(name, "", "","", paramCountry,nameMb);
        }
        if(paramViolation !== null){
            let name = $(".violation_pc");
            let nameMb = $(".violation_mobi");
            returnTextButtonQuery(name, "", "", "", paramViolation,nameMb);
        }
        if(perpage !== null){
            $(".select--showing").closest(".checkbox_mobi").find("> p").text(perpage) ;
            $(".select--showing").find(`#${perpage}`).find("input").attr("checked",true)
            $(".select--showing").find(`#${perpage}`).find("span").addClass("activeRadio")
        }
        resetFiter()
    })
    // APPLY BTN FILTER
    $(".btn__apply").on("click", function () {
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width > 1113){
            replaceURL(paramSortBy, paramSortValue);
        }else{
            let getParamSortValue = $(".sort_mobi").find("> p").attr("data-value")
            let getParamSortBy = $(".sort_mobi").find("> p").attr("data-by")
            if(getParamSortBy !== undefined && getParamSortValue !== undefined){
                if(getParamSortBy !== "None"){
                    if(getParamSortValue == "A to Z"){
                        replaceURL(getParamSortBy,"asc");
                    }else{
                        replaceURL(getParamSortBy,"desc");
                    }
                }else{
                        replaceURL("","");
                }

            }else{
                replaceURL(paramSortBy, paramSortValue);
            }
        }
        resetFiter()
    });

    //LIST SHOWING
    $(".list--showing")
        .find("select")
        .on("change", function () {
            replaceURL(paramSortBy, paramSortValue);
        });

    // SORT BUTTON UP PC
    $(".sort_up").click(function () {
        var sortBy = $(this).closest("div").find("p").text().toLowerCase();
        if (sortBy == "country" || sortBy == "company" || sortBy == "brand") {
            sortBy = `${sortBy}_name`;
        }else if(sortBy == "review date"){
            sortBy = `checking_date`;
        } else if (/ /g.test(sortBy)) {
            sortBy = sortBy.replace(/ /g, "_");
        } else if (sortBy == "status") {
            sortBy = $(this).closest("div").find("p").attr("data-sort");
        }
        var sortValue = "asc";
        replaceURL(sortBy, sortValue);
    });
    // SORT BUTTON DOWM PC
    $(".sort_down").click(function () {
        var sortBy = $(this).closest("div").find("p").text().toLowerCase();
        if (sortBy == "country" || sortBy == "company" || sortBy == "brand") {
            sortBy = `${sortBy}_name`;
        }else if(sortBy == "review date"){
            sortBy = `checking_date`;
        } else if (/ /g.test(sortBy)) {
            sortBy = sortBy.replace(/ /g, "_");
        } else if (sortBy == "status") {
            sortBy = $(this).closest("div").find("p").attr("data-sort");
        }
        var sortValue = "desc";
        replaceURL(sortBy, sortValue);
    });

    // BUTTOM PAGINATE
    $(".pagination")
        .find("li")
        .click(function () {
            var value = parseInt($(this).find("a").text());
            if (isNaN(value)) {
                const page = parseInt(urlParams.get("page"));
                let btn = $(this).find("a").attr("id");
                if (btn == "prev_page" && page !== 1) {
                    replaceURL(paramSortBy, paramSortValue, page - 1);
                }
                if (btn == "next_page") {
                    replaceURL(paramSortBy, paramSortValue, page + 1);
                }
            } else {
                replaceURL(paramSortBy, paramSortValue, value);
            }
        });

    $(".pagination").find("li:first-child").click(function () {
        replaceURL(paramSortBy, paramSortValue, 1);
    })

    $(".pagination").find("li:last-child").click(function (e) {
        let value =  $(".pagination:visible").find("li:nth-last-child(2)").find("a").text()
        if(value){
            replaceURL(paramSortBy, paramSortValue, value);
        }
    })

    // BTN SEARCH ICON FOR MOBI
    $("#form_search").submit(function (e) {
        e.preventDefault()
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width < 1113){
            replaceURL()
        }
    })

    //GET VALUE
    function getParams(sortBy, sortValue, page) {
            let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width > 1113){
            let date = $("input[name=daterange]:visible").val() ?? "";
            let brandCompany = $(".list--company--brand")
            .find("> p")
            .attr("data-id");
            let country = $(".ctr_general").find("> p").attr("data-id");
            let violationType = $(".list--violation--type")
            .find("> p")
            .attr("data-id");
            let search = $(".search").val() ? $(".search").val().trim() : "";
            let perpageText = $(".list--showing").find("select").val() || perpage;
            let end__Date = "";
            let start__Date = "";
            if (date !== "") {
                let arr = date.split("-");
                let startDatePicker = arr[0].split("/")
                let endDatePicker = arr[1].split("/")
                start__Date = `${startDatePicker[1].trim()}-${startDatePicker[0].trim()}-${startDatePicker[2].trim()}`
                end__Date = `${endDatePicker[1].trim()}-${endDatePicker[0].trim()}-${endDatePicker[2].trim()}`
            }
            return new keywordSearch(
                search,
                brandCompany,
                country,
                violationType,
                start__Date,
                end__Date,
                perpageText,
                sortBy,
                sortValue,
                page
            );
        }else{
            let date = $("input[name=daterange]:visible").val();
            let brandCompany = $(".select--company-or-brand").closest(".checkbox_mobi").find("p").attr("data-id") || ""
            let country = $(".filter_country_mobi").closest(".checkbox_mobi").find("p").attr("data-id") || ""
            let violationType = $(".select--violation--type").closest(".checkbox_mobi").find("p").attr("data-id") || ""
            let search = $(".search").val() ? $(".search").val().trim() : "";
            let perpage = $(".select--showing").closest(".checkbox_mobi").find("> p").attr("data-id") || "";
            let end__Date = "";
            let start__Date = "";
            if (date !== "" && date) {
                let arr = date.split("-");
                let startDatePicker = arr[0].split("/")
                let endDatePicker = arr[1].split("/")
                start__Date = `${startDatePicker[1].trim()}-${startDatePicker[0].trim()}-${startDatePicker[2].trim()}`
                end__Date = `${endDatePicker[1].trim()}-${endDatePicker[0].trim()}-${endDatePicker[2].trim()}`
            }
            return new keywordSearch(
                search,
                brandCompany,
                country,
                violationType,
                start__Date,
                end__Date,
                perpage,
                sortBy,
                sortValue,
                page
            );
        }
    }

    // --------------CHANGE PARAMETERS--------------
    function keywordSearch(
        search,
        brandCompany,
        country,
        violationType,
        startDate,
        endDate,
        perpage,
        sortBy,
        sortValue,
        page,
    ) {
        this.search =
            search !== "" && search !== null ? `&keyword=${search}` : "";
        this.brandCompany =
            brandCompany && brandCompany != 0
                ? `&company_brand_id=${brandCompany}`
                : "";
        this.country = country && country != 0 ? `&country=${country}` : "";
        this.violationType =
            violationType && violationType != 0
                ? `&violation_type_id=${violationType}`
                : "";
        this.startDate = startDate ? `&start_date=${startDate}` : "";
        this.endDate = endDate ? `&end_date=${endDate}` : "";
        this.perpage = perpage ? `&perpage=${perpage}` : "";
        this.sortBy = sortBy ? `&sort_by=${sortBy}` : "";
        this.sortValue = sortValue ? `&sort_value=${sortValue}` : "";
        this.page = page ? `&page=${page}` : "";
        this.violation_code = violation_code_id ? `&violation_code_id=${violation_code_id}` : "";
    }
    // URL PARAM
    function replaceURL(sortBy, sortValue, page) {
        data = getParams(sortBy, sortValue, page);
        let url = "";
        Object.keys(data).map((item) => {
            if (data[item] !== "") {
                url += `${data[item]}`;
            }
        });

        if (queryString !== url.replace("&", "?")) {
            window.location.replace(
                `${window.location.pathname}${url.replace("&", "?")}`
            );
        }
    }

    // REMOVE DATERANGE
    $(".remove_daterange").click(function(){
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        let date = $("input[name=daterange]:visible").val();
        if(date !== ""){
            $('input[name="daterange"]').val("")
            if(width > 1113){
                replaceURL()
            }
        }
    })

    $(".style__code--article div > a").click(function(){
        let getId = $(this).attr("id")
        geturl(getId,"violation_code_id")
    })

    $(".bot-violation-code > a").click(function(){
        let getId = $(this).attr("id")
        geturl(getId,"violation_type_id")
    })

    function geturl(getId,nameParams){
        let url = window.location.href
        let newUrl;
        if(url.includes(nameParams)){
            if(nameParams == "violation_code_id"){
                newUrl = url.replace(`${nameParams}=${violation_code_id}`,`${nameParams}=${getId}`)
            }else{
                newUrl = url.replace(`${nameParams}=${paramViolation}`,`${nameParams}=${getId}`)
            }
        }else{
            if(url.includes("?")){
                newUrl = `${url}&${nameParams}=${getId}`
            }else{
                newUrl = `${url}?${nameParams}=${getId}`
            }
        }
        window.location.href = newUrl
    }

});
