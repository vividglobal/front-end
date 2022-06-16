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
    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        startDate = picker.startDate.format('DD-MM-YYYY');
        endDate = picker.endDate.format('DD-MM-YYYY');
    });

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const perpage = urlParams.get('perpage')
    const paramSearch = urlParams.get('keyword')
    const paramStart_date = urlParams.get('start_date')
    const paramEnd_date = urlParams.get('end_date')
    const parambrands = urlParams.get('company_brand_id')
    const paramCountry = urlParams.get('country')
    const paramViolation = urlParams.get('violation_type_id')

    if(perpage !== null){
        $(".list--showing").find("select").val(parseInt(perpage))
    }

    if(paramSearch !== null){
        $(".search").val(paramSearch)
    }

    if(paramStart_date !== null && paramEnd_date !== null){
       let startDay = paramStart_date.replace(/-/g,"/")
       let endDay = paramEnd_date.replace(/-/g,"/")
        $('input[name="daterange"]').val(startDay + ' - ' + endDay)
    }

    if(parambrands !== null){
       let name = $(".select--company-or-brand").find(`#${parambrands}`).find("p").text()
        $(".list--company--brand").find("> p").text(name)
        $(".list--company--brand").find("> p").attr("data-id",parambrands)
        $(".select--company-or-brand").find(".contain--selection .select__one").removeClass("background-gray")
        $(".select--company-or-brand").find(`#${parambrands}`).find("img").show()
        $(".select--company-or-brand").find(`#${parambrands}`).addClass("background-gray")
    }

    if(paramCountry !== null){
        let name = $(".select--country").find(`#${paramCountry}`).find("p").text()
         $(".list--country").find("> p").text(name)
         $(".list--country").find("> p").attr("data-id",paramCountry)
         $(".select--country").find(".contain--selection .option_general").removeClass("background-gray")
         $(".select--country").find(`#${paramCountry}`).find("img").show()
         $(".select--country").find(`#${paramCountry}`).addClass("background-gray")
     }

     if(paramViolation !== null){
        let name = $(".select--violation--type").find(`#${paramViolation}`).find("p").text()
         $(".list--violation--type").find("> p").text(name)
         $(".list--violation--type").find("> p").attr("data-id",paramViolation)
         $(".select--violation--type").find(".contain--selection .select__one--violation--type").removeClass("background-gray")
         $(".select--violation--type").find(`#${paramViolation}`).find("img").show()
         $(".select--violation--type").find(`#${paramViolation}`).addClass("background-gray")
     }

    $(".btn__apply").on("click",function(){
        data = getParams()
        let url= "";
        Object.keys(data).map(item=>{
            if(data[item] !== ""){
                url += `${data[item]}`
            }
        })
        // if(data.search !== "" || data.brandCompany !== "" || data.country !== "" || data.violationType !== "" || data.startDate !== "" || data.endDate!== ""){
            if(queryString !== url.replace('&','?')){
                window.location.replace(`${window.location.pathname}${url.replace('&','?')}`)
            }
        // }
    })

    //List showing
    $(".list--showing").find("select").on("change",function(){
        data = getParams()
        let url= "";
        Object.keys(data).map(item=>{
            if(data[item] !== ""){
                url += `${data[item]}`
            }
        })
        window.location.replace(`${window.location.pathname}${url.replace('&','?')}`)
    })

    function getParams (){
        let search = $(".search").val() ? $(".search").val() : "";
        let brandCompany = $(".list--company--brand").find("> p").attr("data-id");
        let country = $(".list--country").find("> p").attr("data-id");
        let violationType = $(".list--violation--type").find("> p").attr("data-id");
        let perpage = $(".list--showing").find("select").val() ? $(".list--showing").find("select").val() : 10
        let date = $('input[name="daterange"]').val()
        let end__Date = "";
        let start__Date = "";
        if(date !== ""){
            let arr = date.split('-')
            end__Date = arr[1].trim().replace(/[/]/g,"-")
            start__Date = arr[0].trim().replace(/[/]/g,"-")
        }
        return new keywordSearch(search,brandCompany,country,violationType,start__Date,end__Date,perpage)
    }
    // ----------------------------
    function keywordSearch(search,brandCompany,country,violationType,startDate,endDate,perpage){
        this.search = search !== "" && search !== null ? `&keyword=${search}` : ""
        this.brandCompany = brandCompany && brandCompany != 0 ? `&company_brand_id=${brandCompany}` : "";
        this.country = country && country != 0 ? `&country=${country}` : "";
        this.violationType = violationType && violationType != 0 ? `&violation_type_id=${violationType}` : "";
        this.startDate = startDate ? `&start_date=${startDate}` : "";
        this.endDate = endDate ? `&end_date=${endDate}` : "";
        this.perpage = `&perpage=${perpage}`;
    }
})
