$("document").ready(function(){
    function resetModal(){
        $(".modal").removeClass("modal__open")
        $(".btn__change--password").show();
        $(".edit-password").hide();
        $(".edit-password-confirm").hide();
        $(".form-pwd").val("");
        $(".form-re-pwd").val("");
        $(".form-re-pwd").attr("type","password")
        $(".img-re-seen-pwd").attr("src","../assets/image/unseen.svg")
        $(".form-pwd").attr("type","password")
        $(".img-seen-pwd").attr("src","../assets/image/unseen.svg")
        $('input[name="edit_name"]').val("")
        $('input[name="edit_number"]').val("")
        $(`input[name="role"]`).removeAttr('checked')
        $(`input[name="edit_id_user"]`).removeAttr('data-id')
        $(`input[name="edit_id_user"]`).removeAttr('data-email')
        $(".edit_re_password").text("")
        $(".error_number").text("")
        $(".error_name").text("")
        $(".edit_password").text("")
        $("#myFilter").removeClass("open_menu")
        $(".checkbox_mobi").find("#toggle").hide()
        $(".delete__profile_modal").removeClass("open_delete_user")
        $(".overlay").css({"width":"0%","display":"none"})
        document.documentElement.style.overflow = 'scroll';
        document.body.scroll = "yes";
    }
    let checkedAuth;

      //  Btn open modal
    var documentElement = document.querySelector('.overlay');
    $("#edit__profile").on("click",function(){
        var name = $(this).find("input").attr("data-name")
        var phone = $(this).find("input").attr("data-phone")
        var auth = $(this).find("input").attr("data-auth")
        var id = $(this).find("input").attr("data-id")
        var email = $(this).find("input").attr("data-email")
        $(".title-modal").find("p").text("Edit your profile")
        checkedAuth = auth;
        ModalEditProfile(name,phone,auth,email,id)
    })

    $(".edit__profile").on("click",function(){
        var name = $(this).find("input").attr("data-name")
        var phone = $(this).find("input").attr("data-phone")
        var auth = $(this).find("input").attr("data-auth")
        var email = $(this).find("input").attr("data-email")
        var id = $(this).find("input").attr("data-id")
        $(".title-modal").find("p").text("Edit account information")
        $(".delete__profile_modal").addClass("open_delete_user")
        checkedAuth = auth;

        $(".btn__change--password").hide()
        ModalEditProfile(name,phone,auth,email,id)
    })

    function ModalEditProfile(name,phone,auth,email,id){
        $("#modal-account").addClass("modal__open")
        $('input[name="edit_name"]').val(name)
        $('input[name="edit_number"]').val(phone)
        $('input[name="edit_id_user"]').attr("data-id",id)
        $('input[name="edit_id_user"]').attr("data-email",email)
        $(".overlay").css({"width":"100%","display":"block"})
        $(`#${auth}`).attr('checked', true)
        document.documentElement.style.overflow = 'hidden';
        document.body.scroll = "unset";
    }

    //value modal edit profile

    $(".close__modal").on("click",function(){
        resetModal()
    })

    $(".overlay").on("click",function(){
        resetModal()
    })
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

    //checked Radio Button
    $(`input[name="role"]`).on("change",function(){
        $(`input[name="role"]`).removeAttr('checked')
        $(this).attr('checked', true);
        checkedAuth = $(this).attr("id")
    })

    $(".btn__change--password").on("click",function(){
        $(".edit-password").show();
        $(".edit-password-confirm").show();
        $(".current-password").show();
        $(".btn__change--password").hide();
    })

    $(".form-pwd").keyup(function(){
        $(".text-dangers").text("")
    })

    //pwd-show
    $(".img-seen-pwd").on("click",function(){
        let getType = $(this).closest(".input--modal").find("input").attr("type");
        if(getType == "text"){
            $(this).closest(".input--modal").find("input").attr("type","password");
            $(this).closest(".input--modal").find("img").attr("src","../assets/image/unseen.svg")
        }else{
            $(this).closest(".input--modal").find("input").attr("type","text");
            $(this).closest(".input--modal").find("img").attr("src","../assets/image/seen.svg")
        }
    })

    $(".btn__cancel-button").on("click",function(){
        resetModal()
    })

    $(".edit_profile").on("click",function(e){
        e.preventDefault()
        $(".edit_re_password").text("")
        $(".error_number").text("")
        $(".error_name").text("")
        $(".edit_password").text("")
        let name = $('.edit_name').val();
        let number = $('input[name="edit_number"]').val();
        let current_pwd = $('input[name="edit_current_pwd"]').val();
        let pwd = $('input[name="edit_pwd"]').val();
        let id = $('input[name="edit_id_user"]').attr("data-id");
        let email = $('input[name="edit_id_user"]').attr("data-email");
        let re_pwd = $('input[name="edit_re_pwd"]').val();
        const regexPhone = /(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/;
        let csrf = $('meta[name="csrf-token"]').attr('content')
        const url = '/admins/' + id;
        if(name !== "" && number !== "" && checkedAuth !== undefined){
            if(pwd === "" && re_pwd === "" && current_pwd === ""){
                // NO UPTATE PWD
                if(number.match(regexPhone)){
                    show_overlay()
                    $.ajax({
                        method: "PUT",
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                        },
                        data:{
                            "full_name" : name,
                            "email" : email,
                            "phone_number" : number,
                            "role" : checkedAuth
                        }
                    })
                    .done(function( msg ) {
                        if(msg){
                            if(msg){
                                hide_overlay()
                                show_success("Profile updated successfully")
                                window.location.href = window.location.href
                                resetModal()
                            }
                        }
                    })
                    .fail(function(error) {
                        $(".edit_current_password").text("Profile updated failed")
                        hide_overlay()
                    });
                    resetModal()
                }else{
                    $(".error_number").text("Invalid phone number")
                }
            }else{
                if(pwd.length  < 6 || re_pwd.length  < 6 || current_pwd.length < 6 ){
                    $(".edit_re_password").text("Password length is more than 6 characters and is required")
                }else{
                    if(pwd == re_pwd){
                    show_overlay()
                    $.ajax({
                        method: "PUT",
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                        },
                        data:{
                            "full_name" : name,
                            "email" : email,
                            "phone_number" : number,
                            "password" : pwd,
                            "password_current" : current_pwd,
                            "role" : checkedAuth
                        }
                        })
                        .done(function( msg ) {
                            show_success("Profile updated successfully")
                            hide_overlay()
                            window.location.href = window.location.href
                            resetModal()
                        })
                        .fail(function(error) {
                            $(".edit_current_password").text(error.responseJSON.message)
                            hide_overlay()
                        });
                    }else{
                        $(".edit_re_password").text("Password and confirmation password does not match. Please re-enter")
                    }
                }
            }
        }

        if(name === ""){
            $(".error_name").text("Name is required")
        }
        if(number === ""){
            $(".error_number").text("Phone number is required")
        }
    })
    // Modal delete account----------------------------------------------------------------
    $(".delete__profile").on("click",function(){
        $("#modal__delete-account").addClass("modal__open")
        $(".overlay").css({"width": "100%", "display": "block"})
    })

    $(".btn__delete--user").on("click",function(){
        show_overlay()
        resetModal()
        setTimeout(()=>{
            hide_overlay()
        },1500)
    })
})
