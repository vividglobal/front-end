@extends('layouts.app')
@section('title',  config('app.name', 'Laravel'))
@section('description', config('app.name', 'Laravel'))
@section('content')
<link href="{{ asset('assets/css/home/style.css') }}" rel="stylesheet">

<div class="vituar_validation ">

    <div class="content__vituar">
        <p>{{ __('Virtual Violations Detectors') }}</p>
        <p class="updata-form">
            {{ __('VIVID is an automated solution that uses artificial intelligence
            and supervised machine learning to detect commercial violations on digital platforms.') }}
        </p>
        <button id="btn_explore" >{{ __('Explore') }}<a href="#bg-2"></a></button>
    </div>
</div>
<div class="background__vituar-2 rows " >
        <div class="background__content col l-6 m-6 c-12">
            <p>{{ __('VIVID ON THE CODE') }}</p>
            <p class="updata-form">
                {{ __('Inappropriate marketing of breastmilk substitutes, bottles and teats, and foods for infants and young
                children undermines breastfeeding and infant young child nutrition, and violates the International Code
                of Marketing of Breast- milk Substitutes (the Code).
               ') }}
            </p>
            <p class="updata-form">
                {{ __('
                The marketing is especially rampant on digital platforms, and VIVID is an effective virtual
                assistant to help detect Code violation.') }}
            </p>
        </div>
        <div class="background__image col l-6 m-6 c-12">
            <img src="{{asset('assets/image/home/img-2.svg')}}" alt="">
        </div>
</div>
<div class="background__vituar-5 rows ">
        <div class="background__image">
            <img src="{{asset('assets/image/logo_fhi.svg')}}" alt="">
        </div>
        <div class="background__image">
            <img src="{{asset('assets/image/logo_innovation.svg')}}" alt="">
        </div>
        <div class="background__image">
            <img src="{{asset('assets/image/home/hekate.png')}}" alt="">
        </div>
</div>
<div class="background__vituar-6">
    <p>{{ __('FUNCTIONS') }}</p>
</div>
<div class="background__vituar-7 rows">
    <div class="background__image col l-4 m-4 c-12 no-margin">
        <div>
            <img src="{{asset('assets/image/home/face-detection.svg')}}" alt="">
            <p class="updata-form">{{ __('Auto-detecting Code violations 24/7') }}</p>
        </div>
    </div>
    <div class="background__image col l-4 m-4 c-12 no-margin">
        <div>
            <img src="{{asset('assets/image/home/edit.svg')}}" alt="">
            <p class="updata-form">{{ __('Identifies violations upon submission') }}</p>
        </div>
    </div>
    <div class="background__image col l-4 m-4 c-12 no-margin">
        <div>
            <img src="{{asset('assets/image/home/auction.svg')}}" alt="">
            <p class="updata-form">{{ __('Provides data and evidence form research and policy advocacy') }}</p>
        </div>
    </div>
</div>
@endsection
<script>


</script>
