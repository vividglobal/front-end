@extends('layouts.app')
@section('content')
<div style="overflow: hidden">
    <div class="index_violation-nonViolation rows no-margin" id="general"></div>
    <div class="table_map table_brand ">
        <div class="block_map">
            <div >
                <p class="title__country--violation padding_title">{{ __('Violation based on countries') }}</p>
            </div>
            <div class="frame-wrapper">
                <iframe id="world-map" src="/analysis/violation-by-country" frameborder="0" scrolling="no" ></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    let csrf = "{{ csrf_token() }}";
    $('.nav_container').remove(); // Hide header
</script>
<script src="{{ asset('assets/js/pages/analysis.js') }}"></script>
<script src="{{ asset('assets/js/pages/radial-progress-bar.js') }}"></script>
@endsection
