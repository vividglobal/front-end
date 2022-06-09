@extends('layouts.app')

@section('content')
<div class="list--search--select" >
        <div class="list--title">
            <p>Label violations</p>
        </div>
          <!-- Checkbox suspected -->
          <div class="list--suspected__text--img">
            <div style="display: flex; justify-content:space-between;max-width:703px">
                <label class="container__checkbox checkbox__suspected">Enter the suspected text/Drop image
                    <input type="radio" name="radio" id="image">
                    <span class="checkmark"></span>
                </label>
                <label class="container__checkbox checkbox__suspected">Enter the suspected URL
                    <input type="radio" name="radio" id="text">
                    <span class="checkmark"></span>
                </label>
            </div>
            <!-- choose file -->
            <div style="display: flex;">
                <div class="suspected__text__area">
                    <textarea name="" id="" cols="30" rows="10">
                     </textarea>
                 </div>
                 <div class="suspected__file__area">
                    <div class='file-input'>
                        <input type='file'>
                        <span class='button'><img src="{{ asset('assets/image/upfile.svg') }}" alt=""></span>
                        <span class='label' data-js-label>Or drop the image here</label>
                    </div>
                 </div>
            </div>
        </div>
                    <!-- validate country  -->
                    <div class="list--select--option">
            <div class="list--select__left">
                <div class="list--country" style="padding:14px 5px 14px 0px;margin-bottom: 20px;" id="validate-country">
                    <img src="{{ asset('assets/image/Country.svg') }}" alt="">
                    <p>Country</p>
                    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">

                    <div class="select--country" id="validate-select-country" style="top:45px;
                    left: -1%;z-index: 1;">
                        <div class="search--input--country" id="div-validate-search-country">
                            <img src="{{ asset('assets/image/search.svg') }}" alt="">
                            <input type="text" placeholder="Search for country" class="search--country" id="validate-search-country">
                        </div>
                        <div class="contain--selection">
                            <div class="select__one--country validate-option-country">
                                <p>- Select country -</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                            <div class="select__one--country validate-option-country">
                                <p>Endland</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                            <div class="select__one--country validate-option-country">
                                <p>Albania</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages/manual-detection/captcha')
        <div class="title__result">
            <p>Result:</p>
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

<!-- <div class="row">
    <div class="col-12">
        <legend>List Articles</legend>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Company</th>
                <th scope="col">Country</th>
                <th scope="col">Brand</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Detection Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $key => $article)
                <tr>
                    <td>
                        {{ $article->company }}
                    </td>
                    <td>
                        {{ $article->country }}
                    </td>
                    <td>
                        {{ $article->brand }}
                    </td>
                    <td>
                        {{ $article->link }}
                    </td>
                    <td>
                        {{ $article->status }}
                    </td>
                    <td>
                        {{ $article->detection_type }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> -->

@endsection
