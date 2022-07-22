<script src="{{ asset('assets/js/header/dropDown_header.js') }}"></script>
<script src="{{ asset('assets/js/modal/modalEditAccount.js') }}"></script>
@stack('styles')

{{-- @if((!request () -> is ('articles/'. request()->id .'/details')) && (!request () -> is ('articles/'. request()->id .'/violation')) && (!request () -> is ('articles/'. request()->id .'/non-violation'))) --}}
<div class="nav_container
 {{(request ()-> is ('login')) || strpos($_SERVER['REQUEST_URI'],"password/reset") == 1 ? 'active_header_login': ''}} {{Auth::user()!== null ? "padding_has_login"  : "padding_no_login"}}
 {{(!request () -> is ('login')) && !strpos($_SERVER['REQUEST_URI'],"password/reset") == 1 && !request () -> is ('/') ? 'active_bg_header' : ''}}
  ">
    <div id="myNav" class="overlay_header">
        <a href="javascript:void(0)" class="closebtn" ><img src="{{ asset('assets/image/cancel.svg') }}" alt=""></a>
        <div class="overlay-content">
            <div class="rows nav-menu" >
                <div class="no-padding {{Auth::user()!== null ? " had_login"  : " no_login"}}" >
                    <ul class="rows no-gutters l-o-2 btn__header center-header">
                        @auth
                        <li class="nav--btn__after--login name_user" >
                            <p class="" >{{ __(Auth::user()->role) }}</p>
                            <p class="" >{{ __(Auth::user()->full_name) }}</p>
                        </li>
                        @endauth
                        <li class="nav--btn__after--login " >
                            <a class="nav-link" href="/">{{ __('Home') }}</a>
                            <div class="nav--btnBorder__bottom {{(request () -> is ('/')) ? 'activeHeader': ''}}">
                            </div>
                        </li>
                        <li class="nav--btn__after--login">
                            <a class="nav-link" href="/articles/auto-detection">{{ __('Auto-detect violations') }}</a>
                            <div class="nav--btnBorder__bottom {{(request () -> is ('articles/auto-detection')) ? 'activeHeader': ''}}">
                            </div>
                        </li>
                        <li class="nav--btn__after--login violation_review">
                            <div class="name_trace--violation">
                                {{ __('Violation reviewed') }}
                            </div>
                            <div class="nav--btnBorder__bottom
                            {{(request () -> is ('articles/violation')) || request () -> is ("articles/non-violation") ? 'activeHeader': ''}}"
                            >
                            </div>
                            <ul class="nav--dropdown {{Auth::user() == null ? "style_dropdown" : ""}}">
                                <li  class="{{(request () -> is ('articles/violation')) ? 'activeBackground': ''}}">
                                    <div class="drop_nav_violation">
                                        <a class="dropdown-item"href="/articles/violation">
                                            {{ __('Code violations') }}
                                        </a>
                                        <div class="nav--btnBorder__bottom dropdown_mbl-display
                                        {{(request () -> is ('articles/violation')) ? 'activeHeader': ''}}"
                                        >
                                        </div>
                                    </div>
                                </li>
                                <li class="{{(request () -> is ('articles/non-violation')) ? 'activeBackground': ''}}">
                                    <div class="drop_nav_violation">
                                        <a class="dropdown-item" href="/articles/non-violation">
                                            {{ __('Unable to detect') }}
                                        </a>
                                        <div class="nav--btnBorder__bottom dropdown_mbl-display
                                        {{(request () -> is ('articles/non-violation')) ? 'activeHeader': ''}}"
                                        >
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li  class="nav--btn__after--login">
                            <a class="nav-link" href="/articles/manual-detection">{{ __('Submit violations') }}</a>
                            <div class="nav--btnBorder__bottom
                            {{(request () -> is ('articles/manual-detection')) ? 'activeHeader': ''}}"
                            >
                            </div>
                        </li>
                        <li  class="nav--btn__after--login">
                            <a class="nav-link" href="/analysis">{{ __('Analysis') }}</a>
                            <div class="nav--btnBorder__bottom
                            {{(request ()-> is ('analysis')) ? 'activeHeader': ''}}"
                            >
                            </div>
                        </li>
                        @is_admin
                            <li class="nav--btn__after--login">
                                <a class="nav-link" href="/admins">{{ __('Admin Management') }}</a>
                                <div class="nav--btnBorder__bottom
                                {{(request ()-> is ('admins')) ? 'activeHeader': ''}}"
                                >
                                </div>
                            </li>
                        @endis_admin
                        @auth
                            <li class="nav--btn__after--login">
                                <a class="nav-link" href="/user-manual">{{ __('User manual') }}</a>
                                <div class="nav--btnBorder__bottom
                                {{(request ()-> is ('user-manual')) ? 'activeHeader': ''}}"
                                >
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
                @guest
                    @if (Route::has('login'))
                        <div class="nav__btn--login no-margin btn_no-login" >
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </div>
                    @endif
                @else
                    <div class="nav__btn--login  after-login no-margin" >
                        {{-- <img src="{{ asset('assets/image/user.svg') }}" alt=""> --}}
                        <p class="name_login">{{ @Auth::user()->full_name }}</p>
                        <div class="dropdown-login">
                            <div id="edit__profile">
                                <p>Profile</p>
                                <input type="hidden" data-name ="{{ @Auth::user()->full_name }}"
                                data-phone ={{ @Auth::user()->phone_number }} data-auth ={{ @Auth::user()->role }}
                                data-id ={{ @Auth::user()->_id }} data-email ={{ @Auth::user()->email }}>
                            </div>
                            <input type="hidden" data=>
                            <p>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    <div class="modal_edit_user">
        @include('modal/editAccount')
    </div>
    <div class="overlay overlay_nav" ></div>
    @if((!request () -> is ('articles/'. request()->id .'/details')) && (!request () -> is ('articles/'. request()->id .'/violation')) && (!request () -> is ('articles/'. request()->id .'/non-violation')))
    <span class="open_Nav {{request ()-> is ('/') || request ()-> is ('login') || strpos($_SERVER['REQUEST_URI'],"password/reset") == 1 ? 'menuWhite': ''}}" style="cursor:pointer" ></span>
    @endif
</div>
{{-- @endif --}}

