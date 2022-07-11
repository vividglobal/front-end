$("document").ready(function(){
    function resetModal(){
        $(".modal").removeClass("modal__open")
        $(".btn__change--password").show();
        $(".edit-password").hide();
        $(".current-password").hide();
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
        $("checkmark").after()
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
        $(".input_email").hide()
        document.documentElement.style.overflow = 'unset';
        document.body.scroll = "yes";
    }
    let checkedAuth;
    const csrf = $('meta[name="csrf-token"]').attr('content');

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
        $(".input_email").show()
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
        $('input[name="email"]').val(email)
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

    $(".input--modal").find("input").keyup(function(){
        $(this).closest(".input--modal").closest(".modal--input").find(".text-dangers").text("")
    })

    $(".container__checkbox").find("input").on("change",function(){
        $(this).closest(".container__checkbox").closest("div").closest(".modal--input").find(".text-dangers").text("")
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

    $(".cancel_create-account").on("click",function(){
        resetModal()
    })

    $(".cancel_delete_user").on("click",function(){
        $("#modal__delete-account").removeClass("modal__open")
        $(".overlay").css({"width":"0%","display":"none"})
        document.documentElement.style.overflow = 'unset';
        document.body.scroll = "yes";
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
        let email = $('.edit_email').val();
        let re_pwd = $('input[name="edit_re_pwd"]').val();
        var regexPhone = /^0+[0-9]{9,10}$/;
        var regexPassword = /^.{6,20}$/;
        const regexEmail = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        var flag = true;

        if(name === ""){
            $(".error_name").text("Please enter your full name");
            flag = false;
        }

        if(number === ""){
            $(".error_number").text("Please enter phone number")
            flag = false;
        }

        if(number.match(regexPhone) == null){
            $(".error_number").text("Please enter the valid phone number format")
            flag = false;
        }

        if(!regexEmail.test(email)){
            $(".text_email").text("Email does not match")
            flag = false;
        }

        if(flag){
            if(pwd === "" && re_pwd === "" && current_pwd === ""){
                // NO UPTATE PWD
                let data = {
                    "full_name" : name,
                    "email" : email,
                    "phone_number" : number,
                    "role" : checkedAuth
                }
                updateProfile(data,id)

            }else{
                if(!pwd.match(regexPassword)){
                    $(".edit_password").text("Please enter password from 6 - 20 characters")
                    flag = false;
                }
                if(!re_pwd.match(regexPassword)){
                    $(".edit_re_password").text("Please enter re-password from 6 - 20 characters")
                    flag = false;
                }
                if(!current_pwd.match(regexPassword)){
                    $(".edit_current_password").text("Please enter current password from 6 - 20 characters")
                    flag = false;
                }

                if(pwd !== re_pwd){
                    $(".edit_password").text("Password and confirmation password does not match. Please re-enter")
                    flag = false;
                }
                if(flag){
                    let data = {
                        "full_name" : name,
                        "email" : email,
                        "phone_number" : number,
                        "password" : pwd,
                        "password_current" : current_pwd,
                        "role" : checkedAuth
                    }
                    updateProfile(data,id)
                }
            }
        }
    })

    function updateProfile(data,id){
        show_overlay()
        const url = '/admins/' + id;
        let csrf = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            method: "PUT",
            url: url,
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            data: data
            })
            .done(function( msg ) {
                ReturnMessage.success("Profile updated successfully")
            })
            .fail(function(error) {
                $(".edit_current_password").text(error.responseJSON.message)
                hide_overlay()
            });
    }

    // Modal delete account----------------------------------------------------------------
    $(".delete__profile").on("click",function(){
        parentRow = $(this).parents('.tbody_admin');
        $("#modal__delete-account").addClass("modal__open")
        $(".overlay").css({"width": "100%", "display": "block"})
        $("#modal__delete-account").find(".modal__content").find("title").find("> p").text("Remove user")
        let id  = $(this).closest("li").find("input").attr("data-id");
        $(".btn__delete--user").closest("form").find("input").attr("data-id",id);
        document.documentElement.style.overflow = 'hidden';
        document.body.scroll = "unset";
    })

    $(".btn__delete--user").on("click",function(e){
        e.preventDefault()
        let id = $(this).closest("form").find("input").attr("data-id")
        show_overlay()
        const url = '/admins/' + id;
        let csrf = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            method: "DELETE",
            url: url,
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            })
            .done(function( msg ) {
                show_success(msg.message)
                hide_overlay()
                resetModal()
                if($(".tbody_admin").length == 1){
                    const queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    const page = parseInt(urlParams.get("page"));
                    if(page > 1){
                        let url = window.location.href
                        let replace = url.replace(`&page=${page}`,`&page=${page - 1}`)
                        window.location.href = replace
                    }
                }else{
                    window.location.href = window.location.href
                }
            })
            .fail(function(error) {
                ReturnMessage.error(error.responseJSON.message)
            })
    })

    const ReturnMessage  = {
        success:(message)=>{
            show_success(message)
            hide_overlay()
            window.location.href = window.location.href
            resetModal()
        },
        error: (message)=>{
            show_error(message)
            hide_overlay()
            window.location.href = window.location.href
            resetModal()
        }
    }
})
