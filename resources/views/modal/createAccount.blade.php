<div id="create__modal-account" class="modal">
    <div class="modal__content full_modal">
        <div class="container_modal_edit">
            <div class="close__modal close_modal_mobi content_creat-account">
            </div>
            <div class="title-modal title_mobile">
                <p>{{ __('Edit account information') }}</p>
            </div>
                <div class="modal--input">
                    <p>{{ __('Full name') }}</p>
                    <div class="input--modal">
                        <input type="text" id="name" placeholder="Enter your name" class="form-name create_name input-style-focus" name="full_name">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                    </div>
                    <p class="text-dangers text_name"></p>
                </div>
                <div class="modal--input">
                    <p>{{ __('E-mail') }}</p>
                    <div class="input--modal">
                        <input type="text" placeholder="Enter your Email" class="form-number create_email input-style-focus" name="email">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                    </div>
                    <p class="text-dangers text_email"></p>
                </div>
                <div class="modal--input">
                    <p>{{ __('Phone number') }}</p>
                    <div class="input--modal">
                        <input type="text" placeholder="Enter your Number" class="form-number create_number input-style-focus " name="phone_number">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                    </div>
                    <p class="text-dangers text_phone"></p>
                </div>
                <div class="modal--input" >
                    <p>{{ __('Password') }}</p>
                    <div class="input--modal">
                        <input type="password" placeholder="Enter your password" class="form-pwd create_pwd input-style-focus " name="password">
                        <img src="{{asset('assets/image/unseen.svg')}}" alt="" class="img-seen-pwd">
                    </div>
                    <p class="text-dangers text_password"></p>
                </div>
                <div class="modal--input" >
                    <p>{{ __('Confirm password') }}</p>
                    <div class="input--modal">
                        <input type="password" placeholder="Re-enter your password" class="form-re-pwd create_re_pwd input-style-focus " name="password_confirmation">
                        <img src="{{asset('assets/image/unseen.svg')}}" alt="" class="img-seen-pwd">
                    </div>
                    <p class="text-dangers text_re-password"></p>
                </div>
                <div class="modal--input">
                    <p>{{ __('Authority') }}</p>
                    <div class="role_edit">
                        <label class="container__checkbox authorization create_authority">{{ __('Admin') }}
                            <input type="radio" name="role" value="ADMIN">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization create_authority">{{ __('Supervisor') }}
                            <input type="radio" name="role" value="SUPERVISOR">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization create_authority">{{ __('Operator') }}
                            <input type="radio" name="role" value="OPERATOR">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <p class="text-dangers text_auth"></p>
                </div>
            </div>
            <div class="btn-modal">
                <button class="btn__cancel-button cancel_create-account btn_cancel_mobi">{{ __('Cancel') }}</button>
                <button class="btn__save-button save_account btn_edit_mobi">{{ __('Save change') }}</button>
            </div>
    </div>
    <div class="overlay"></div>
</div>
