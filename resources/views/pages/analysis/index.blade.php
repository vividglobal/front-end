@extends('layouts.app')
@section('content')
<div class="list--search--select" style="margin:0 199px">
    <div class="list--title">
        <p>{{ __('Analysis') }}</p>
    </div>
    <!-- list Btn  -->
    <div class="list--select--option">
        <div class="list--select__left">
            <div id="daterange" style="width:203px">
                <i class="ico-date"></i>
                <img src="../assets/image/calendar.svg" alt="">
                <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
            </div>
            <button class="btn__apply">{{ __('Apply') }}</button>
        </div>
        <div class="list--select__right">
            @auth
                <a href="{{ getExportUrl() }}" target="_blank"
                    class="btn--export--excel" style="width: 179px;display: flex;justify-content:center;text-decoration: unset">
                    <p>{{ __('Export Excel') }}</p>
                    <img src="../assets/image/Under-than-white.svg" alt="" style="margin-left: 12px;">
                </a>
            @endauth
        </div>
    </div>
</div>

<div class="index_violation-nonViolation">
    @include('pages/analysis/general')
</div>
<div class="Base_violation--brand" id="vio-based-brand">
    <div class="list--select--option" style="flex-direction: row-reverse;">
        <div class="list--select__left" style="justify-content: flex-end">
            @include('pages/components/query', ['list_filter' => ["brand","country","violation"], 'show_all_filter' => false])
        </div>
        <div class="list--select__right" style="justify-content: flex-start">
            <p class="title__base--violation">{{ __('Violation based on brands') }}</p>
        </div>
    </div>
    @include('pages/analysis/vio_based_brand_table')
</div>

<div class="Base_violation--brand" id="vio-based-code">
    <div class="list--select--option" >
        <div class="list--select__right" style="justify-content: flex-start">
            <p class="title__base--violation">Violation based on code</p>
        </div>
    </div>
    @include('pages/analysis/vio_based_code_table')
</div>

@endsection
