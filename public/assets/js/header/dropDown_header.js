$("document").ready(function(){
    $(document).mouseup(function(e){
       //dropdown trace violation
       var btn = $(".dropdown_header")

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
            let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            if(width > 1113){
                $(".dropdown-login").slideToggle(200,'linear');
            }
       }
   });

//    ---------NAV MENU---------
    var documentElement = document.querySelector('.overlay');

    $(".open_Nav").click(function(){
        navigation.show("#myNav")
        navigation.hide("#myFilter")
        overlay.show()
        $(".nav--btn__after--login").find("div").find("img").attr("src","../assets/image/Under-than-white.svg")
        $(".after-login").find("img:nth-child(2)").attr("src","../assets/image/Under-than-white.svg")
        $(".overlay_header").css("left","0")
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width < 1113){
            $(".overlay").css("z-index","2")
        }
        scrollScreen.disable()
    })

    function closeNav() {
        navigation.hide("#myNav")
        navigation.hide("#myFilter")
        overlay.hide()
        $(".nav--btn__after--login").find("div").find("img").attr("src","../assets/image/Under-than.svg")
        $(".after-login").find("img:nth-child(2)").attr("src","../assets/image/Under-than.svg")
        $(".overlay_header").css("left","-100%")
        scrollScreen.enable()
    }

//    ---------NAV FILTER---------
$(".open_Nav_filter ").click(function(){
    navigation.hide("#myNav")
    navigation.show("#myFilter")
    overlay.show()
    scrollScreen.disable()
})

$(".closeFilter ").click(function(){
    navigation.hide("#myFilter")
    overlay.hide()
    $(".checkbox_mobi").find("#toggle").hide()
    scrollScreen.enable()
})

    $("#myNav").find(".closebtn").click(function(){
        closeNav();
    })

    $(".overlay_nav").click(function(){
        closeNav()
        $(".no_search_result").hide()
    })

    // $(".nav-link").click(function(){
    //     closeNav()
    // })

    // $(".dropdown-item").click(function(){
    //     closeNav()
    // })

    $("#edit__profile").click(function(){
        navigation.hide("#myNav")
        let width  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width < 1113){
            $(".overlay").css("z-index","0")
            $(".btn_menu_nav").show()
        }
    })

    $(".name_user").click(function(){

        if($(".edit_profile_mb").hasClass("show")){
            $(".nav_home").removeClass("padding-70")
            $(".edit_profile_mb").addClass("hide").removeClass("show")
        }else{
            $(".nav_home").addClass("padding-70")
            $(".edit_profile_mb").addClass("show").removeClass("hide")
        }
    })

})
