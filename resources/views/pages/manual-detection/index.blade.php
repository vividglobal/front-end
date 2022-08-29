@extends('layouts.app')
@section('content')
<div class="list--search--select fix_manual" >
    <div class="list--title">
        <p>{{ __('Submit violations') }}</p>
    </div>
    <!-- Checkbox suspected -->
    <div class="list--suspected__text--img">
        <div  class="rows ">
            <label class="container__checkbox checkbox__suspected col l-4 m-6 c-6 ">
                <input type="radio" name="label_type" value="{{ LABEL_TYPE_IMAGE }}" id="image">
                <span class="checkmark checkmark_label"></span>
            </label>
            @auth
            <label class="container__checkbox checkbox__suspected col l-7 m-6 c-6">
                <input type="radio" name="label_type" value="{{ LABEL_TYPE_URL }}" id="text">
                <span class="checkmark checkmark_label"></span>
            </label>
            @endauth
        </div>
        <!-- choose file -->
        <div class="rows">
            <div class="suspected__text__area l-8 m-12 c-12">
                <textarea class="input-style-focus" name="text" cols="30" rows="10"></textarea>
            </div>
            <div class="suspected__file__area l-3 m-12 c-12">
                <div class='file-input_detect'>
                    <input type='file' name="image">
                    <span class='button'><img src="{{asset('assets/image/upfile.svg')}}" alt=""></span>
                    <span class='label' data-js-label>{{ __('Or drop the image here') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="check_country">
        {{-- USE NAME country_label if target get id country--}}
        <div class="list--country ctr_suspected select_country_manual country_pc country_label" id="btn-language">
            <img src="{{asset('assets/image/Country.svg')}}" alt="">
            <p class="updata-form">{{ __('Country') }}</p>
            <img src="{{asset('assets/image/Under-than.svg')}}" alt="">
            <div class="select--country slc_suspected" id="language">
                <div class="search--input--country search_suspected" id="div-search">
                    <img src="{{asset('assets/image/search.svg')}}" alt="">
                    <input type="text" name="country" placeholder="Search for country" class="search--country input-style-focus">
                </div>
                <div class="contain--selection">
                    <div class="select__one--country option_suspected" id=0>
                        <p data-id=0 >{{ __('-Select country-') }}</p>
                        <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                    </div>
                    @foreach ($countries as $country)
                        <div class="select__one--country option_suspected" id="{{$country->_id}}">
                            <p  data-id={{$country->_id}}>{{$country->name}}</p>
                            <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                        </div>
                    @endforeach
                    @include('noSearchResult.search_filter')
                </div>
            </div>
        </div>
        <div class="border_gray gray_mobi "></div>
        <div class="checkbox_mobi country_mobile country_label">
            <div class="checkbox_title">
                <div>
                    <img src="{{asset('assets/image/Country.svg')}}" alt="">
                    <span>{{ __("Country") }}</span>
                </div>
                <img src="{{asset('assets/image/under_than-black.svg')}}" alt="">
            </div>
            <p></p>
        </div>
        <div class="border_gray gray_mobi "></div>
    </div>
    @include('pages/manual-detection/captcha')

    <div class="btn__check">
        <button id='submit_form'>{{ __('Check') }}</button>
    </div>

<div class="title__result">
</div>
<!-- list Btn  -->
@include('pages/components/query', ['list_filter' => ["search","date","brand","violation","country","apply","excel","fillter_mobile"], 'show_all_filter' => false])
</div>
<div class="row-a">
    @include('pages/components/table-detect-label', compact('violationCode'))
</div>

<div id="modal-country-label_mobi" class="modal">
    <div class="modal__content full_modal">
        <div class="container_modal_edit">
            <div class="close__modal close_modal_mobi"></div>
            <div class="title-modal title_mobile">
                <p>{{ __('Select country') }}</p>
            </div>
            <div class=" slc_general country_mobi" id="toggle">
                <div class="search--input--country search_general" id="div-search">
                    <img src="{{asset('assets/image/search.svg')}}" alt="">
                    <input type="text" placeholder="Search for country" class="search--country input-style-focus" >
                </div>
                <div class="contain--selection contain_country">
                        <label class="container_checkbox select__one--country option_general" id=0>
                            <p  data-id=0 >None</p>
                            <input type="checkbox"  name="radio" class="input_checkbox">
                            <span class="checkmark_checkbox"></span>
                        </label>
                    @foreach ($countries as $country)
                        <label class="container_checkbox select__one--country option_general" id={{$country->_id}}>
                            <p  data-id={{$country->_id}} >{{$country->name}}</p>
                            <input type="checkbox"  name="radio" class="input_checkbox">
                            <span class="checkmark_checkbox"></span>
                        </label>
                    @endforeach
                    @include('noSearchResult.search_filter')
                </div>
            </div>
        </div>
        <div class="btn-modal rows no-margin">
            <button class="btn__cancel-button btn_cancel_mobi cancel_create-account">{{ __('Cancel') }}</button>
            <button class="btn_edit_mobi get_country_mobi">{{ __('Save change') }}</button>
        </div>
    </div>
    <div class="overlay"></div>
</div>

<script>
    const LABEL_TYPE_IMAGE = "{{ LABEL_TYPE_IMAGE }}";
    const LABEL_TYPE_URL = "{{ LABEL_TYPE_URL }}";
</script>

<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/query/queryData.js') }}"></script>
<script src="{{ asset('assets/js/pages/manual-detection.js') }}"></script>

@endsection


