$("document").ready(function(){
    var selectBrand = $(".select--company-or-brand");
    var selectOneBrand = $(".select__one");
    var btnBrand = $(".list--company--brand");
    var searchBrand = $(".search--brand");

    $(".select__one:first-child").addClass("background-gray")

    selectOneBrand.on("click", function(){
        var value = $(this).find("p").html()
        if(value.indexOf("-") === -1){
            btnBrand.find("> p").html(value)
        }
        selectOneBrand.removeClass("background-gray")
        selectOneBrand.find("img").hide()
        $(this).addClass("background-gray")
        $(this).find("img").show()
    })
    $(document).mouseup(function(e){
        var input = $(".search--input");

            if (!btnBrand.is(e.target) && btnBrand.has(e.target).length === 0) {
                selectBrand.hide()
            }else{
                if (!input.is(e.target) && input.has(e.target).length === 0)
                    {
                        selectBrand.slideToggle(300,'linear');
                        searchBrand.val("")
                    }
            }
    });

    $(".btn-search").on("click", function(e){
        e.preventDefault();
        var search = $(".search").val()
        if(search.length > 0){
            // $.ajax({
            //     type:"get",
            //     url: "/articles/violation?search=${search}",
            //     data:{
            //         pathname: window.location.pathname,
            //         search: search
            //     },
            //     success:function(response){
            //     },
            //     error: function(response) {

            //     },
            // });
            window.location.href = `/articles/violation?search=${search}`;
        }
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    })
})
