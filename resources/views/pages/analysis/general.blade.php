<div class="index__violation">
    <div >
        <p class="title-violation">{{ __('Non-violation') }}</p>
        <p class="number-violation">{{ $generalData['non_violation'] }}</p>
        <p class="percent-violation">{{ $generalData['percentile_non_violation'] }}%</p>
    </div>
</div>
<div class="index__violation">
    <div>
        <p class="title-violation">{{ __('Violation') }}</p>
        <p class="number-violation">{{ $generalData['violation'] }}</p>
        <p class="percent-violation">{{ $generalData['percentile_violation'] }}%</p>
    </div>
</div>
<div class="index__violation">
    <div>
        <p class="title-violation">{{ __('Total articles') }}</p>
        <p class="number-violation">{{ $generalData['total'] }}</p>
    </div>
</div>