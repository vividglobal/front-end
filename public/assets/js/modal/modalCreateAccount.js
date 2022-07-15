$("document").ready(function(){
    function resetModal(){
        $(".modal").removeClass("modal__open")
        $(".create_name").val("");
        $(".create_email").val("");
        $(".create_number").val("");
        $(".create_pwd").val("");
        $(".create_re_pwd").val("");
        $(".text_name").text("")
        $(".text_email").text("")
        $(".text_phone").text("")
        $(".text_password").text("")
        $(".text_re-password").text("")
        $(".text_auth").text("")
        $(".text-dangers").text("")
    }
    let checkedAuth;

    $(`input[name="role"]`).on("change",function(){
        $(`input[name="role"]`).removeAttr('checked')
        $(this).attr('checked', true);
        checkedAuth = $(this).attr("value")
    })

    //   //  Btn open modal
    $(".create__profile").on("click",function(){
        $("#create__modal-account").find(".modal__content").find(".container_modal_edit").find(".title-modal").find("p").text("Add admins")
        $("#create__modal-account").addClass("modal__open")
        $(".overlay").css({"width":"100%", "display": "block"})
        scrollScreen.disable()
    })


    $(".cancel_create-account").on("click",function(){
        resetModal()
    })

    $(".close__modal").click(function(){
        resetModal()
    })

    $(".overlay").click(function(){
        resetModal()
    })

    $(".save_account").on("click",function(){
        let name  = $(".create_name").val().trim();
        let email  = $(".create_email").val().trim();
        let phone  = $(".create_number").val().trim();
        let pwd  = $(".create_pwd").val().trim();
        let re_pwd  = $(".create_re_pwd").val().trim();
        $(".text_name").text("")
        $(".text_email").text("")
        $(".text_phone").text("")
        $(".text_password").text("")
        $(".text_re-password").text("")
        $(".text_auth").text("")
        var flag = true;
        let csrf = $('meta[name="csrf-token"]').attr('content')
        var testphone = /^0+[0-9]{9,10}$/;
        var regexPassword = /^.{6,20}$/;

        if(name === ""){
            $(".text_name").text("Please enter your full name");
            flag = false;
        }

        if(name.length > 100){
            $(".text_name").text("Please enter your name max length of 100 characters");
            flag = false;
        }

        if(email === ""){
            $(".text_email").text("Please enter your email")
            flag = false;
        }

        if(email.length > 100){
            $(".text_email").text("Please enter your email max length of 100 characters");
            flag = false;
        }

        if(!validateEmail(email)){
            $(".text_email").text("Please enter valid email format")
            flag = false;
        }

        if(phone === ""){
            $(".text_phone").text("Please enter phone number")
            flag = false;

        }else if(phone.match(testphone) == null){
            $(".text_phone").text("Please enter the valid phone number format")
            flag = false;
        }

        if(!pwd.match(regexPassword)){
            $(".text_password").text("Please enter password from 6 - 20 characters")
            flag = false;
        }

        if(!re_pwd.match(regexPassword)){
            $(".text_re-password").text("Please enter re-password from 6 - 20 characters")
            flag = false;
        }

        if(pwd.match(regexPassword) && re_pwd.match(regexPassword) && pwd !== re_pwd){
            $(".text_re-password").text("Password and confirmation password does not match. Please re-enter in \" Confirm password \"")
            flag = false;
        }

        if(checkedAuth === undefined){
            $(".text_auth").text("Authority is required")
            flag = false;
        }

        if(flag){
            show_overlay()
            const url = '/admins';

            $.ajax({
                method: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
                data:{
                    "full_name" : name,
                    "password" : pwd,
                    "email" : email,
                    "phone_number" : phone,
                    "role" : checkedAuth
                }
            })
            .done(function( msg ) {
                ReturnMessage.success(msg.message)
                resetModal()
            })
            .fail(function( error ) {
                if(error){
                    ReturnMessage.error(error.responseJSON.message)
                }
            });
        }
    })

})


