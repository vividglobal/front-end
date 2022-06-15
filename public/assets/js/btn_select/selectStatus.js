// $("document").ready(function(){
//     var selectCountry = $("#language");
//     var selectOneCountry = $(".select-language");
//     var btnCountry = $("#btn-language");
//     var searchCountry = $("#language-search");

//     $(".select__one--country:first-child").addClass("background-gray")
//     selectOneCountry.on("click", function(){
//         var value = $(this).find("p").html()
//         console.log(value);
//     })
//     $(document).mouseup(function(e){
//         //select country
//         var inputCountry = $("#div-search")
//         if (!btnCountry.is(e.target) && btnCountry.has(e.target).length === 0) {
//                 selectCountry.hide()
//             }else{
//                 if (!inputCountry.is(e.target) && inputCountry.has(e.target).length === 0)
//                 {
//                         selectCountry.slideToggle(300,'linear');
//                         searchCountry.val("")
//                 }
//         }
//     });
// })
