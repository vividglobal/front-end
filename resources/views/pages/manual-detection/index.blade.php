@extends('layouts.app')
@section('content')
<div class="list--search--select fix_manual" >
    <div class="list--title">
        <p>{{ __('Label violations') }}</p>
    </div>
    <!-- Checkbox suspected -->
    <div class="list--suspected__text--img">
        <div  class="rows ">
            <label class="container__checkbox checkbox__suspected col l-4 m-6 c-6 ">
                <input type="radio" name="radio" id="image">
                <span class="checkmark"></span>
            </label>
            <label class="container__checkbox checkbox__suspected col l-7 m-6 c-6">
                <input type="radio" name="radio" id="text">
                <span class="checkmark"></span>
            </label>
        </div>
        <!-- choose file -->
        <div class="rows">
            <div class="suspected__text__area l-8 m-12 c-12">
                <textarea name="" id="" cols="30" rows="10">
                </textarea>
            </div>
            <div class="suspected__file__area l-3 m-12 c-12">
                <div class='file-input_detect'>
                    <input type='file'>
                    <span class='button'><img src="{{asset('assets/image/upfile.svg')}}" alt=""></span>
                    <span class='label' data-js-label>{{ __('Or drop the image here') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="list--country ctr_suspected select_country_manual country_pc" id="btn-language">
        <img src="{{asset('assets/image/Country.svg')}}" alt="">
        <p>{{ __('Country') }}</p>
        <img src="{{asset('assets/image/Under-than.svg')}}" alt="">
        <div class="select--country slc_suspected" id="language">
            <div class="search--input--country search_suspected" id="div-search">
                <img src="{{asset('assets/image/search.svg')}}" alt="">
                <input type="text" placeholder="Search for country" class="search--country">
            </div>
            <div class="contain--selection">
                <div class="select__one--country option_suspected  " id=0>
                    <p data-id=0 >{{ __('-Select country-') }}</p>
                    <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                </div>
                @foreach ($countries as $country)
                    <div class="select__one--country option_suspected  " id="{{$country->_id}}">
                        <p  data-id={{$country->_id}}>{{$country->name}}</p>
                        <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="border_gray gray_mobi"></div>
    <div class="checkbox_mobi country_mobile">
        <div class="checkbox_title">
            <div>
                <img src="{{asset('assets/image/Country.svg')}}" alt="">
                <span>{{ __("Country") }}</span>
            </div>
            <img src="{{asset('assets/image/under_than-black.svg')}}" alt="">
        </div>
        <p></p>
        <div class="select--country slc_general country_mobi" id="toggle">
            <div class="search--input--country search_general" id="div-search">
                <img src="{{asset('assets/image/search.svg')}}" alt="">
                <input type="text" placeholder="Search for country" class="search--country" >
            </div>
            <div class="contain--selection contain_country">
                @foreach ($countries as $country)
                    <label class="container_checkbox select__one--country option_general" id={{$country->_id}}>
                        <p  data-id={{$country->_id}} >{{$country->name}}</p>
                        <input type="checkbox"  name="radio" class="input_checkbox">
                        <span class="checkmark_checkbox"></span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
    <div class="border_gray gray_mobi"></div>
@include('pages/manual-detection/captcha')
<div class="title__result">
    <p>{{ __('Result:') }}</p>
</div>
<!-- list Btn  -->
@include('pages/components/query', ['list_filter' => ["search","date","brand","violation","country","apply","excel"], 'show_all_filter' => false])
</div>
<div class="row-a">
    @include('pages/components/table-detect-label', compact('violationCode'))
</div>
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
<script src="{{ asset('assets/js/query/queryData.js') }}"></script>

@endsection

