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
                <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
            </div>
            <button class="btn__apply">{{ __('Apply') }}</button>
        </div>
        <div class="list--select__right">
            @auth
                <a href="{{ getExportUrl() }}" target="_blank"
                    class="btn--export--excel" style="width: 179px;display: flex;justify-content:center;text-decoration: unset">
                    <p>{{ __('Export Excel') }}</p>
                    <img src="{{ asset('assets/image/Under-than-white.svg') }}" alt="" style="margin-left: 12px;">
                </a>
            @endauth
        </div>
    </div>
</div>
<div class="index_violation-nonViolation">
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
</div>
<div class="Base_violation--brand">
    <div class="list--select--option" style="flex-direction: row-reverse;">
        <div class="list--select__left" style="justify-content: flex-end">
            @include('pages/components/query', ['list_filter' => ["brand","country","violation"], 'show_all_filter' => false])
        </div>
        <div class="list--select__right" style="justify-content: flex-start">
            <p class="title__base--violation">{{ __('Violation based on brands') }}</p>
        </div>
    </div>
    <table class="table_analysis">
        <tr>
            <th>{{ __('No') }}</th>
            <th>{{ __('Brand/Company') }}</th>
            <th>{{ __('Articles') }} <img src="{{ asset('assets/image/sort.svg') }}" alt=""></th>
            <th>{{ __('Violations') }} <img src="{{ asset('assets/image/sort.svg') }}" alt=""></th>
            <th>{{ __('Percentage') }}</th>
        </tr>
        @foreach($brandData as $key => $brand)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->total_article }}</td>
            <td>{{ $brand->total_violation_article }}</td>
            <td>{{ $brand->percent_violation_per_article }}%</td>
        </tr>
        @endforeach
    </table>
    <div class="row-pagination">
        {{ $brandData->links('layouts.my-paginate') }}
    </div>
    </div>
    <div class="Base_violation--brand">
        <div class="list--select--option" >
            <div class="list--select__right" style="justify-content: flex-start">
                <p class="title__base--violation">Violation based on code</p>
            </div>
        </div>
        <table class="table_analysis">
            <tr>
                <th>No</th>
                <th style="width: 19.2%;">Code article</th>
                <th style="width: 53.5%;">Violation type</th>
                <th style="width: 14.8%;">Articles<img src="{{ asset('assets/image/sort.svg') }}" alt=""></th>
            </tr>
            @foreach($codeData as $key => $code)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $code->name }}</td>
                <td>{{ $code->type_name }}</td>
                <td>{{ $code->total_article }}</td>
            </tr>
            @endforeach
        </table>
        <div class="row-pagination">
            {{ $codeData->links('layouts.my-paginate') }}
        </div>
    </div>

@endsection
