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
    }
    let checkedAuth;

      //  Btn open modal
    $("#edit__profile").on("click",function(){
        $("#modal-account").addClass("modal__open")
        var name = $(this).find("input").attr("data-name")
        var phone = $(this).find("input").attr("data-phone")
        var auth = $(this).find("input").attr("data-auth")
        var id = $(this).find("input").attr("data-id")
        var email = $(this).find("input").attr("data-email")
        checkedAuth = auth;
        $('input[name="edit_name"]').val(name)
        $('input[name="edit_number"]').val(phone)
        $('input[name="edit_id_user"]').attr("data-id",id)
        $('input[name="edit_id_user"]').attr("data-email",email)
        $(`#${auth}`).attr('checked', true)
    })

    $(".edit__profile").on("click",function(){
        $("#modal-account").addClass("modal__open")
        var name = $(this).find("input").attr("data-name")
        var phone = $(this).find("input").attr("data-phone")
        var auth = $(this).find("input").attr("data-auth")
        var email = $(this).find("input").attr("data-email")
        var id = $(this).find("input").attr("data-id")
        checkedAuth = auth;
        $(".btn__change--password").hide()
        $('input[name="edit_name"]').val(name)
        $('input[name="edit_number"]').val(phone)
        $('input[name="edit_id_user"]').attr("data-id",id)
        $('input[name="edit_id_user"]').attr("data-email",email)
        $(`#${auth}`).attr('checked', true)
    })

    //value modal edit profile

    $(".modal__close").on("click",function(){
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
        $(".btn__change--password").hide();
    })

    //pwd
    $(".img-seen-pwd").on("click",function(){
        if($(".form-pwd").attr("type") === "text"){
            $(".form-pwd").attr("type","password")
            $(".img-seen-pwd").attr("src","../assets/image/unseen.svg")
        }else{
            $(".img-seen-pwd").attr("src","../assets/image/seen.svg")
            $(".form-pwd").attr("type","text")
        }

    })
      //re-pwd
    $(".img-re-seen-pwd").on("click",function(){
        if($(".form-re-pwd").attr("type") === "text"){
            $(".form-re-pwd").attr("type","password")
            $(".img-re-seen-pwd").attr("src","../assets/image/unseen.svg")
        }else{
            $(".form-re-pwd").attr("type","text")
            $(".img-re-seen-pwd").attr("src","../assets/image/seen.svg")
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
        let pwd = $('input[name="edit_pwd"]').val();
        let id = $('input[name="edit_id_user"]').attr("data-id");
        let email = $('input[name="edit_id_user"]').attr("data-email");
        let re_pwd = $('input[name="edit_re_pwd"]').val();
        const regexPhone = /(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/;
        let csrf = $('meta[name="csrf-token"]').attr('content')
        const url = '/admins/' + id;
        if(name !== "" && number !== "" && checkedAuth !== undefined){
            if(pwd === "" && re_pwd === ""){
                if(number.match(regexPhone)){
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
                        window.location.href = window.location.href
                    });
                    resetModal()
                }else{
                    $(".error_number").text("Invalid phone number")
                }
            }else{
                if(pwd.length  < 6){
                    $(".edit_password").text("Password length is more than 6 characters")
                }
                if(pwd === re_pwd && pwd.length > 6){
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
                            "role" : checkedAuth
                        }
                    })
                    .done(function( msg ) {
                        window.location.href = window.location.href
                    });
                    resetModal()
                }else{
                    $(".edit_re_password").text("Confirmed password does not match")
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
    })

    $(".btn__delete--user").on("click",function(){
        resetModal()
    })
})
