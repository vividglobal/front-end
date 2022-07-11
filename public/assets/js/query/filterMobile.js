$(document).ready(function(){

    $(".checkbox_title").click(function(){
        $(".checkbox_title").not(this).closest(".checkbox_mobi").find("#toggle").hide()
        $(this).closest(".checkbox_mobi").find("#toggle").slideToggle(300,'linear')
    })

    $(".select__one").change(function(){
        let value =  $(this).find("p").text()
        let id  = $(this).find("p").attr("data-id")
            $(".select__one").find("input").prop('checked',false)
            $(".select__one").find("span").removeClass("activeRadio")
            $(this).find("input").prop('checked',true)
            $(this).find("span").addClass("activeRadio");
            $(this).closest(".contain--selection").closest(".select--company-or-brand").closest(".checkbox_mobi").find("> p").text("")
            $(this).closest(".contain--selection").closest(".select--company-or-brand").closest(".checkbox_mobi").find("> p").attr("data-id",0)
        if(value !== "None" && id !== 0){
            $(this).closest(".contain--selection").closest(".select--company-or-brand").closest(".checkbox_mobi").find("> p").text(value)
            $(this).closest(".contain--selection").closest(".select--company-or-brand").closest(".checkbox_mobi").find("> p").attr("data-id",id)
        }
    })

    $(".select__one--country").change(function(){
        let value =  $(this).find("p").text()
        let id  = $(this).find("p").attr("data-id")
        $("select__one--country").find("input").prop('checked',false)
        $(".select__one--country").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        $(this).closest(".contain--selection").closest(".select--country").closest(".checkbox_mobi").find("> p").text("")
        $(this).closest(".contain--selection").closest(".select--country").closest(".checkbox_mobi").find("> p").attr("data-id",0)
        if(value !== "None" && id !== 0){
            $(this).closest(".contain--selection").closest(".select--country").closest(".checkbox_mobi").find("> p").text(value)
            $(this).closest(".contain--selection").closest(".select--country").closest(".checkbox_mobi").find("> p").attr("data-id",id)
        }
    })

    $(".select__one--violation--type").change(function(){
        let value =  $(this).find("p").text()
        let id  = $(this).find("p").attr("data-id")
        $("select__one--violation--type").find("input").prop('checked',false)
        $(".select__one--violation--type").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        $(this).closest(".select--violation--type").closest(".checkbox_mobi").find("> p").text("")
        $(this).closest(".select--violation--type").closest(".checkbox_mobi").find("> p").attr("data-id",0)
        if(value !== "None" && id !== 0){
            $(this).closest(".select--violation--type").closest(".checkbox_mobi").find("> p").text(value)
            $(this).closest(".select--violation--type").closest(".checkbox_mobi").find("> p").attr("data-id",id)
        }
    })

    //SORT
    $(".sort_value").find(".container_checkbox:first-child").find("input").prop('checked',true)
    $(".sort_value").find(".container_checkbox:first-child").find("span").addClass("activeRadio")

    $(".sort_value").find(".container_checkbox").change(function() {
        let sortBy = $(this).find("p").attr("data-value")
        let value =  $(this).find("p").text()
        $(".sort_value").find(".container_checkbox").find("input").prop('checked',false)
        $(".sort_value").find(".container_checkbox").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find("> p").text(`${value}`)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find("> p").attr("data-value",sortBy)
        let dateName = $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find("> p").attr("data-name");
        if(dateName){
            $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find("> p").text(`${value}: ${dateName} `)
        }
    })

    $(".sort_by").find(".container_checkbox").change(function() {
        let sortValue = $(this).find("p").attr("data-by")
        let value =  $(this).find("p").text()
        $(".sort_by").find(".container_checkbox").find("input").prop('checked',false)
        $(".sort_by").find(".container_checkbox").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        let getSort =  $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find("> p").attr("data-value")
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find("> p").text(`${getSort}: ${value}`)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find("> p").attr("data-by",sortValue)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find("> p").attr("data-name",value)
    })

    $(".sort_based_on_brands").find(".container_checkbox").change(function() {
        let sortValue = $(this).find("p").attr("data-sort-value")
        let sortField = $(this).find("p").attr("data-sort-field")
        let value =  $(this).find("p").text()
        let table =  $(this).find("p").attr("data-table")
        $(".sort_based_on_brands").find(".container_checkbox").find("input").prop('checked',false)
        $(".sort_based_on_brands").find(".container_checkbox").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find(".text_brand").text(`${value} (Sort based on brand)`)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find(".text_brand").attr("data-sort-value",sortValue)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find(".text_brand").attr("data-sort-field",sortField)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find(".text_brand").attr("data-table",table)
    })

    $(".sort_based_on_code").find(".container_checkbox").change(function() {
        let sortValue = $(this).find("p").attr("data-sort-value")
        let sortField = $(this).find("p").attr("data-sort-field")
        let value =  $(this).find("p").text()
        let table =  $(this).find("p").attr("data-table")
        $(".sort_based_on_code").find(".container_checkbox").find("input").prop('checked',false)
        $(".sort_based_on_code").find(".container_checkbox").find("span").removeClass("activeRadio")
        $(this).find("input").prop('checked',true)
        $(this).find("span").addClass("activeRadio");
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find(".text_code").text(`${value} (Sort based on code)`)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find(".text_code").attr("data-sort-value",sortValue)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find(".text_code").attr("data-sort-field",sortField)
        $(this).closest(".checkbox_list_sort").closest(".checkbox_mobi").find(".text_code").attr("data-table",table)
    })

})


