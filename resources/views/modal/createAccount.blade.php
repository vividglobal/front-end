<div id="create__modal-account" class="modal">
    <div class="modal__content full_modal">
        <div class="container_modal_edit">
            <div class="close__modal close_modal_mobi">
            </div>
            <div class="title-modal title_mobile">
                <p>{{ __('Edit account information') }}</p>
            </div>
                <div class="modal--input">
                    <p>{{ __('Full name') }}</p>
                    <div class="input--modal">
                        <input type="text" id="name" placeholder="Enter your Name" class="form-name create_name" name="full_name">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                    </div>
                </div>
                <p class="text-dangers text_name"></p>
                <div class="modal--input">
                    <p>{{ __('E-mail') }}</p>
                    <div class="input--modal">
                        <input type="text" placeholder="Enter your Email" class="form-number create_email  " name="email">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__email">
                    </div>
                </div>
                <p class="text-dangers text_email"></p>
                <div class="modal--input">
                    <p>{{ __('Phone number') }}</p>
                    <div class="input--modal">
                        <input type="text" placeholder="Enter your Number" class="form-number create_number  " name="phone_number">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__number">
                    </div>
                </div>
                <p class="text-dangers text_phone"></p>
                <div class="modal--input " >
                    <p>{{ __('New password') }}</p>
                    <div class="input--modal">
                        <input type="password" placeholder="Enter your current password" class="form-pwd create_pwd  " name="password">
                        <img src="{{asset('assets/image/unseen.svg')}}" alt="" class="img-seen-pwd">
                    </div>
                </div>
                <p class="text-dangers text_password"></p>
                <div class="modal--input " >
                    <p>{{ __('Confirm password') }}</p>
                    <div class="input--modal">
                        <input type="password" placeholder="Re-enter your password" class="form-re-pwd create_re_pwd  " name="password_confirmation">
                        <img src="{{asset('assets/image/unseen.svg')}}" alt="" class="img-re-seen-pwd">
                    </div>
                </div>
                <p class="text-dangers text_re-password"></p>
                <div class="modal--input">
                    <p>{{ __('Authority') }}</p>
                    <div style="display: flex; justify-content:space-around">
                        <label class="container__checkbox authorization create_authority">{{ __('Admin') }}
                            <input type="radio" name="role" value="ADMIN">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization create_authority">{{ __('Operator') }}
                            <input type="radio" name="role" value="OPERATOR">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization create_authority">{{ __('Supervisor') }}
                            <input type="radio" name="role" value="SUPERVISOR">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <p class="text-dangers text_auth"></p>
            </div>
            <div class="btn-modal">
                <button class="btn__cancel-button cancel_create-account btn_cancel_mobi">{{ __('Cancel') }}</button>
                <button class="btn__save-button save_account btn_edit_mobi">{{ __('Save change') }}</button>
            </div>
    </div>
    <div class="overlay"></div>
</div>
