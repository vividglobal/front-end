@extends('layouts.app')
@section('content')
<div class="list--search--select title_analysis" >
    <div class="list--title">
        <p>{{ __('Analysis') }}</p>
    </div>
    <!-- list Btn  -->
    <div class="list--select--option slc_analysis">
        <div class="list--select__left">
            <div id="daterange" class="no_apply">
                <i class="ico-date"></i>
                <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                <img class="remove_daterange" src="{{ asset('assets/image/x.svg') }}" alt="">
            </div>
            <div id="daterange" class="is_apply {{!@Auth::user() ? 'no-margin' : ''}}">
                <i class="ico-date"></i>
                <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                <img class="remove_daterange" src="{{ asset('assets/image/x.svg') }}" alt="">
            </div>
            <button id="apply_date">{{ __('Apply') }}</button>
        </div>
        <div class="list--select__right">
            @auth
                <a href="{{ getExportUrl() }}" target="_blank"
                    class="btn--export--excel" >
                    <p class="btn_excel"></p>
                </a>
            @endauth
        </div>
    </div>
</div>
<div class="index_violation-nonViolation rows {{!@Auth::user()  ? "height_other" : "" }}" id="general">
</div>
<div class="table_map table_brand ">
    <div class="block_map">
        <div >
            <p class="title__country--violation">{{ __('Violation based on countries') }}</p>
        </div>
        <div class="frame-wrapper">
            <iframe id="world-map" src="/analysis/violation-by-country" frameborder="0" scrolling="no" ></iframe>
        </div>
    </div>
</div>

<div class="Base_violation--brand table_brand" id="tb_brand">
    <div class="list--select--option" style="flex-direction: row-reverse;">
        <div class="list--select__left fillter_brand" style="justify-content: flex-end">
            @include('pages/components/query', ['list_filter' => ["brand", "country", "violation", "apply","fillter_mobile"], 'show_all_filter' => false])
        </div>
        <div class="list--select__right" style="justify-content: flex-start">
            <p class="title__base--violation">{{ __('Violations by company/brand') }}</p>
        </div>
    </div>
    <div class="table-wrapper" id="vio-based-brand"></div>
</div>

<div class="Base_violation--brand table_brand table_code" id="tb_code">
    <div class="list--select--option" style="flex-direction: row-reverse;">
        <div class="list--select__left fillter_code" style="justify-content: flex-end">
            @include('pages/components/query', ['list_filter' => ["fillter_mobile"], 'show_all_filter' => false])
        </div>
        <div class="list--select__right" style="justify-content: flex-start;width: 100%;">
            <p class="title__base--violation"> {{ __("Violations by type and Code article") }} </p>
        </div>
    </div>
    <div class="table-wrapper" id="vio-based-code"></div>
</div>


<script>
    let csrf = "{{ csrf_token() }}";
</script>
<script src="{{ asset('assets/js/pages/analysis.js') }}"></script>
<script src="{{ asset('assets/js/plugins/plotly/plotly-2.12.1.min.js') }}"></script>

@endsection
