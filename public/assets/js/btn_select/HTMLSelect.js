$("document").ready(function(){
         //btn showing
        let btnShowing = $(".list--showing").find("select")
        var showing = [25,50,100]
        showing.map(item=>{
            var html = `<option value="${item}">${item}</option>`
            btnShowing.append(html)
        })


        $("#btn_explore").click(function(){
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".background__vituar-2").offset().top
            });
        })
})
