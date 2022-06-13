@extends('layouts.app')

@section('content')

<div class="row-a">
    <div class="list--search--select" >
        <div class="list--title">
            <p>Auto-dectect violations</p>
        </div>
        <!-- list Btn  -->
        <div class="list--select--option">
            <div class="list--select__left">
                <div class="list--search">
                    <img src="{{ asset('assets/image/search.svg') }}" alt="">
                    <input type="text" placeholder="Search" class="search">
                </div>
                    <div id="daterange">
                        <i class="ico-date"></i>
                        <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                        <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                    </div>
                <div class="list--company--brand">
                    <img src="{{ asset('assets/image/brand-tag.svg') }}" alt="">
                    <p>Brand/Company</p>
                    <img src="{{ asset('assets/image/under-than.svg') }}" alt="">
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

                <div class="list--country" id="btn-language">
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
                <div class="list--violation--type">
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
            <div class="list--select__right">
                <p>Showing</p>
                <div class="list--showing">
                    <select name="" id="">
                        <option value="">10</option>
                        <option value="">25</option>
                        <option value="">50</option>
                        <option value="">100</option>
                    </select>
                </div>
                <div class="btn--export--excel">
                    <p>Export Excel</p>
                </div>
            </div>
        </div>
    </div>
        <!-- Table -->
        @include('pages/components/table-detect-label')
    </div>
</div>
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
@endsection
