<script src="{{ asset('assets/js/header/dropDown_header.js') }}"></script>
<script src="{{ asset('assets/js/modal/modalEditAccount.js') }}"></script>
<div class="nav_container ">
    <div class="rows nav-menu" >
        <div <?php if(Auth::user()!== null){ ?> class="col l-11 no-padding" <?php }else{ ?>class="col l-10" <?php } ?>>
        <ul class="rows no-gutters l-o-2 btn__header">
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
            <li class="nav--btn__after--login">
                <div>
                    {{ __('Trace Violations') }}
                    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">
                </div>
                <div class="nav--btnBorder__bottom
                {{(request () -> is ('articles/violation')) || request () -> is ("articles/non-violation") ? 'activeHeader': ''}}"
                >
                </div>
                <ul class="nav--dropdown"
                    @if(@Auth::user() == "")
                        style="top: 100px"
                    @endif
                >
                    <li  class="{{(request () -> is ('articles/violation')) ? 'activeBackground': ''}}">
                        <a class="dropdown-item"href="/articles/violation">
                            {{ __('Violation list') }}
                        </a>
                    </li>
                    <li class="{{(request () -> is ('articles/non-violation')) ? 'activeBackground': ''}}">
                        <a class="dropdown-item" href="/articles/non-violation">
                            {{ __('Non-violation list') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li  class="nav--btn__after--login">
                <a class="nav-link" href="/articles/manual-detection">{{ __('Label violations') }}</a>
                <div class="nav--btnBorder__bottom"></div>
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
                <div class="nav__btn--login no-padding col l-2" style="
                display: flex;
                justify-content: end;
                align-items: center;">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
            @endif
        @else
            <div class="nav__btn--login  after-login no-padding col l-1">
                <img src="{{ asset('assets/image/user.svg') }}" alt="">
                <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">
                <div class="dropdown-login">
                    <div id="edit__profile">
                        <p>Profile</p>
                        <input type="hidden" data-name ={{ @Auth::user()->full_name }}
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
            @include('modal/editAccount')
        @endguest
    </div>
</div>


