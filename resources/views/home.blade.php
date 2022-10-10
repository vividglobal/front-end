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
            <p>{{ __('BACKGROUND AND NEEDS') }}</p>
            <p class="updata-form">
                {{ __('Digital marketing accounts for 70% total spending for marketing;
                32% mothers report seeing breast-milk substitutes marketing on social media,
                which is prohibited according to Advertisement Law 2012 and Decree 100/2014/ND-CP.') }}
            </p>
        </div>
        <div class="background__image col l-6 m-6 c-12">
            <img src="{{asset('assets/image/home/img-2.svg')}}" alt="">
        </div>
</div>
<div class=" background__vituar-3 ">
        <div class="rows">
            <div class="background__image col l-6 m-6 c-12" >
                <img src="{{asset('assets/image/home/img-3.jpg')}}" alt="" style="width:100%">
            </div>
            <div class="background__content col l-6 m-6 c-12">
                <p>{{ __('PURPOSE') }}</p>
                <p class="updata-form">
                    {{ __('VIVID aims to become an effective virtual assistant for inspectors at the Ministry of Health and the Ministry of Information and
                        Communications, in order to support the implementation of Decree 70/2021/ND-CP and e-government roadmap.') }}
                </p>
            </div>
        </div>
</div>
<div class="background__vituar-4">
            <p class="updata-form">
                 {{ __('Realizing the situation with a high frequency of errors,
                 the Ministry of Health, the Ministry of Information and
                 Communications with the support of the Alive & Thrive have built this automatic detection solution.') }}
            </p>
</div>
<div class="background__vituar-5 rows">
        <div class="background__image col-6">
            <img src="{{asset('assets/image/home/A&T.svg')}}" alt="">
        </div>
        <div class="background__image col-6">
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
            <p class="updata-form">{{ __('Labelling Code violations upon requests') }}</p>
        </div>
    </div>
    <div class="background__image col l-4 m-4 c-12 no-margin">
        <div>
            <img src="{{asset('assets/image/home/auction.svg')}}" alt="">
            <p class="updata-form">{{ __('Tracing violations from detection to penalty') }}</p>
        </div>
    </div>
</div>
@endsection
<script>


</script>
