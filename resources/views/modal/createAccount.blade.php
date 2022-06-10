<div id="create__modal-account" class="modal">
        <div class="modal__content">
            <div class="close__modal">
                <img class="modal__close" src="../assets/image/x.svg" alt="">
            </div>
            <div class="title-modal">
                <p>Edit account information</p>
            </div>
            <div class="modal--input">
                <p>Full name</p>
                <div class="input--modal">
                    <input type="text" placeholder="Enter your Name" class="form-name create_name">
                    <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                </div>
            </div>
            <div class="modal--input">
                <p>Phone number</p>
                <div class="input--modal">
                    <input type="text" placeholder="Enter your Number" class="form-number create_number">
                    <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__number">
                </div>
            </div>
            <div class="modal--input " >
                <p>New password</p>
                <div class="input--modal">
                    <input type="password" placeholder="Enter your current password" class="form-pwd create_pwd">
                    <img src="../assets/image/unseen.svg" alt="" class="img-seen-pwd">
                </div>
            </div>
            <div class="modal--input " >
                <p>Confirm password</p>
                <div class="input--modal">
                    <input type="password" placeholder="Re-enter your password" class="form-re-pwd create_re_pwd">
                    <img src="../assets/image/unseen.svg" alt="" class="img-re-seen-pwd">
                </div>
            </div>
            <div class="modal--input">
                <p>Authority</p>
                <div style="display: flex; justify-content:space-around">
                        <label class="container__checkbox authorization create_authority">Admin
                            <input type="radio" name="radio" id="Admin">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization create_authority">Operator
                            <input type="radio" name="radio" id="Operator">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization create_authority">Supervisor
                            <input type="radio" name="radio" id="Supervisor">
                            <span class="checkmark"></span>
                        </label>
                </div>
            </div>
            <div class="btn-modal">
                <button class="btn__cancel-button">Cancel</button>
                <button class="btn__save-button">Save change</button>
            </div>
        </div>
        <div class="overlay"></div>
</div>
