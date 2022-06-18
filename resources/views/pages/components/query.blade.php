
<?php
    $arr = explode('?',$_SERVER['REQUEST_URI'],2);
?>
<div class="list--select--option <?php if(getUrlName() == "/analysis"){ ?>padding_btn_analysis <?php } ?> " >
    <div class="list--select__left" >
        @if(in_array('search', $list_filter) || $show_all_filter)
            <div class="list--search">
                <img src="{{ asset('assets/image/search.svg') }}" alt="" class="btn-search">
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
            <button class="btn__apply">Apply</button>
        @endif
    </div>
    @if(in_array('showing', $list_filter)|| $show_all_filter)
        <div class="list--select__right">
            <p>{{ __('Showing') }}</p>
            <div class="list--showing">
                <select name="" id="">
                            <!-- HTML -->
                </select>
            </div>
    @endif
    @if(in_array('excel', $list_filter)|| $show_all_filter)
            @auth
                <a href="{{ getExportUrl() }}" target="_blank"
                class="btn--export--excel">
                    <p>{{ __('Export Excel') }}</p>
                </a>
            @endauth
        </div>
    @endif
</div>
