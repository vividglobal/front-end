@auth
<div id="modal-account" class="modal">
        <div class="modal__content full_modal">
            <div class="container_modal_edit">

                <div class="close__modal close_modal_mobi edit_account ">
                </div>
                <div class="title-modal title_mobile">
                    <p>{{ __('Edit account information') }}</p>
                </div>
                    <input type="hidden" class="edit_id_user" name="edit_id_user">
                <div class="modal--input ">
                    <p>{{ __('Full name') }}</p>
                    <div class="input--modal">
                        <input type="text" placeholder="Enter your name" class="form-name edit_name input-style-focus" name="edit_name">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                    </div>
                    <p class="text-dangers error_name"></p>
                </div>
                <div class="modal--input input_email" style="display:none">
                    <p>{{ __('E-mail') }}</p>
                    <div class="input--modal">
                        <input type="text" placeholder="Enter your Email" class="form-number edit_email  input-style-focus" name="email">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                    </div>
                    <p class="text-dangers text_email"></p>
                </div>
                <div class="modal--input">
                    <p>{{ __('Phone number') }}</p>
                    <div class="input--modal">
                        <input type="text" placeholder="Enter your Number" class="form-number edit_number input-style-focus"  name="edit_number">
                        <img src="{{ asset('assets/image/edit.svg') }}" alt="" class="img-edit__name">
                    </div>
                    <p class="text-dangers error_number"></p>
                </div>
                @if(@Auth::user()->role === "ADMIN")
                <div class="modal--input role_modal ">
                    <p>{{ __('Authority') }}</p>
                    <div  class="role_edit">
                        <label class="container__checkbox authorization edit_authority">{{ __('Admin') }}
                            <input type="radio" name="role" value="ADMIN" id="ADMIN">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization edit_authority">{{ __('Supervisor') }}
                            <input type="radio" name="role" value="SUPERVISOR" id="SUPERVISOR">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container__checkbox authorization edit_authority">{{ __('Operator') }}
                            <input type="radio" name="role" value="OPERATOR" id="OPERATOR">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <p class="text-dangers text_auth"></p>
                </div>
                @endif
                <p class="btn__change--password">{{ __('Change Password') }}</p>
                <div class="modal--input current-password" style="display:none">
                    <p>{{ __('Current password') }}</p>
                    <div class="input--modal">
                        <input type="password" placeholder="Enter your current password" class="form-pwd edit_pwd input-style-focus" name="edit_current_pwd">
                        <img src="{{asset('assets/image/unseen.svg')}}" alt="" class="img-seen-pwd">
                    </div>
                    <p class="text-dangers edit_current_password "></p>
                </div>
                <div class="modal--input edit-password" style="display:none">
                    <p>{{ __('New password') }}</p>
                    <div class="input--modal">
                        <input type="password" placeholder="Enter your new password" class="form-pwd edit_pwd input-style-focus" name="edit_pwd">
                        <img src="{{asset('assets/image/unseen.svg')}}" alt="" class="img-seen-pwd">
                    </div>
                    <p class="text-dangers edit_password"></p>
                </div>
                <div class="modal--input edit-password-confirm" style="display:none">
                    <p>{{ __('Confirm password') }}</p>
                    <div class="input--modal">
                        <input type="password" placeholder="Re-enter your password" class="form-re-pwd edit_re_pwd input-style-focus" name="edit_re_pwd">
                        <img src="{{asset('assets/image/unseen.svg')}}" alt="" class="img-seen-pwd">
                    </div>
                    <p class="text-dangers edit_re_password "></p>
                </div>
                <p class="delete__profile_modal delete__profile">Remove this user</p>
            </div>
            <div class="btn-modal no-margin">
                <button class="btn__cancel-button btn_cancel_mobi cancel_create-account">{{ __('Cancel') }}</button>
                <button class="edit_profile btn_edit_mobi">{{ __('Save change') }}</button>
            </div>
        </div>
        <div class="overlay"></div>
</div>
@endauth
