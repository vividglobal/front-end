$("document").ready(function(){
    $(document).mouseup(function(e){
       //dropdown trace violation
       var btn = $(".nav--btn__after--login:nth-child(3)")

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

   $('#btn_explore').click(function(event) {
        window.scrollTo(0,document.body.scrollHeight);
    })

})
