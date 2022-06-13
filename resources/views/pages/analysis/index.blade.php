@extends('layouts.app')

@section('content')

<div class="list--search--select" style="margin:0 199px">
        <div class="list--title">
            <p>Analysis</p>
        </div>
        <!-- list Btn  -->
        <div class="list--select--option">
            <div class="list--select__left">
                    <div id="daterange" style="width:203px">
                        <i class="ico-date"></i>
                        <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                        <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                    </div>
            </div>
            <div class="list--select__right">
                @auth
                    <a href="{{ getExportUrl() }}" target="_blank"
                        class="btn--export--excel" style="width: 179px;display: flex;justify-content:center;text-decoration: unset">
                        <p>Export Excel</p>
                        <img src="{{ asset('assets/image/Under-than-white.svg') }}" alt="" style="margin-left: 12px;">
                    </a>
                @endauth
            </div>
        </div>
</div>
<div class="index_violation-nonViolation">
    <div class="index__violation">
        <div >
            <p class="title-violation">Non-violation</p>
            <p class="number-violation">{{ $generalData['non_violation'] }}</p>
            <p class="percent-violation">{{ $generalData['percentile_non_violation'] }}%</p>
        </div>
    </div>
    <div class="index__violation">
        <div>
            <p class="title-violation">Violation</p>
            <p class="number-violation">{{ $generalData['violation'] }}</p>
            <p class="percent-violation">{{ $generalData['percentile_violation'] }}%</p>
        </div>
    </div>
    <div class="index__violation">
        <div>
            <p class="title-violation">Total articles</p>
            <p class="number-violation">{{ $generalData['total'] }}</p>
        </div>
    </div>
</div>
    <div class="Base_violation--brand">
            <div class="list--select--option" style="flex-direction: row-reverse;">
                <div class="list--select__left" style="justify-content: flex-end">
                    <div class="list--company--brand" style="z-index: 1;">
                        <img src="{{ asset('assets/image/brand-tag.svg') }}" alt="">
                        <p>Brand/Company</p>
                        <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">

                        <div class="select--company-or-brand" id="toggle">
                                <div class="search--input">
                                    <img src="{{ asset('assets/image/search.svg') }}" alt="">
                                    <input type="text" placeholder="Search for Brand" class="search--brand">
                                </div>
                                <div class="contain--selection">
                                    <div class="select__one">
                                        <p>- Select Brand -</p>
                                        <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                    </div>
                                    <div class="select__one">
                                        <p>Nestle</p>
                                        <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                    </div>
                                    <div class="select__one">
                                        <p>Dutch Lady</p>
                                        <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="list--country" id="btn-language" style="z-index: 1;">
                        <img src="{{ asset('assets/image/Country.svg') }}" alt="">
                        <p>Country</p>
                        <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">

                        <div class="select--country" id="language">
                            <div class="search--input--country" id="div-search">
                                <img src="{{ asset('assets/image/search.svg') }}" alt="">
                                <input type="text" placeholder="Search for country" class="search--country" id="language-search">
                            </div>
                            <div class="contain--selection">
                                <div class="select__one--country select-language">
                                    <p>- Select country -</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                                <div class="select__one--country select-language">
                                    <p>Endland</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                                <div class="select__one--country select-language">
                                    <p>Albania</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list--violation--type" style="z-index: 1;">
                        <img src="{{ asset('assets/image/type.svg') }}" alt="">
                        <p>Violation type</p>
                        <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">

                        <div class="select--violation--type" id="toggle">
                                <div class="select__one--violation--type">
                                    <p>- Select Brand -</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                                <div class="select__one--violation--type">
                                    <p>Nestle</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                                <div class="select__one--violation--type">
                                    <p>Dutch Lady</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="list--select__right" style="justify-content: flex-start">
                    <p class="title__base--violation">Violation based on brands</p>
                </div>
            </div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Brand/ Company</th>
                    <th>Articles <img src="{{ asset('assets/image/sort.svg') }}" alt=""></th>
                    <th>Violations <img src="{{ asset('assets/image/sort.svg') }}" alt=""></th>
                    <th>Percentage</th>
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
        <table>
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
