$(document).ready(function(){
    $(".accordion").click(function(e){
        let target = $(this).closest('a').attr("href");
        var img = $(this).find("img").attr("src")
        $(".accordion").not(this).closest('a').closest(".wrap-accordion").find(".panel").hide()
        $(".accordion").not(this).closest('a').closest(".wrap-accordion").find(".panel").find("div").hide()
        $(".accordion").not(this).closest('a').closest(".wrap-accordion").find(".panel").find("a").find("img").attr("src","../../assets/image/plus.svg")
        $(".accordion").find("img").attr("src","../../assets/image/plus.svg")
        if(img.indexOf("plus")!== -1){
            $(this).find("img").attr("src","../../assets/image/minus.svg")
            $(target).show();
        }else{
            $(this).find("img").attr("src","../../assets/image/plus.svg")
            $(target).hide();
        }
    })

    $(".child-accordion").click(function(e){
        let target = $(this).closest('a').attr("href");
        var img = $(this).find("img").attr("src")
        $(".child-accordion").not(this).closest('a').closest(".panel").find(".add").hide()
        $(".child-accordion").not(this).closest('a').closest(".panel").find("a").find("img").attr("src","../../assets/image/plus.svg")
        if(img.indexOf("plus")!== -1){
            $(this).find("img").attr("src","../../assets/image/minus.svg")
            $(target).show();
        }else{
            $(this).find("img").attr("src","../../assets/image/plus.svg")
            $(target).hide();
        }
    })
})
