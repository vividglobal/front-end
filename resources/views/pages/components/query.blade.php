<div class="list--select--option {{ request ()->is('analysis') ? 'padding_btn_analysis' : '' }}" >
    <div class="list--select__left {{ request ()->is('analysis') ? 'max_width' : '' }}" >
        @if(in_array('search', $list_filter) || $show_all_filter)
            <div class="list--search">
                <img src="{{ asset('assets/image/search.svg') }}" alt="search" class="btn-search">
                <input type="text" placeholder="Search" class="search">
            </div>
        @endif
        @if(in_array('date', $list_filter) || $show_all_filter)
            <div id="daterange">
                <i class="ico-date"></i>
                <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
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
                <select name="" id=""></select>
            </div>
        @endif
        @if(in_array('excel', $list_filter)|| $show_all_filter)
        @auth
            <a href="{{ getExportUrl() }}" target="_blank"
            class="btn--export--excel">
                <p>{{ __('Export Excel') }}</p>
            </a>
        @endauth
        @endif
    </div>
</div>
