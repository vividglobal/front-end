<div class="list--select--option {{ request ()->is('analysis') ? 'padding_btn_analysis' : '' }}" >
    <div class="list--select__left {{ request ()->is('analysis') ? 'max_width' : '' }}" >
        @if(in_array('search', $list_filter) || $show_all_filter)
            <form class="list--search " id="form_search">
                <button class="btn-search" type= "submit" alt="menu_icon">
                    <img src="{{ asset('assets/image/search.svg') }}" class="btn-search">
                </button>
                <input type="text" placeholder="Search" class="search" name="keyword" >
            </form>
        @endif

        <div class="list_filter">
            @if(in_array('date', $list_filter) || $show_all_filter)
            <div id="daterange" class="no_apply">
                <i class="ico-date"></i>
                <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                <img class="remove_daterange" src="{{ asset('assets/image/x.svg') }}" alt="">
            </div>
            @endif
            @if(in_array('brand', $list_filter) || $show_all_filter)
                @include('pages/components/brand')
            @endif
            @if(in_array('country', $list_filter) || $show_all_filter)
            @include('pages/components/country')
            @endif
            @if(in_array('violation', $list_filter) || $show_all_filter)
                @include('pages/components/violationType')
            @endif
            @if(in_array('apply', $list_filter) || $show_all_filter)
                <button class="btn__apply" id="apply_query">Apply</button>
            @endif
        </div>

        <div class="list--select__right">
            @if(in_array('showing', $list_filter)|| $show_all_filter)
                <p>{{ __('Showing') }}</p>
                <div class="list--showing">
                    <select ></select>
                </div>
            @endif
            @if(in_array('excel', $list_filter)|| $show_all_filter)
            @auth
                <a href="{{ getExportUrl() }}" target="_blank"
                class="btn--export--excel">
                    <p class="btn_excel"></p>
                </a>
            @endauth
            @endif
        </div>
    </div>
</div>

 {{-- //MOBILE --}}

@if(in_array('fillter_mobile', $list_filter))
    <span class="open_Nav_filter" style="cursor:pointer" ></span>
@endif

 <div id="myFilter" class="sideFilter">
    <a class="closebtn closeFilter" ><img src="{{ asset('assets/image/ep_back.svg') }}" alt="">{{ __("Filter") }}</a>

    <div class="filter_list-mobi">
            <div id="daterange" class="daterange_mobi no_apply">
                <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                <input type="text" class="form--daterange date_mobile" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                <img class="remove_daterange" src="{{ asset('assets/image/x.svg') }}" alt="">
            </div>
            <div id="daterange" class="daterange_mobi is_apply">
                <i class="ico-date"></i>
                <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                <img class="remove_daterange" src="{{ asset('assets/image/x.svg') }}" alt="">
            </div>
        <div class="checkbox_mobi sort_mobi">
            <div class="checkbox_title">
                <div>
                    <img src="{{asset('assets/image/sort_black.svg')}}" alt="">
                    <span>{{ __("Sort by") }}</span>
                </div>
                <img src="{{asset('assets/image/under_than-black.svg')}}" alt="">
            </div>
            @if(!request ()-> is ('analysis'))
            <p data-value="A to Z">A to Z</p>
            @else
            <p class="text_brand"></p>
            <p class="text_code"></p>
            @endif
            @include('pages/components/sort')
        </div>
        <div class="border_gray"></div>
        <div class="checkbox_mobi">
            <div class="checkbox_title">
                <div>
                    <img src="{{asset('assets/image/brand-tag.svg')}}" alt="">
                    <span>{{ __("Brand/Company") }}</span>
                </div>
                <img src="{{asset('assets/image/under_than-black.svg')}}" alt="">
            </div>
            <p></p>
            <div class="select--company-or-brand brand_mobi" id="toggle">
                <div class="search--input">
                    <img src="{{asset('assets/image/search.svg')}}" alt="">
                    <input type="text" placeholder="Search for Brand" class="search--brand">
                </div>
                <div class="contain--selection">
                        <label class="container_checkbox select__one" ><p  data-id=0 >None</p>
                            <input type="checkbox"  name="radio" class="input_checkbox">
                            <span class="checkmark_checkbox"></span>
                        </label>
                    @foreach ($brands as $brand)
                        <label class="container_checkbox select__one" id={{$brand->_id}}><p  data-id={{$brand->_id}} >{{$brand->name}}</p>
                            <input type="checkbox"  name="radio" class="input_checkbox">
                            <span class="checkmark_checkbox"></span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="border_gray"></div>
        <div class="checkbox_mobi">
            <div class="checkbox_title">
                <div>
                    <img src="{{asset('assets/image/Country.svg')}}" alt="">
                    <span>{{ __("Country") }}</span>
                </div>
                <img src="{{asset('assets/image/under_than-black.svg')}}" alt="">
            </div>
            <p></p>
            <div class="select--country slc_general country_mobi filter_country_mobi" id="toggle">
                <div class="search--input--country search_general" id="div-search">
                    <img src="{{asset('assets/image/search.svg')}}" alt="">
                    <input type="text" placeholder="Search for country" class="search--country" >
                </div>
                <div class="contain--selection contain_country">
                        <label class="container_checkbox select__one--country option_general" ><p  data-id=0 >None</p>
                            <input type="checkbox"  name="radio" class="input_checkbox">
                            <span class="checkmark_checkbox"></span>
                        </label>
                    @foreach ($countries as $country)
                        <label class="container_checkbox select__one--country option_general" id={{$country->_id}}>
                            <p  data-id={{$country->_id}} >{{$country->name}}</p>
                            <input type="checkbox"  name="radio" class="input_checkbox">
                            <span class="checkmark_checkbox"></span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="border_gray"></div>
        @if(!request ()->is('articles/non-violation'))
            <div class="checkbox_mobi ">
                <div class="checkbox_title">
                    <div>
                        <img src="{{asset('assets/image/type.svg')}}" alt="">
                        <span>{{ __("Violation type") }}</span>
                    </div>
                    <img src="{{asset('assets/image/under_than-black.svg')}}" alt="">
                </div>
                <p></p>
                <div class="select--violation--type violation_mobi" id="toggle">
                        <label class="container_checkbox select__one--violation--type" ><p  data-id=0 >None</p>
                            <input type="checkbox"  name="radio" class="input_checkbox">
                            <span class="checkmark_checkbox"></span>
                        </label>
                    @foreach ($violationTypes as $violationType)
                        <label class="container_checkbox select__one--violation--type" id={{$violationType->_id}}>
                            <p  data-id={{$violationType->_id}}>{{$violationType->name}}</p>
                            <input type="checkbox"  name="radio" class="input_checkbox">
                            <span class="checkmark_checkbox"></span>
                        </label>
                    @endforeach
                </div>
            </div>
        <div class="border_gray"></div>
        @endif
    </div>
    <div class="btn_apply_mobi">
        <button class="close__filter">Cancel</button>
        <button class="btn__apply" id="apply_query" >Apply</button>
    </div>
  </div>

