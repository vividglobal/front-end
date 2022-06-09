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
        $(this).val(picker.startDate.format('DD/MM') + ' - ' + picker.endDate.format('DD/MM'));
    });
})
