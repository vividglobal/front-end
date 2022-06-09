<div class="nav_container ">
    <div class="nav-menu" >
        <ul>
            <li <?php if(Auth::user()!== null){  ?> class="nav--btn__after--login" <?php }else{?>class="nav--btn__before--login"<?php } ?> >
                <a class="nav-link" href="/">{{ __('Home') }}</a>
                <div class="nav--btnBorder__bottom" <?php if($_SERVER['REQUEST_URI'] === "/")
                { ?>style="border-bottom: 1px solid #0C3C60;"  <?php } ?> >
                </div>
            </li>
            <li <?php if(Auth::user()!== null){  ?> class="nav--btn__after--login" <?php }else{?>class="nav--btn__before--login"<?php } ?>>
                <a class="nav-link" href="/articles/auto-detection">{{ __('Auto-detect violations') }}</a>
                <div class="nav--btnBorder__bottom" <?php if($_SERVER['REQUEST_URI'] === "/articles/auto-detection")
                { ?>style="border-bottom: 1px solid #0C3C60;"  <?php } ?> >
                </div>
            </li>
            <li <?php if(Auth::user()!== null){  ?> class="nav--btn__after--login btn-dropdown" <?php }else{?>class="nav--btn__before--login btn-dropdown"<?php } ?>>
                <div>
                    {{ __('Trace Violations') }}
                    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">
                </div>
                <div class="nav--btnBorder__bottom" <?php if($_SERVER['REQUEST_URI'] === "/articles/violation" || $_SERVER['REQUEST_URI'] === "/articles/none-violation")
                { ?>style="border-bottom: 1px solid #0C3C60;"  <?php } ?> >
                </div>
                <ul class="nav--dropdown">
                    <li <?php if($_SERVER['REQUEST_URI'] === "/articles/violation")
                    { ?>style="background-color: #F4F4F4;"<?php } ?>>
                        <a class="dropdown-item"href="/articles/violation">
                            {{ __('Violation list') }}
                        </a>
                    </li>
                    <li <?php if($_SERVER['REQUEST_URI'] === "/articles/none-violation")
                    { ?>style="background-color: #F4F4F4;"<?php } ?>>
                        <a class="dropdown-item" href="/articles/none-violation">
                            {{ __('None-violation list') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li <?php if(Auth::user()!== null){  ?> class="nav--btn__after--login" <?php }else{?>class="nav--btn__before--login"<?php } ?>>
                <a class="nav-link" href="/articles/manual-detection">{{ __('Label violations') }}</a>
                <div class="nav--btnBorder__bottom"></div>
                <div class="nav--btnBorder__bottom" <?php if($_SERVER['REQUEST_URI'] === "/articles/manual-detection")
                { ?>style="border-bottom: 1px solid #0C3C60;"  <?php } ?> >
                </div>
            </li>
            <li <?php if(Auth::user()!== null){  ?> class="nav--btn__after--login" <?php }else{?>class="nav--btn__before--login"<?php } ?>>
                <a class="nav-link" href="/analysis">{{ __('Analysis') }}</a>
                <div class="nav--btnBorder__bottom" <?php if($_SERVER['REQUEST_URI'] === "/analysis")
                { ?>style="border-bottom: 1px solid #0C3C60;"  <?php } ?> >
                </div>
            </li>
            @is_admin
                <li class="nav--btn__after--login">
                    <a class="nav-link" href="/admins">{{ __('Admin Management') }}</a>
                    <div class="nav--btnBorder__bottom" <?php if($_SERVER['REQUEST_URI'] === "/admins")
                    { ?>style="border-bottom: 1px solid #0C3C60;"  <?php } ?> >
                    </div>
                </li>
            @endis_admin
            @auth
                <li class="nav--btn__after--login">
                    <a class="nav-link" href="/user-manual">{{ __('User manual') }}</a>
                    <div class="nav--btnBorder__bottom" <?php if($_SERVER['REQUEST_URI'] === "/user-manual")
                    { ?>style="border-bottom: 1px solid #0C3C60;"  <?php } ?> >
                    </div>
                </li>
            @endauth
        </ul>
        @guest
            @if (Route::has('login'))
                <div class="nav__btn--login" style="margin: 0 60px 0 20px">
                    <p>
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </p>
                </div>
            @endif
        @else
            <div class="nav__btn--login after-login">
                <img src="{{ asset('assets/image/user.svg') }}" alt="">
                <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">
                <div class="dropdown-login">
                    <p id="edit__profile">Profile</p>
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


