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
            <button class="btn__apply">{{ __('Apply') }}</button>
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

<div class="index_violation-nonViolation rows" id="general">
</div>

<div class="Base_violation--brand table_brand">
    <div class="list--select--option" style="flex-direction: row-reverse;">
        <div class="list--select__left" style="justify-content: flex-end">
            @include('pages/components/query', ['list_filter' => ["brand", "country", "violation", "apply"], 'show_all_filter' => false])
        </div>
        <div class="list--select__right" style="justify-content: flex-start">
            <p class="title__base--violation">{{ __('Violation based on brands') }}</p>
        </div>
    </div>
    <div class="table-wrapper" id="vio-based-brand"></div>
</div>

<div class="Base_violation--brand">
    <div class="list--select--option" >
        <div class="list--select__right" style="justify-content: flex-start">
            <p class="title__base--violation">Violation based on code</p>
        </div>
    </div>
    <div class="table-wrapper" id="vio-based-code"></div>
</div>


<script>
    let csrf = "{{ csrf_token() }}";
</script>
<script src="{{ asset('assets/js/pages/analysis.js') }}"></script>

@endsection
