$("document").ready(function(){
    function resetModal(){
        $(".modal").removeClass("modal__open")
        $(".create_name").val("");
        $(".create_email").val("");
        $(".create_number").val("");
        $(".create_pwd").val("");
        $(".create_re_pwd").val("");
        $(`input[name="role"]`).removeAttr('checked')
        $(".text_name").text("")
        $(".text_email").text("")
        $(".text_phone").text("")
        $(".text_password").text("")
        $(".text_re-password").text("")
        $(".text_auth").text("")
    }
    let checkedAuth;

    $(`input[name="role"]`).on("change",function(){
        $(`input[name="role"]`).removeAttr('checked')
        $(this).attr('checked', true);
        checkedAuth = $(this).attr("value")
    })

    //   //  Btn open modal
    $(".create__profile").on("click",function(){
        $(".title-modal").find("p").text("Add admins")
        $("#create__modal-account").addClass("modal__open")
        $(".overlay").css({"width":"100%", "display": "block"})
    })


    $(".cancel_create-account").on("click",function(){
        resetModal()
    })

    $(".save_account").on("click",function(){
        let name  = $(".create_name").val();
        let email  = $(".create_email").val();
        let phone  = $(".create_number").val();
        let pwd  = $(".create_pwd").val();
        let re_pwd  = $(".create_re_pwd").val();
        $(".text_name").text("")
        $(".text_email").text("")
        $(".text_phone").text("")
        $(".text_password").text("")
        $(".text_re-password").text("")
        $(".text_auth").text("")
        var flag = true;
        let csrf = $('meta[name="csrf-token"]').attr('content')
        const regexPhone = /(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/;
        const regexEmail = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

        if(name === ""){
            $(".text_name").text("Name is required")
            flag = false;
        }

        if(email === ""){
            $(".text_email").text("Email is required")
            flag = false;

        }else{
            if(regexEmail.test(email) == false){
                $(".text_email").text("Email does not match")
            flag = false;

            }
        }
        if(phone === ""){
            $(".text_phone").text("Phone Number is required")
            flag = false;

        }else{
            if(!phone.match(regexPhone)){
                $(".text_phone").text("Phone Number does not match")
            flag = false;

            }
        }
        if(pwd === ""){
            $(".text_password").text("Password is required")
            flag = false;

        }
        if(re_pwd === ""){
            $(".text_re-password").text("Password reconfirmed is required")
            flag = false;

        }
        if(pwd !== re_pwd){
            $(".text_re-password").text("Confirmed password does not match")
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
                if(msg){
                    hide_overlay()
                    show_success("Create account successfully")
                    resetModal()
                }
            })
            .fail(function( error ) {
                if(error){
                    show_error("Create account failed")
                    hide_overlay()
                    resetModal()
                }
            });
        }
    })

})
