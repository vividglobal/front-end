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
                            <!-- //HTML -->
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
        @include('pages/components/query')
</div>
<div class="row-a">
    @include('pages/components/table-detect-label', compact('violationCode'))
</div>
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
@endsection
