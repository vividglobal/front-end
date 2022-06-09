<div id="modal-account" class="modal">
        <div class="modal__content">
            <div class="close__modal">
                <a href="#" class="modal__close">&times;</a>
            </div>
            <div class="title-modal">
                <p>Edit account information</p>
            </div>
            <div class="modal--input">
                <p>Full name</p>
                <div class="input--modal">
                    <input type="text" placeholder="Enter your Name" disabled class="form-name">
                    <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                </div>
            </div>
            <div class="modal--input">
                <p>Phone number</p>
                <div class="input--modal">
                    <input type="text" placeholder="Enter your Number" disabled class="form-number">
                    <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__number">
                </div>
            </div>
            <div class="modal--input">
                <p>Authority</p>
                <div style="display: flex; justify-content:space-around">
                        <label class="container__checkbox authorization">Admin
                            <input type="radio" name="radio" id="Admin">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization">Operator
                            <input type="radio" name="radio" id="Operator">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization">Supervisor
                            <input type="radio" name="radio" id="Supervisor">
                            <span class="checkmark"></span>
                        </label>
                </div>
            </div>
            <p class="btn__change--password">Change Password</p>
            <div class="modal--input edit-password" style="display:none">
                <p>New password</p>
                <div class="input--modal">
                    <input type="password" placeholder="Enter your current password" class="form-pwd">
                    <img src="{{ asset('assets/image/unseen.svg') }}" alt="" class="img-seen-pwd">
                </div>
            </div>
            <div class="modal--input edit-password-confirm" style="display:none">
                <p>Confirm password</p>
                <div class="input--modal">
                    <input type="password" placeholder="Re-enter your password" class="form-re-pwd">
                    <img src="{{ asset('assets/image/unseen.svg') }}" alt="" class="img-re-seen-pwd">
                </div>
            </div>
            <div class="btn-modal">
                <button class="btn__cancel-button">Cancel</button>
                <button class="btn__save-button">Save change</button>
            </div>
        </div>
        <div class="overlay"></div>
</div>
