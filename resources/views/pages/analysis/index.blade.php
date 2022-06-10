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
                <?php if(Auth::user()){ ?>
                    <div class="btn--export--excel" style="width: 179px;display: flex;justify-content:center">
                        <p>Export Excel</p>
                        <img src="{{ asset('assets/image/Under-than-white.svg') }}" alt="" style="margin-left: 12px;">
                    </div>
                <?php } ?>
            </div>
        </div>
</div>
<div class="index_violation-nonViolation">
    <div class="index__violation">
        <div >
            <p class="title-violation">Non-violation</p>
            <p class="number-violation">17671</p>
            <p class="percent-violation">71,23%</p>
        </div>
    </div>
    <div class="index__violation">
        <div>
            <p class="title-violation">violation</p>
            <p class="number-violation">17671</p>
            <p class="percent-violation">71,23%</p>
        </div>
    </div>
    <div class="index__violation">
        <div>
            <p class="title-violation">Total articles</p>
            <p class="number-violation">17671</p>
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
                  <th>Brand</th>
                  <th>Article <img src="{{ asset('assets/image/sort.svg') }}" alt=""></th>
                  <th>Violation <img src="{{ asset('assets/image/sort.svg') }}" alt=""></th>
                  <th>Percentage</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Royal Ausnz</td>
                  <td>223</td>
                  <td>187</td>
                  <td>12%</td>
                </tr>
            </table>
            <div class="demo__pagination">
                <span>&#60;</span>
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>...</span>
                <span>9</span>
                <span>10</span>
                <span>&#62;</span>
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
              <th style="width: 14.8%;">Article<img src="{{ asset('assets/image/sort.svg') }}" alt=""></th>
            </tr>
            <tr>
              <td>1</td>
              <td>10.1</td>
              <td>2016 Guidance (Foods for Infants and Young Children)</td>
              <td>123</td>
            </tr>
        </table>
        <div class="demo__pagination">
            <span>&#60;</span>
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>...</span>
            <span>9</span>
            <span>10</span>
            <span>&#62;</span>
        </div>
    </div>

@endsection
