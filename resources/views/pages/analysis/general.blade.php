<div class="title_table_analysis index__violation l-12 m-12 c-12">
    <p>Violation status</p>
</div>
    <div class="index__violation l-4 m-12 c-12">
        <div >
            <p class="title-violation">{{ __('Non-violation') }}</p>
            <p class="number-violation">{{ $generalData['non_violation'] }}</p>
            <p class="percent-violation">{{ $generalData['percentile_non_violation'] }}%</p>
        </div>
    </div>
    <div class="index__violation l-4 m-12 c-12">
        <div>
            <p class="title-violation">{{ __('Violation') }}</p>
            <p class="number-violation">{{ $generalData['violation'] }}</p>
            <p class="percent-violation">{{ $generalData['percentile_violation'] }}%</p>
        </div>
    </div>
    <div class="index__violation l-4 m-12 c-12">
        <div>
            <p class="title-violation">{{ __('Total articles') }}</p>
            <p class="number-violation">{{ $generalData['total'] }}</p>
        </div>
    </div>

