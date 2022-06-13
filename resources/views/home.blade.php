@extends('layouts.app')
@section('title',  config('app.name', 'Laravel'))
@section('description', config('app.name', 'Laravel'))
@section('content')
<link href="{{ asset('assets/css/home/style.css') }}" rel="stylesheet">

<div class="vituar_validation grid wide">
    <div class="content__vituar">
        <p>Virtual Violations Detectors</p>
        <p>VIVID is an automated solution that uses artificial intelligence
            and supervised machine learning to detect commercial violations on digital platforms.
        </p>
        <button id="btn_explore">Explore</button>
    </div>
</div>
<div class="background__vituar-2 rows ">
        <div class="background__content col l-6">
            <p>BACKGROUND AND NEEDS</p>
            <p>Digital marketing accounts for 70% total spending for marketing;
                32% mothers report seeing breast-milk substitutes marketing on social media,
                which is prohibited according to Advertisement Law 2012 and Decree 100/2014/ND-CP.
            </p>
        </div>
        <div class="background__image col l-6">
            <img src="../assets/image/home/img-2.svg" alt="">
        </div>
</div>
<div class=" background__vituar-3 grid wide ">
        <div class="rows no-gutters">
            <div class="background__image col l-6" >
                <img src="../assets/image/home/img-3.jpg" alt="" style="width:100%">
            </div>
            <div class="background__content col l-6">
                <p>BACKGROUND AND NEEDS</p>
                <p>Digital marketing accounts for 70% total spending for marketing;
                    32% mothers report seeing breast-milk substitutes marketing on social media,
                    which is prohibited according to Advertisement Law 2012 and Decree 100/2014/ND-CP.
                </p>
            </div>
        </div>
</div>
<div class="background__vituar-4">
            <p>Realizing the situation with a high frequency of errors,
                 the Ministry of Health, the Ministry of Information and
                 Communications with the support of the Alive & Thrive have built this automatic detection solution.
            </p>
</div>
<div class="background__vituar-5 rows">
        <div class="background__image col-6">
            <img src="../assets/image/home/A&T.png" alt="">
        </div>
        <div class="background__image col-6">
            <img src="../assets/image/home/hekate.png" alt="">
        </div>
</div>
<div class="background__vituar-6">
    <p>FUNCTIONS</p>
</div>
<div class="background__vituar-7 rows">
    <div class="background__image col l-4">
        <img src="../assets/image/home/face-detection.svg" alt="">
        <p>Auto-detecting Code violations 24/7</p>
    </div>
    <div class="background__image col l-4">
        <img src="../assets/image/home/edit.svg" alt="">
        <p>Auto-detecting Code violations 24/7</p>
    </div>
    <div class="background__image col l-4">
        <img src="../assets/image/home/auction.svg" alt="">
        <p>Auto-detecting Code violations 24/7</p>
    </div>
</div>
@endsection
<script>


</script>
