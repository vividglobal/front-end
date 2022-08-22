<div class="title_table_analysis index__violation l-12 m-12 c-12 {{!@Auth::user()  ? "height_before" : "height_after" }}">
    <p>Violation status</p>
</div>
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
        <p class="title-violation">{{ __('Violations detected/ submitted') }}</p>
    </div>
    <div class="index__violation {{@Auth::user() ? "l-3 m-3 c-6" : "l-4 m-4 c-4" }} total_entries no-margin">
        <div class="counter circulars"
            data-cp-percentage="{{ $generalData['total'] > 0 ? 100 : 0 }}"
            data-cp-color="#E82A86"
            data-cp-amount="{{ __($generalData['total']) }}">
        </div>
        <p class="title-violation">{{ __('Total Entries') }}</p>
    </div>
    <script>
        circleProgress('.counter');
    </script>
</div>

