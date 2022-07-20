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
        $(".edit_password").text("")
        $(".error_number").text("")
        $(".error_name").text("")
        $(".checkbox_mobi").find("#toggle").hide()
        $(".delete__profile_modal").removeClass("open_delete_user")
        navigation.hide("#myFilter")
        overlay.hide()
        $(".input_email").hide()
        scrollScreen.enable()
    }
    let checkedAuth;
    const csrf = $('meta[name="csrf-token"]').attr('content');

      //  Btn open modal
    var documentElement = document.querySelector('.overlay');
    $("#edit__profile").on("click",function(){
        var name = $(this).find("input").attr("data-name").trim()
        var phone = $(this).find("input").attr("data-phone").trim()
        var auth = $(this).find("input").attr("data-auth").trim()
        var id = $(this).find("input").attr("data-id").trim()
        var email = $(this).find("input").attr("data-email").trim()
        $(".container_modal_edit").find(".title-modal").find("p").text("Edit your profile")
        $(".edit_account").addClass("content_edit1_account")
        $(".edit_account").removeClass("content_edit2_account")
        $(".role_modal").hide()
        checkedAuth = auth;
        ModalEditProfile(name,phone,auth,email,id)
    })

    $(".edit__profile").on("click",function(){
        var name = $(this).find("input").attr("data-name").trim()
        var phone = $(this).find("input").attr("data-phone").trim()
        var auth = $(this).find("input").attr("data-auth").trim()
        var email = $(this).find("input").attr("data-email").trim()
        var id = $(this).find("input").attr("data-id").trim()
        $(".edit_account").addClass("content_edit2_account")
        $(".edit_account").removeClass("content_edit1_account")

        $(".role_modal").show()
        $(".input_email").show()
        $(".container_modal_edit").find(".title-modal").find("p").text("Edit account information")
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
        overlay.show()
        $(`#${auth}`).attr('checked', true)
        scrollScreen.disable()

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
        $(this).closest('.input--modal').find('input').focus();
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
        overlay.hide()
        scrollScreen.enable()

    })

    $(".edit_profile").on("click",function(e){
        e.preventDefault()
        $(".edit_re_password").text("")
        $(".error_number").text("")
        $(".error_name").text("")
        $(".edit_password").text("")
        let name = $('.edit_name').val().trim();
        let number = $('input[name="edit_number"]').val().trim();
        let current_pwd = $('input[name="edit_current_pwd"]').val().trim();
        let pwd = $('input[name="edit_pwd"]').val().trim();
        let id = $('input[name="edit_id_user"]').attr("data-id");
        let email = $('.edit_email').val().trim();
        let re_pwd = $('input[name="edit_re_pwd"]').val().trim();
        var regexPhone = /^0+[0-9]{9,10}$/;
        var regexPassword = /^.{6,20}$/;
        var flag = true;

        if(name === ""){
            $(".error_name").text("Please enter your full name");
            flag = false;
        }

        if(name.length > 100){
            $(".error_name").text("Please enter your name max length of 100 characters");
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

        if(!validateEmail(email)){
            $(".text_email").text("Please enter valid email format")
            flag = false;
        }

        if(email.length > 100){
            $(".text_email").text("Please enter your email max length of 100 characters");
            flag = false;
        }

        if(pwd !== "" || re_pwd !== "" || current_pwd !== ""){
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
                $(".edit_re_password").text("Password and confirmation password does not match")
                flag = false;
            }

            if(flag){
                const url = '/admins/' + id + '/update-password';
                let csrf = $('meta[name="csrf-token"]').attr('content')
                $.ajax({
                    method: "PUT",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                    },
                    data: {
                        "password" : pwd,
                        "current_password" : current_pwd,
                    }
                    })
                    .done(function( msg ) {
                        if(msg){
                            let data = {
                                "full_name" : name,
                                "email" : email,
                                "phone_number" : number,
                                "role" : checkedAuth
                            }
                            updateProfile(data,id)
                        }
                    })
                    .fail(function(error) {
                        $(".edit_current_password").text(error.responseJSON.message)
                    });
            }
        }else{
            if(flag){
                // NO UPTATE PWD
                let data = {
                    "full_name" : name,
                    "email" : email,
                    "phone_number" : number,
                    "role" : checkedAuth
                }
                updateProfile(data,id)
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
                resetModal()
                if(msg){
                    ReturnMessage.success(msg.message);
                }
            })
            .fail(function(error) {
                let msg = error.responseJSON.message
                if(msg.toLowerCase().indexOf("email") > -1){
                    $(".text_email").text(msg)
                    hide_overlay()
                }else if(msg.toLowerCase().indexOf("phone") > -1){
                    $(".error_number").text(msg)
                    hide_overlay()
                }else{
                    ReturnMessage.error(error.responseJSON.message)
                }
            });
    }

    // Modal delete account----------------------------------------------------------------
    $(".delete__profile").on("click",function(){
        parentRow = $(this).parents('.tbody_admin');
        $("#modal__delete-account").addClass("modal__open")
        overlay.show()
        $("#modal__delete-account").find(".modal__content").find("title").find("> p").text("REMOVE ADMIN")
        let id  = $(this).closest("li").find("input").attr("data-id") || $(".edit_id_user").attr("data-id");
        $(".btn__delete--user").closest("form").find("input").attr("data-id",id);
        scrollScreen.disable()

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
                resetModal()
                hide_overlay()
                if(msg){
                    show_success(msg.message)
                }
                if($(".tbody_admin").length == 1){
                    const queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    const page = parseInt(urlParams.get("page"));
                    if(page > 1){
                        let url = window.location.href
                        let replace = url.replace(`page=${page}`,`page=${page - 1}`)
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

})

const validateEmail = (email) => {
    return String(email)
      .toLowerCase()
      .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      );
  };
