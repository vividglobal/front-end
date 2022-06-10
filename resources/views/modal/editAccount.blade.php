<div id="modal-account" class="modal">
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
                    <input type="text" placeholder="Enter your Name" disabled class="form-name edit_name">
                    <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                </div>
            </div>
            <div class="modal--input">
                <p>Phone number</p>
                <div class="input--modal">
                    <input type="text" placeholder="Enter your Number" disabled class="form-number edit_number">
                    <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__number">
                </div>
            </div>
            <div class="modal--input">
                <p>Authority</p>
                <div style="display: flex; justify-content:space-around">
                        <label class="container__checkbox authorization edit_authority">Admin
                            <input type="radio" name="radio" id="Admin">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization edit_authority">Operator
                            <input type="radio" name="radio" id="Operator">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization edit_authority">Supervisor
                            <input type="radio" name="radio" id="Supervisor">
                            <span class="checkmark"></span>
                        </label>
                </div>
            </div>
            <p class="btn__change--password">Change Password</p>
            <div class="modal--input edit-password" style="display:none">
                <p>New password</p>
                <div class="input--modal">
                    <input type="password" placeholder="Enter your current password" class="form-pwd edit_pwd">
                    <img src="../assets/image/unseen.svg" alt="" class="img-seen-pwd">
                </div>
            </div>
            <div class="modal--input edit-password-confirm" style="display:none">
                <p>Confirm password</p>
                <div class="input--modal">
                    <input type="password" placeholder="Re-enter your password" class="form-re-pwd edit_re_pwd">
                    <img src="../assets/image/unseen.svg" alt="" class="img-re-seen-pwd">
                </div>
            </div>
            <div class="btn-modal">
                <button class="btn__cancel-button">Cancel</button>
                <button class="btn__save-button">Save change</button>
            </div>
        </div>
        <div class="overlay"></div>
</div>
