$(document).ready(function(){
    //validate-country
  var selectVCountry = $("#validate-select-country");
  var selectOneVCountry = $(".validate-option-country");
  var btnVCountry = $("#validate-country");
  var searchCountry = $("#validate-search-country");

selectOneVCountry.on("click", function(){
  var value = $(this).find("p").html()
  if(value.indexOf("-") === -1){
      btnVCountry.find("> p").html(value)
  }
  selectOneVCountry.removeClass("background-gray")
  selectOneVCountry.find("img").hide()
  $(this).addClass("background-gray")
  $(this).find("img").show()
})
// ----------------------------------------------------------------

$(document).mouseup(function(e){
//select validate country
var inputCountry = $("#div-validate-search-country")
if (!btnVCountry.is(e.target) && btnVCountry.has(e.target).length === 0) {
      selectVCountry.hide()
  }else{
      if (!inputCountry.is(e.target) && inputCountry.has(e.target).length === 0)
      {
          selectVCountry.slideToggle(300,'linear');
          selectVCountry.val("")
      }
}
});
})
