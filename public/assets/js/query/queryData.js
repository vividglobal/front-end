$("document").ready(function () {
    $('input[name="daterange"]').daterangepicker({
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

    // VALUE PARAMS
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const perpage = urlParams.get("perpage");
    const paramStart_date = urlParams.get("start_date");
    const paramEnd_date = urlParams.get("end_date");
    const parambrands = urlParams.get("company_brand_id");
    const paramCountry = urlParams.get("country");
    const paramViolation = urlParams.get("violation_type_id");
    const paramSortBy = urlParams.get("sort_by");
    const paramSortValue = urlParams.get("sort_value");
    const violation_code_id = urlParams.get("violation_code_id");

    if (perpage !== null) {
        $(".list--showing").find("select").val(parseInt(perpage));
    }

    if (paramStart_date !== null && paramEnd_date !== null) {
        let startDay = paramStart_date.replace(/-/g, "/");
        let endDay = paramEnd_date.replace(/-/g, "/");
        $('input[name="daterange"]').val(startDay + " - " + endDay);
    }

    if (parambrands !== null) {
        let name = $(".select--company-or-brand");
        let list = $(".list--company--brand");
        let select = $(".select--company-or-brand");
        let option = ".select__one";
        returnTextButtonQuery(name, list, select, option, parambrands);
    }

    if (paramCountry !== null) {
        let name = $(".select--country");
        let list = $(".list--country");
        let select = $(".select--country");
        let option = ".option_general";
        returnTextButtonQuery(name, list, select, option, paramCountry);
    }

    if (paramViolation !== null) {
        let name = $(".select--violation--type");
        let list = $(".list--violation--type");
        let select = $(".select--violation--type");
        let option = ".select__one--violation--type";
        returnTextButtonQuery(name, list, select, option, paramViolation);
    }

    if (violation_code_id !== null) {
        $(".style__code--article")
            .find("div")
            .find(`#${violation_code_id}`)
            .css({ "text-decoration": "underline" });
    }

    ///ENABLE---- DISABLE SORT IMAGE
    if (paramSortBy !== null && paramSortValue !== null) {
        if (paramSortValue === "asc") {
            var up_disable = "../assets/image/Archive/up_disable.svg";
            var btn = ".sort_up";
            switch (paramSortBy) {
                case "company_name":
                    $(".sort_company").find(btn).attr("src", up_disable);
                    break;
                case "country_name":
                    $(".sort_country").find(btn).attr("src", up_disable);
                    break;
                case "brand_name":
                    $(".sort_brand").find(btn).attr("src", up_disable);
                    break;
                case "published_date":
                    $(".sort_public_date").find(btn).attr("src", up_disable);
                    break;
                case "crawl_date":
                    $(".sort_crawl_date").find(btn).attr("src", up_disable);
                    break;
                case "sort_bot_status":
                    $(".sort_crawl_date").find(btn).attr("src", up_disable);
                    break;
                case "supervisor_status":
                    $(".sort_supervisor").find(btn).attr("src", up_disable);
                    break;
                case "operator_status":
                    $(".sort_operator").find(btn).attr("src", up_disable);
                    break;
                case "penalty_issued":
                    $(".sort_penalty_issued").find(btn).attr("src", up_disable);
                    break;
                default:
            }
        } else {
            var up_disable = "../assets/image/Archive/down_disable.svg";
            var btn = ".sort_down";
            switch (paramSortBy) {
                case "company_name":
                    $(".sort_company").find(btn).attr("src", up_disable);
                    break;
                case "country_name":
                    $(".sort_country").find(btn).attr("src", up_disable);
                    break;
                case "brand_name":
                    $(".sort_brand").find(btn).attr("src", up_disable);
                    break;
                case "published_date":
                    $(".sort_public_date").find(btn).attr("src", up_disable);
                    break;
                case "crawl_date":
                    $(".sort_crawl_date").find(btn).attr("src", up_disable);
                    break;
                case "sort_bot_status":
                    $(".sort_crawl_date").find(btn).attr("src", up_disable);
                    break;
                case "supervisor_status":
                    $(".sort_supervisor").find(btn).attr("src", up_disable);
                    break;
                case "operator_status":
                    $(".sort_operator").find(btn).attr("src", up_disable);
                    break;
                case "penalty_issued":
                    $(".sort_penalty_issued").find(btn).attr("src", up_disable);
                    break;
                default:
            }
        }
    }

    function returnTextButtonQuery(nameBtn, textBtn, selectBtn, option, param) {
        let name = $(nameBtn).find(`#${param}`).find("p").text();
        $(textBtn).find("> p").text(name);
        $(textBtn).find("> p").attr("data-id", param);
        $(selectBtn)
            .find(`.contain--selection ${option}`)
            .removeClass("background-gray");
        $(selectBtn).find(`#${param}`).find("img").show();
        $(selectBtn).find(`#${param}`).addClass("background-gray");
    }

    //  ----------------------------
    //  APPLY BUTTON
    $("#apply_query").on("click", function () {
        replaceURL(paramSortBy, paramSortValue);
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
        let search = $(".search").val() ? $(".search").val() : "";
        let brandCompany = $(".list--company--brand")
            .find("> p")
            .attr("data-id");
        let country = $(".list--country").find("> p").attr("data-id");
        let violationType = $(".list--violation--type")
            .find("> p")
            .attr("data-id");
        let perpage = $(".list--showing").find("select").val();
        let date = $('input[name="daterange"]').val() || "";
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
});
