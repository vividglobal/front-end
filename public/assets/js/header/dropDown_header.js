$("document").ready(function(){
    $(document).mouseup(function(e){
       //dropdown trace violation
       var dropdown = $(".btn-dropdown")
       
       if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0) {
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
})