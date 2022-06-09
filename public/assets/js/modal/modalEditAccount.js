$("document").ready(function(){
    function resetModal(){
        $("#modal-account").removeClass("modal__open")
        $(".btn__change--password").show();
        $(".edit-password").hide();
        $(".edit-password-confirm").hide();
    }

      //  Btn open modal

    $("#edit__profile").on("click",function(){
        $("#modal-account").addClass("modal__open")
    })

    $(".modal__close").on("click",function(){
        resetModal()
    })

    $(".overlay").on("click",function(){
        resetModal()
    })
        // btn input popup
        //name
    $(".img-edit__name").on("click",function(){
        $(".form-name").removeAttr('disabled');
        $(".form-name").focus();
    })
    //number
    $(".img-edit__number").on("click",function(){
            $(".form-number").removeAttr('disabled');
            $(".form-number").focus();
    })

    $(".btn__change--password").on("click",function(){
        $(".edit-password").show();
        $(".edit-password-confirm").show();
        $(".btn__change--password").hide();
    })
     //modal checbox
     $(".authorization").on("click",function(){
        // console.log($(this).find("input").attr("id"))
    })
    //pwd
    $(".img-seen-pwd").on("click",function(){
        if($(".form-pwd").attr("type") === "text"){
            $(".form-pwd").attr("type","password")
            $(".img-seen-pwd").attr("src","./image/unseen.svg")
        }else{
            $(".form-pwd").attr("type","text")
            $(".img-seen-pwd").attr("src","./image/seen.svg")
        }
    })
      //re-pwd
    $(".img-re-seen-pwd").on("click",function(){
        if($(".form-re-pwd").attr("type") === "text"){
            $(".form-re-pwd").attr("type","password")
            $(".img-re-seen-pwd").attr("src","./image/unseen.svg")
        }else{
            $(".form-re-pwd").attr("type","text")
            $(".img-re-seen-pwd").attr("src","./image/seen.svg")
        }
    })

    $(".btn__cancel-button").on("click",function(){
        resetModal()
    })

    $(".btn__save-button").on("click",function(){
        resetModal()
    })
})
