
@extends('layouts.app')

@section('content')

<div class="container-table" id="div-moblie">
    <div class="container-row-mobile">
        <div class="list-child">
            <div class="lish-top">
                <img class="history-back" src="{{ asset('assets/image/back.png') }}" alt="">
                <h1 class="lish-title-style">{{ __($article->brand['name'] ?? '' )}}</h1>
            </div>
            <img src={{ __($article->image ?? '' ) }} alt="" style="width:100%;margin-bottom: 15px;">
            <div class="media-body-top">
                @if(isset($article->detection_result['violation_code']))
                    <?php
                        $botStatus = count($article->detection_result['violation_code']) > 0 && isset($article->detection_result['violation_code'])
                        ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                    ?>
                    @endif
                    <p
                        @class([
                            'status-title',
                            'violation-color'   => isViolationStatus($botStatus),
                            'unviolation-color' => isNoneViolationStatus($botStatus)
                        ])
                        data-status="{{$botStatus}}"                   
                    >{{getStatusText($botStatus)}}</p>
                <div class="media-link">
                    <img src="{{ asset('assets/image/ico_link_enable.svg') }}" alt="">
                    <p>Copy URL</p>
                </div>
            </div>
            <ul class="detail-info">
                <li class="detail-infoi">
                    <a href="{{ url()->previous() }}">
                        <img  class="img-icon-detail" src="{{ asset('assets/image/tem.png') }}" alt="">
                    </a>
                    <div>
                        <h4 class="p-style">Company</h4>
                        <h4 class="h4-title">{{ __($article->company['name'] ?? '' )}}</h4>
                    </div>
                </li>
                <li class="detail-infoi">
                    <img class="img-icon-detail" src="{{ asset('assets/image/td.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Country</h4>
                        <h4 class="h4-title">{{ __($article->country['name'] ?? '' )}}</h4>
                    </div>
                </li>
                <li class="detail-infoi">
                    <img class="img-icon-detail" src="{{ asset('assets/image/date.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Published date</h4>
                        <h4 class="h4-title">{{date("d/m/Y",$article->published_date)}}</h4>
                    </div>
                </li>
                <li class="detail-infoi">
                    <img class="img-icon-detail" src="{{ asset('assets/image/date.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Crawl date</h4>
                        <h4 class="h4-title">{{date("d/m/Y",$article->crawl_date)}}</h4>
                    </div>
                </li>
            </ul>
            <p class="detail-content">
                {{$article -> caption}}
            </p>
            <h3 class="title-style">Violation checking</h3>
            <div class="table-code">
                <div class="table-code-aticle">
                    <img class="img-icon-detail" src="{{ asset('assets/image/code.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Code article</h4>
                        @if(isset($article->detection_result['violation_code']))
                        @foreach ($article->detection_result['violation_code'] as $detectionCode)
                            <div>
                                <h4 class="h4-title" href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
                                    {{$detectionCode['name'] ?? ''}}
                                </h4>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="table-code-tile">
                    @if(isset($article->detection_result['violation_types']))
                        @foreach ($article->detection_result['violation_types'] as $detectionType)
                            <div style="display: flex;align-items: center;">
                                <div class="color-circle-big" >
                                    <div class="color-circle" style="background-color:{{$detectionType['color'] ?? ''}}"></div>
                                </div>
                                <h4 class="p-style">{{$detectionType['name'] ?? ''}}</h4>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="up-file-mobile">
            <div class="body-upload">
                <p>Legal documents</p>
                <img src="{{ asset('assets/image/ico-upload.png') }}" alt="">
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal-upload-file"id="uploadModal">
    @if(isRole(ROLE_OPERATOR) || isRole(ROLE_SUPERVISOR))
        <div class="check-login" t-login="true"></div>
    @endif
    <div class="modal-content">
        <div class="head-modal">
            <h1 >Legal documents</h1>
        </div>
        <div class="modal-body">

        </div>
    </div>
</div> -->

<script src="{{ asset('assets/js/pages/article-detail.js') }}"></script>
@endsection