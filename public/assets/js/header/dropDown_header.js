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
    let btnShowNav = document.querySelector(".open_Nav")
    let btnHideNav = document.querySelector(".closebtn")
    let screenOverlay = document.querySelector(".overlay_nav")

    btnShowNav.onclick = function(){
        $("#myNav").addClass("open_menu")
        $(".overlay").css({"width":"100%","display":"block"})
        document.documentElement.style.overflow = 'hidden';
        document.body.scroll = "no";
    }

    function closeNav() {
        $("#myNav").removeClass("open_menu")
        $(".overlay").css({"width":"0%","display":"none"})
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
    }

    btnHideNav.onclick = function(){
        closeNav();
    }

    screenOverlay.onclick = function(){
        closeNav();
    }

    var $window = $(window);

    function checkWidth() {
        var windowsize = $window.width();
        if (windowsize < 1113) {
            $(".nav--btn__after--login").find("div").find("img").attr("src","../assets/image/Under-than-white.svg")
            $(".after-login").find("img:nth-child(2)").attr("src","../assets/image/Under-than-white.svg")
        }else{
            $(".nav--btn__after--login").find("div").find("img").attr("src","../assets/image/Under-than.svg")
            $(".after-login").find("img:nth-child(2)").attr("src","../assets/image/Under-than.svg")
        }
    }
    $(window).resize(checkWidth);

})
