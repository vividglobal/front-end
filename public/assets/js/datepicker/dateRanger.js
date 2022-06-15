$("document").ready(function(){
    $('input[name="daterange"]').daterangepicker({
        autoUpdateInput: false,
        autoApply: true,
        maxDate: new Date(),
        drops: 'up',
        opens: 'right',
        drops:'down',
        locale: {
            firstDay: 1,
            format: 'DD/MM/YYYY',
        },
    })
    let startDate;
    let endDate;
    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM') + ' - ' + picker.endDate.format('DD/MM'));
        startDate = picker.startDate.format('DD-MM-YYYY');
        endDate = picker.endDate.format('DD-MM-YYYY');
    });

    $(".btn__apply").on("click",function(){
        data = getValue()
        let url= "";
        Object.keys(data).map(item=>{
            if(data[item] !== ""){
                url += `${data[item]}`
            }
        })

        if(data.search !== "" || data.brandCompany !== "" || data.country !== "" || data.violationType !== "" || data.startDate !== "" || data.endDate!== ""){
            window.location.replace(`${window.location.pathname}${url.replace('&','?')}`)
        }
    })

    //List showing
    $(".list--showing").find("select").on("change",function(){
        data = getValue()
        let url= "";
        Object.keys(data).map(item=>{
            if(data[item] !== ""){
                url += `${data[item]}`
            }
        })
        window.location.replace(`${window.location.pathname}${url.replace('&','?')}`)
    })

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const perpage = urlParams.get('perpage')
    if(perpage !== null){
        $(".list--showing").find("select").val(parseInt(perpage))
    }

    function getValue (){
        let search = $(".search").val() ? $(".search").val() : "";
        let brandCompany = $(".list--company--brand").find("> p").attr("data-id");
        let country = $(".list--country").find("> p").attr("data-id");
        let violationType = $(".list--violation--type").find("> p").attr("data-id");
        let perpage = $(".list--showing").find("select").val() ? $(".list--showing").find("select").val() : 10
        return new keywordSearch(search,brandCompany,country,violationType,startDate,endDate,perpage)
    }

    // ----------------------------
    function keywordSearch(search,brandCompany,country,violationType,startDate,endDate,perpage){
        this.search = search !== "" ? `&keyword=${search}` : ""
        this.brandCompany = brandCompany && brandCompany != 0 ? `&company_brand_id=${brandCompany}` : "";
        this.country = country && country != 0 ? `&country=${country}` : "";
        this.violationType = violationType && violationType != 0 ? `&violation_type_id=${violationType}` : "";
        this.startDate = startDate ? `&start_date=${startDate}` : "";
        this.endDate = endDate ? `&end_date=${endDate}` : "";
        this.perpage = `&perpage=${perpage}`;
    }
})
