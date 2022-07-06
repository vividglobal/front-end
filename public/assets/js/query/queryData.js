$("document").ready(function () {

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
                picker.startDate.format("DD/MM/YYYY") +
                    " - " +
                    picker.endDate.format("DD/MM/YYYY")
            );
            startDate = picker.startDate.format("DD-MM-YYYY");
            endDate = picker.endDate.format("DD-MM-YYYY");
        }
    );

    // VALUE PARAMS
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
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
    }

    if (paramStart_date !== null && paramEnd_date !== null) {
        let startDay = paramStart_date.replace(/-/g, "/");
        let endDay = paramEnd_date.replace(/-/g, "/");
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
        let list = $(".list--country");
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

    function returnTextButtonQuery(nameBtn, textBtn, selectBtn, option, param,nameMb) {
        let name = $(nameBtn).find(`#${param}`).find("p").text();
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
    //  APPLY BUTTON
    function resetFiter(){
        $("#myFilter").removeClass("open_menu")
        $(".overlay").css({"width":"0%","display":"none"})
        $(".checkbox_mobi").find("#toggle").hide()
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
    }

    $(".close__filter").click(function() {
            $(".select__one").find("input").prop('checked',false)
            $(".select__one").find("span").removeClass("activeRadio")
            $("select__one--country").find("input").prop('checked',false)
            $(".select__one--country").find("span").removeClass("activeRadio")
            $("select__one--violation--type").find("input").prop('checked',false)
            $(".select__one--violation--type").find("span").removeClass("activeRadio")
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
        resetFiter()
    })

    $(".btn__apply").on("click", function () {
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width > 1113){
            replaceURL(paramSortBy, paramSortValue);
        }else{
            let getParamSortValue = $(".sort_mobi").find("> p").attr("data-value")
            let getParamSortBy = $(".sort_mobi").find("> p").attr("data-by")
            if(getParamSortBy !== undefined && getParamSortValue !== undefined){
                if(getParamSortValue == "A to Z"){
                    replaceURL(getParamSortBy,"asc");
                }else{
                    replaceURL(getParamSortBy,"desc");
                }
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

    // SORT BUTTON UP
    $(".sort_up").click(function () {
        var sortBy = $(this).closest("div").find("p").text().toLowerCase();
        if (sortBy == "country" || sortBy == "company" || sortBy == "brand") {
            sortBy = `${sortBy}_name`;
        } else if (/ /g.test(sortBy)) {
            sortBy = sortBy.replace(/ /g, "_");
        } else if (sortBy == "status") {
            sortBy = $(this).closest("div").find("p").attr("data-sort");
        }
        var sortValue = "asc";
        replaceURL(sortBy, sortValue);
    });
    // SORT BUTTON DOWM
    $(".sort_down").click(function () {
        var sortBy = $(this).closest("div").find("p").text().toLowerCase();
        if (sortBy == "country" || sortBy == "company" || sortBy == "brand") {
            sortBy = `${sortBy}_name`;
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

    //GET VALUE
    function getParams(sortBy, sortValue, page) {
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width > 1113){
            let date = $('input[name="daterange"]').val() || "";
            let brandCompany = $(".list--company--brand")
            .find("> p")
            .attr("data-id");
            let country = $(".list--country").find("> p").attr("data-id");
            let violationType = $(".list--violation--type")
            .find("> p")
            .attr("data-id");
            let search = $(".search").val() ? $(".search").val() : "";
            let perpage = $(".list--showing").find("select").val();
            let end__Date = "";
            let start__Date = "";
            if (date !== "") {
                let arr = date.split("-");
                end__Date = arr[1].trim().replace(/[/]/g, "-");
                start__Date = arr[0].trim().replace(/[/]/g, "-");
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
        }else{
            let date = $('.date_mobile').val() || "";
            let brandCompany = $(".select--company-or-brand").closest(".checkbox_mobi").find("p").attr("data-id") || ""
            let country = $(".select--country").closest(".checkbox_mobi").find("p").attr("data-id") || ""
            let violationType = $(".select--violation--type").closest(".checkbox_mobi").find("p").attr("data-id") || ""
            let search = $(".search").val() ? $(".search").val() : "";
            let perpage = "";
            let end__Date = "";
            let start__Date = "";
            if (date !== "") {
                let arr = date.split("-");
                end__Date = arr[1].trim().replace(/[/]/g, "-");
                start__Date = arr[0].trim().replace(/[/]/g, "-");
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
        page
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
    }

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
        let date = $('input[name="daterange"]').val()
        if(date !== ""){
            $('input[name="daterange"]').val("")
            replaceURL(paramSortBy, paramSortValue)
        }
    })

});
