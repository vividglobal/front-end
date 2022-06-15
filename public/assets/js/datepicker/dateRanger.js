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
    let startDate = "";
    let endDate = "";
    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM') + ' - ' + picker.endDate.format('DD/MM'));
        startDate = picker.startDate.format('DD/MM/YYYY');
        endDate = picker.endDate.format('DD/MM/YYYY');
    });

    $(".btn__apply").on("click",function(){
        let search = $(".search").val() ? $(".search").val() : "";
        let brandCompany = $(".list--company--brand").find("> p").text();
        let country = $(".list--country").find("> p").text();
        let violationType = $(".list--violation--type").find("> p").text();
        let data = new keywordSearch(brandCompany,country,violationType)
        let perpage = $(".list--showing").find("select").val() ? $(".list--showing").find("select").val() : 10
        if(search !== "" || data.brandCompany !== "" || data.country !== "" || data.violationType !== "" || startDate !== "" || endDate !== ""){
var url = `${window.location.pathname}?keyword=${search}
&start_date=${startDate}&end_date=${endDate}&company_brand_id=${data.brandCompany}
&country=${data.country}&violation_type_id=${data.violationType}&perpage=${perpage}`;
            window.location.replace(url)
        }
    })

    function keywordSearch(brandCompany,country,violationType){
          this.brandCompany = brandCompany !== "Brand/Company" ? brandCompany : "";
          this.country = country !== "Country" ? country : "";
          this.violationType = violationType !== "Violation type" ? violationType : "";
    }
})
