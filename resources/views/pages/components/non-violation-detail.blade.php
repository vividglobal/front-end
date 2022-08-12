@extends('layouts.app')

@section('content')

<div class="container-table container-table-mobile" id="div-moblie">
    <div class="container-row-mobile">
        <div class="list-child">
            <div class="lish-top">
                <img class="history-back" src="{{ asset('assets/image/back.png') }}" alt="">
                <h1 class="lish-title-style">{{ __($article->brand['name'] ?? '' )}}</h1>
            </div>
            @if($article->image)
                @if(isset($article->gallery))
                <div class="slideshow-container">
                    @foreach ($article->gallery as $detectionCode)
                    <div class="mySlides fadeimg">
                        <div style="display: flex;justify-content: center;">
                        <img  src={{($detectionCode)}} style="max-width: 88%;margin-bottom: 15px;max-height: 350px;">
                        </div>
                    </div>
                    @endforeach
                </div>
                @if(count($article->gallery) > 1)
                    <a class="prevslide mobleprevnext" onclick="plusSlides(-1)">❮</a>
                    <a class="nextslide mobleprevnext" onclick="plusSlides(1)">❯</a>
                @endif
                @else
                <img  src={{ __($article->image ?? '' ) }} style="max-width: 100%;margin-bottom: 15px;">
                @endif
            @else
            <img  style="width:100%;margin-bottom: 15px;"  src="{{ asset('assets/image/no-image.jpeg') }}" >
            @endif
            <div class="media-body-top">
                @if(isset($article->detection_result['violation_code']))
                    <?php
                        $botStatus = count($article->detection_result['violation_code']) > 0 && isset($article->detection_result['violation_code'])
                        ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                    ?>
                    @endif
                    <p class="status-title unviolation-color" data-status="NON_VIOLATION">Unable to detect</p>
                <div class="media-link" id="copy-link"  link-copy={{$article -> link ?? '' }}>
                    <img src="{{ asset('assets/image/link_dark_gray.svg') }}" alt="">
                    <p>Copy URL</p>
                </div>
            </div>
            <ul class="detail-info">
                <li class="detail-infoi detail-infoi-left">
                    <a href="{{ url()->previous() }}">
                        <img  class="img-icon-detail" src="{{ asset('assets/image/tem.png') }}" alt="">
                    </a>
                    <div>
                        <h4 class="p-style">Company</h4>
                        <h4 class="h4-title">{{ __($article->company['name'] ?? '' )}}</h4>
                    </div>
                </li>
                <li class="detail-infoi detail-infoi-right">
                    <img class="img-icon-detail" src="{{ asset('assets/image/td.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Country</h4>
                        <h4 class="h4-title">{{ __($article->country['name'] ?? '' )}}</h4>
                    </div>
                </li>
                <li class="detail-infoi detail-infoi-left">
                    <img class="img-icon-detail" src="{{ asset('assets/image/date.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Published date</h4>
                        @isset($article->published_date)
                        <h4 class="h4-title">{{date("m-d-Y",$article->published_date)}}</h4>
                        @endisset
                    </div>
                </li>
                <li class="detail-infoi detail-infoi-right">
                    <img class="img-icon-detail" src="{{ asset('assets/image/date.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Review date</h4>
                        <h4 class="h4-title">{{date("m-d-Y",$article->operator_review['review_date'] )}}</h4>
                    </div>
                </li>
            </ul>
            <div style="overflow-wrap: break-word;">
                <p class="detail-content">
                    {{$article -> caption}}
                </p>
            </div>
            @if(isRole(ROLE_OPERATOR))
            <h3 class="title-style title-style-checking">Violation checking</h3>
            @endif
        </div>
        @if(isRole(ROLE_OPERATOR))
        <div class="list-child-function">
            <div class="list-child-top">
                <h3 class="title-style status-leal">Switch status</h3>
                <img  class="td-link btn-switch-mobile" src="{{asset('assets/image/switch-mobile.png')}}" alt="#" data-id={{$article->_id }}  data-type={{$article->detection_type}}>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="modal-confirm-title modal-confirm-title-mobile">
    <div class="modal-confirm-content modal-confirm-content-mobile">
        <div class="head-confirm" id="content_status_progress">
            <h1>Confirmation</h1>
            <p style="text-align: center;" class="title-modal-style"></p>
        </div>
        <div class="head-confirm-btn">
            <button class="confirm-btn btn-cancel close button-cancel-style">Cancel</button>
            <button class="confirm-btn btn-yes" id="confirm-mobile">Confirm</button>
        </div>
    </div>
</div>

@push('styles')
    <link href="{{ asset('assets/css/autodetect/article-detail-desktop.css') }}" rel="stylesheet">
@endpush
<!-- <script src="{{ asset('assets/js/autodetect/modal.js') }}"></script> -->
<script src="{{ asset('assets/js/btn_select/selectStatus.js') }}"></script>
<script src="{{ asset('assets/js/query/queryData.js') }}"></script>
<script src="{{ asset('assets/js/pages/non-violationn-detaill.js')}}"></script>
<script src="{{ asset('assets/js/pages/slineimg.js') }}"></script>
@endsection