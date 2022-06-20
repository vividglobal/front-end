@extends('layouts.app')
@section('content')
<div class="list--search--select" >
    <div class="list--title">
        <p>{{ __('Label violations') }}</p>
    </div>
    <!-- Checkbox suspected -->
    <div class="list--suspected__text--img">
        <div style="display: flex; justify-content:space-between;max-width:703px">
            <label class="container__checkbox checkbox__suspected">{{ __('Enter the suspected text/Drop image') }}
                <input type="radio" name="radio" id="image">
                <span class="checkmark"></span>
            </label>
            <label class="container__checkbox checkbox__suspected">{{ __('Enter the suspected URL') }}
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
                    <span class='button'><img src="../assets/image/upfile.svg" alt=""></span>
                    <span class='label' data-js-label>{{ __('Or drop the image here') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="list--country ctr_suspected " id="btn-language">
        <img src="../assets/image/Country.svg" alt="">
        <p>{{ __('Country') }}</p>
        <img src="../assets/image/Under-than.svg" alt="">
        <div class="select--country slc_suspected" id="language">
            <div class="search--input--country search_suspected" id="div-search">
                <img src="../assets/image/search.svg" alt="">
                <input type="text" placeholder="Search for country" class="search--country">
            </div>
            <div class="contain--selection">
                <div class="select__one--country option_suspected  " id=0>
                    <p data-id=0 >{{ __('-Select country-') }}</p>
                    <img src="../assets/image/tickV.svg" alt="">
                </div>
                @foreach ($countries as $country)
                    <div class="select__one--country option_suspected  " id="{{$country->_id}}">
                        <p  data-id={{$country->_id}}>{{$country->name}}</p>
                        <img src="../assets/image/tickV.svg" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@include('pages/manual-detection/captcha')
<div class="title__result">
    <p>{{ __('Result:') }}</p>
</div>
<!-- list Btn  -->
@include('pages/components/query', ['list_filter' => [], 'show_all_filter' => true])
</div>
<div class="row-a">
    @include('pages/components/table-detect-label', compact('violationCode'))
</div>
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
@endsection

