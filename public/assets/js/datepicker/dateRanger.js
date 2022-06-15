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
        let search = $(".search").val()
        let brandCompany = $(".list--company--brand").find("> p").text();
        let country = $(".list--country").find("> p").text();
        let violationType = $(".list--violation--type").find("> p").text();
        let data = new keywordSearch(search,startDate,endDate,brandCompany,country,violationType)
        let date = data.date.startDate !== "" ? `${data.date.startDate+"-"+data.date.endDate}` : ""
        window.location.replace(`${window.location.pathname}?search=${data.search}&daterange=${date}&brandCompany=${data.brandCompany}&country=${data.country}&violationtype=${data.violationType}`)

    })

    function keywordSearch(search,startDate,endDate,brandCompany,country,violationType){
          this.search = search;
          this.date = {startDate: startDate, endDate: endDate};
          this.brandCompany = brandCompany !== "Brand/Company" && brandCompany || "";
          this.country = country !== "Country" && country || "";
          this.violationType = violationType !== "Violation type" && violationType || "";
    }
})
