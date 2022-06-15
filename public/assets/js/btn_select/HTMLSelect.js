$("document").ready(function(){
       // brand&company
       var select = $(".select--company-or-brand").find(".contain--selection")
       let Brand = ["- select Brand -","nestle","company"];

       Brand.map(item=>{
           var html = `<div class="select__one">
                           <p>${jsUcfirst(item)}</p>
                           <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
                       </div>`
           select.append(html)
       })
       // violation type
       var select = $(".select--violation--type")
       let violation = ["- select Brand -","nestle","Dutch Lady"];
       violation.map(item=>{
           var html = `<div class="select__one--violation--type">
                           <p>${jsUcfirst(item)}</p>
                           <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
                       </div>`
           select.append(html)
       })

       //country
       var select = $(".select--country").find(".contain--selection")
       let country = ["- select country -","england","albania"];
       country.map(item=>{
           var html = `<div class="select__one--country">
                           <p>${jsUcfirst(item)}</p>
                           <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
                       </div>`
           select.append(html)
       })

       function jsUcfirst(string)
         {
            let index = string.replace(/-/g, ' ').trim()
            if(string.indexOf("-") !== -1){
                 return "-" +index.charAt(0).toUpperCase() + index.slice(1) + "-";
            }else{
                 return index.charAt(0).toUpperCase() + index.slice(1);
            }
         }
         //btn showing
        let btnShowing = $(".list--showing").find("select")
        var showing = [10,25,50,100]
        showing.map(item=>{
            var html = `<option value="${item}">${item}</option>`
            btnShowing.append(html)
        })

})
