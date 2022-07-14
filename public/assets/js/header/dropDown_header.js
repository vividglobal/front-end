$("document").ready(function(){
    $(document).mouseup(function(e){
       //dropdown trace violation
       var btn = $(".name_trace--violation")

       if (!btn.is(e.target) && btn.has(e.target).length === 0) {
               $(".nav--dropdown").hide()
       }else{
           $(".nav--dropdown").slideToggle(200,'linear');
       }
       //dropdown after login
       var dropdown = $(".after-login")

       if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0) {
               $(".dropdown-login").hide()
       }else{
           $(".dropdown-login").slideToggle(200,'linear');
       }
   });

//    ---------NAV MENU---------
    var documentElement = document.querySelector('.overlay');

    $(".open_Nav").click(function(){
        $("#myNav").addClass("open_menu")
        $("#myFilter").removeClass("open_menu")
        $(".overlay").css({"width":"100%","display":"block"})
        $(".nav--btn__after--login").find("div").find("img").attr("src","../assets/image/Under-than-white.svg")
        $(".after-login").find("img:nth-child(2)").attr("src","../assets/image/Under-than-white.svg")
        scrollScreen.disable()
    })

    function closeNav() {
        $("#myNav").removeClass("open_menu")
        $("#myFilter").removeClass("open_menu")
        $(".overlay").css({"width":"0%","display":"none"})
        $(".nav--btn__after--login").find("div").find("img").attr("src","../assets/image/Under-than.svg")
        $(".after-login").find("img:nth-child(2)").attr("src","../assets/image/Under-than.svg")
        scrollScreen.enable()
    }

//    ---------NAV FILTER---------
$(".open_Nav_filter ").click(function(){
    $("#myFilter").addClass("open_menu")
    $("#myNav").removeClass("open_menu")
    $(".overlay").css({"width":"100%","display":"block"})
    scrollScreen.disable()
})

$(".closeFilter ").click(function(){
    $("#myFilter").removeClass("open_menu")
    $(".overlay").css({"width":"0%","display":"none"})
    $(".checkbox_mobi").find("#toggle").hide()
    scrollScreen.enable()
})

    $("#myNav").find(".closebtn").click(function(){
        closeNav();
    })

    $(".overlay_nav").click(function(){
        closeNav()
    })

    $(".nav-link").click(function(){
        closeNav()
    })

    $(".dropdown-item").click(function(){
        closeNav()
    })

    $("#edit__profile").click(function(){
        $("#myNav").removeClass("open_menu")

    })

})
