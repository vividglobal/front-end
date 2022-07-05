
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
                <div class="table-code-top">
                    <h2>VIVID</h2>
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

                </div>
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
            <div class="table-code">
                <div class="table-code-top">
                    <h2>Supervisor</h2>
                    @if(isset($article->detection_result['violation_code']))
                    <?php
                        $botStatus = count($article->detection_result['violation_code']) > 0 && isset($article->detection_result['violation_code'])
                        ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                    ?>
                    @endif
                    <p
                        @class([
                            'status-title',
                            'reviewing-color'   => isPendingStatus($article->supervisor_review['status']),
                            'violation-color'   => isViolationStatus($article->supervisor_review['status']),
                            'unviolation-color' => isNoneViolationStatus($article->supervisor_review['status'])
                        ])
                        data-status="{{$article->supervisor_review['status']}}"
                        >{{ getStatusText($article->supervisor_review['status']) }}</p>
                </div>
            </div>


            <div class="table-code">
                <div class="table-code-top">
                    <h2>Operator</h2>
                    @if(isset($article->detection_result['violation_code']))
                    <?php
                        $botStatus = count($article->detection_result['violation_code']) > 0 && isset($article->detection_result['violation_code'])
                        ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                    ?>
                    @endif
                    <p
                        @class([
                            'status-title',
                            'reviewing-color'   => isPendingStatus($article->operator_review['status']),
                            'violation-color'   => isViolationStatus($article->operator_review['status']),
                            'unviolation-color' => isNoneViolationStatus($article->operator_review['status'])
                        ])
                        data-status="{{$article->operator_review['status']}}"
                    >{{ getStatusText($article->operator_review['status']) }}</p>
                </div>

                @if(($article->operator_review['status'] === "VIOLATION") && isRole(ROLE_OPERATOR))
                    <div class="table-code-aticle">
                        <img class="img-icon-detail" src="{{ asset('assets/image/dis-code.png') }}" alt="">
                        <div>
                            @if(isset($article->detection_result['violation_code']))
                                <h4 class="p-style">Code article</h4>
                                @foreach ($article->detection_result['violation_code'] as $detectionCode)
                                    <div>
                                        <h4 class="p-style" href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
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
                                        <div class="color-circle" style="background: #6F6F6F;"></div>
                                    </div>
                                    <h4 class="p-style">{{$detectionType['name'] ?? ''}}</h4>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @else
                    <h1 class="not-yet-opera">Not yet rated</h1>
                @endif
            </div>

            <div class="table-code-buton">
                <div class="btn-violation">
                    <h2>Confirm violation status</h2>
                </div>
                <div class="btn-non-violation">
                    <h2>Confirm non-violation status</h2>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal-title-mobile" id="confirm-violation"> 
    <div class="modal-confirm-content-mobile">
        <div class="div-close">
            <span class="close">&times;</span>
        </div>
        <div class="head-modal">
            <h1>{{ __('Are you sure?') }}</h1>
        </div>
        <p class="title-modal" style="text-align: center;display: block;">
            {{ __("When you choose this status, you have to verify violation code.") }}
        </p>
        <div class="head-confirm-btn">
            <button class="confirm-btn btn-cancel close">Cancel</button>
            <button class="confirm-btn btn-confirm-violation-and-choose-code btn-confirm-style" id="confirm-violation">{{ __('Yes') }}</button>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/pages/article-detail.js')}}"></script>
@endsection
