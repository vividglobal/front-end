<div class="title_table_analysis index__violation l-12 m-12 c-12">
    <p>Violation status</p>
</div>
    @auth
    <div class="index__violation l-6 m-12 c-12 unable_detect">
        <div >
            <p class="title-violation">{{ __('Unable to detect') }}</p>
            <p class="number-violation">{{ $generalData['non_violation'] }}</p>
            <p class="percent-violation">{{ $generalData['percentile_non_violation'] }}%</p>
        </div>
    </div>
    @endauth
    <div class="index__violation {{@Auth::user() ? "l-6" : "l-4" }} m-12 c-12 violations_analysis">
        <div>
            <p class="title-violation">{{ __('Violations') }}</p>
            <p class="number-violation">{{ $generalData['violation'] }}</p>
            <p class="percent-violation">{{ $generalData['percentile_violation'] }}%</p>
        </div>
    </div>
    <div class="index__violation {{@Auth::user() ? "l-6" : "l-4" }} m-12 c-12 review_violation">
        <div>
            <p class="title-violation">{{ __('Violations detected/submitted') }}</p>
            <p class="number-violation">{{ __($generalData['total'] - $generalData['violation'] - $generalData['non_violation'] ) }}</p>
            <p class="total-violation">{{ __(100 - $generalData['percentile_violation'] - $generalData['percentile_non_violation']) }}%</p>
        </div>
    </div>
    <div class="index__violation {{@Auth::user() ? "l-6" : "l-4" }} m-12 c-12 total_entries">
        <div>
            <p class="title-violation">{{ __('Total Entries') }}</p>
            <p class="number-violation">{{ $generalData['total'] }}</p>
            <p class="total-violation">{{ __(100) }}%</p>
        </div>
    </div>


