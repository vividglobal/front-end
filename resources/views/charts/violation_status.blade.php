<head>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/jquery/jquery.lazy.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dateRangePicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dateRangePicker/dateRangePicker.js') }}"></script>


    <link href="{{ asset('assets/css/default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/grid.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/all.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/js/common/loading.js') }}"></script>
</head>
<body>
    {{-- <div class="title_table_analysis index__violation l-12 m-12 c-12 {{!@Auth::user()  ? "height_before" : "height_after" }}">
        <p>Violation status</p>
    </div> --}}
    <div class="rows general_analysis no-margin">
        <div class="index__violation {{@Auth::user() ? "l-3 m-3 c-6" : "l-4 m-4 c-4" }} violations_analysis no-margin">
            <div class="counter circulars"
                data-cp-percentage="{{ $generalData['percentile_violation'] }}"
                data-cp-color="#E82A86"
                data-cp-amount="{{ $generalData['violation'] }}">
            </div>
            <p class="title-violation">{{ __('Violation') }}</p>
        </div>
        @auth
        <div class="index__violation l-3 m-3 c-6 unable_detect no-margin">
            <div class="counter circulars"
                data-cp-percentage="{{ $generalData['percentile_non_violation'] }}"
                data-cp-color="#E82A86"
                data-cp-amount="{{ $generalData['non_violation'] }}">
            </div>
            <p class="title-violation">{{ __('Unable to detect') }}</p>
        </div>
        @endauth
        <div class="index__violation {{@Auth::user() ? "l-3 m-3 c-6" : "l-4 m-4 c-4" }} review_violation no-margin">
            <div class="counter circulars"
                data-cp-percentage="{{ $generalData['total'] > 0 ? 100 - $generalData['percentile_violation'] - $generalData['percentile_non_violation'] : 0 }}"
                data-cp-color="#E82A86"
                data-cp-amount="{{ __($generalData['total'] - $generalData['violation'] - $generalData['non_violation'] ) }}">
            </div>
            <p class="title-violation">{{ __('Violations detected/submitted') }}</p>
        </div>
        <div class="index__violation {{@Auth::user() ? "l-3 m-3 c-6" : "l-4 m-4 c-4" }} total_entries no-margin">
            <div class="counter circulars"
                data-cp-percentage="{{ $generalData['total'] > 0 ? 100 : 0 }}"
                data-cp-color="#E82A86"
                data-cp-amount="{{ __($generalData['total']) }}">
            </div>
            <p class="title-violation">{{ __('Total Entries') }}</p>
        </div>
    </div>
    <script src="{{ asset('assets/js/pages/analysis.js') }}"></script>
    <script src="{{ asset('assets/js/pages/radial-progress-bar.js') }}"></script>
</body>
