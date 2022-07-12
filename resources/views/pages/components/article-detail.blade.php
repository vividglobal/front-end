
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
                        <h4 class="h4-title">{{date("m-d-Y",$article->published_date)}}</h4>
                    </div>
                </li>
                <li class="detail-infoi">
                    <img class="img-icon-detail" src="{{ asset('assets/image/date.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Crawl date</h4>
                        <h4 class="h4-title">{{date("m-d-Y",$article->crawl_date)}}</h4>
                    </div>
                </li>
            </ul>
            <p class="detail-content">
                {{$article -> caption}}
            </p>
            <h3 class="title-style">Violation checking</h3>

            {{-- ======================================== --}}
            {{-- ================= VIVID ================ --}}
            {{-- ======================================== --}}
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
                            'bot-status',
                            'status-title',
                            'violation-color'   => isViolationStatus($botStatus),
                            'unviolation-color' => isNoneViolationStatus($botStatus)
                        ])
                        data-status="{{$botStatus}}"
                    >{{getStatusText($botStatus)}}</p>
                </div>
                @if(($article->detection_result['violation_code']))
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
                @endif
            </div>
            {{-- ==================================================== --}}
            {{-- ================= SUPERVISOR COLUMN ================ --}}
            {{-- ==================================================== --}}
            <div class="table-code" id="table-add">
                @if(getStatusText($article->supervisor_review['status'])!== 'Reviewing')
                    <div id="table-box">
                        <div class="table-code-top" id="violation-code-item">
                            <h2>Supervisor</h2>
                            @if(isset($article->supervisor_review['violation_code']))
                            <?php
                                $botStatus = count($article->detection_result['violation_code']) > 0 && isset($article->detection_result['violation_code'])
                                ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                            ?>
                            <p
                                @class([
                                    'status-title',
                                    'reviewing-color'   => isPendingStatus($article->supervisor_review['status']),
                                    'violation-color'   => isViolationStatus($article->supervisor_review['status']),
                                    'unviolation-color' => isNoneViolationStatus($article->supervisor_review['status'])
                                ])
                                data-status="{{$article->supervisor_review['status']}}"
                                >{{ getStatusText($article->supervisor_review['status']) }}
                            </p>
                        </div>
                        @endif
                        @if($article->supervisor_review['violation_code'])
                        <div class="table-code-aticle">
                            <img class="img-icon-detail" src="{{ asset('assets/image/dis-code.png') }}" alt="">
                            <div>
                                @if(isset($article->supervisor_review['violation_code']))
                                    <h4 class="p-style">Code article</h4>
                                    @foreach ($article->supervisor_review['violation_code'] as $detectionCode)
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
                            @if(isset($article->supervisor_review['violation_types']))
                                @foreach ($article->supervisor_review['violation_types'] as $detectionType)
                                    <div style="display: flex;align-items: center;">
                                        <div class="color-circle-big" >
                                            <div class="color-circle" style="background: #6F6F6F;"></div>
                                        </div>
                                        <h4 class="p-style">{{$detectionType['name'] ?? ''}}</h4>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @endif
                    </div>
                    @elseif((isPendingStatus($article->supervisor_review['status']) || isViolationStatus($article->supervisor_review['status'])) && !isRole(ROLE_SUPERVISOR)
                    && count($article->supervisor_review['violation_code']) === 0)
                    <div id="table-box">
                        <div class="table-code-top" id="violation-code-item">
                            <h2>Supervisor</h2>
                            <p class="status-title reviewing-color" data-status="PENDING">Reviewing</p>
                        </div>
                    </div>
                @endif
            </div>
            {{-- ==================================================== --}}
            {{-- ================= OPERATOR COLUMN ================== --}}
            {{-- ==================================================== --}}
            @if(isRole(ROLE_OPERATOR))
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
            @endif
        </div>
        <div id="table-code-buton-all" class="table-button-all">
            <div class="table-code-buton" id="table-code-buton-supervisor">
                @if(isPendingStatus($article->supervisor_review['status']))
                    <div data-id="{{ $article->_id }}" attr-status="AGREE" class="check-true check-status btn-violation">
                        <h2>Agree with VIVID’s status</h2>
                    </div>
                    <div data-id="{{ $article->_id }}" attr-status="DISAGREE" class="check-false check-status btn-non-violation">
                        <h2>Disagree with VIVID’s status</h2>
                    </div>
                @elseif(isViolationStatus($article->supervisor_review['status']) && !($article->supervisor_review['violation_code'])
                && ($article->supervisor_review['status'])==='VIOLATION' && ($article->detection_result['status'])==='NON_VIOLATION')
                    <div data-id="{{ $article->_id }}" attr-status="AGREE" class="check-true add-violation-code btn-violation btn-violation-code">
                        <h2>Select code article</h2> 
                    </div>
                @elseif(($article->supervisor_review['status'])==='VIOLATION' && ($article->detection_result['status'])==='VIOLATION' 
                && !$article->supervisor_review['violation_code'])
                    <div data-id="{{ $article->_id }}" attr-status="AGREE" class="check-true check-violation-code btn-violation">
                        <h2>Agree code article</h2>
                    </div>
                    <div data-id="{{ $article->_id }}" attr-status="DISAGREE" class="check-false add-violation-code  btn-non-violation">
                        <h2>Reselect code article</h2>
                    </div>
                @endif
            </div>
        </div>
</div>

<div class="modal-title-mobile" id="confirmActionModal"> 
    <div class="modal-confirm-content-mobile">
        <div class="div-close">
            <span class="close">&times;</span>
        </div>
        <div class="head-modal">
            <h1>{{ __('Are you sure?') }}</h1>
        </div>
        <p class="title-modal" style="text-align: center;display: block;">
            {{ __("When you choose this, you can not change it in the future.") }}
        </p>
        <div class="head-confirm-btn">
            <button class="confirm-btn btn-cancel close">Cancel</button>
            <button class="confirm-btn  btn-confirm-style btn-confirm-non-violation" id="confirm-yes">{{ __('Yes') }}</button>
        </div>
    </div>
</div>


<div class="modal-title-mobile" id="confirmActionModal-violation"> 
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
            <button class="confirm-btn btn-confirm-style btn-confirm-violation" id="confirm-yes">{{ __('Yes') }}</button>
        </div>
    </div>
</div>



<div class="modal-title-mobile" id="confirmArticleAsViolation"> 
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
            <button class="confirm-btn  btn-confirm-style btn-confirm-violation-and-choose-code" id="confirm-yes">{{ __('Yes') }}</button>
        </div>
    </div>
</div>


<div class="open-modal-mobile-code">
    <div class="modal-title-mobile-code" id="selectCodeModalMobile">
        <div class="modal-content-mobile-code">
            <div class="lish-top">
                <img class="close" src="{{ asset('assets/image/back.png') }}" alt="">
                <h1 class="lish-title-style">{{ __('Reset code article')}}</h1>
            </div>
            <div class="search_code_article">
                <img src="{{ asset('assets/image/search.svg') }}" alt="search" class="btn-search">
                <input type="text" placeholder="Search for violation code" class="search">
            </div>
            <div class="row">
                @foreach($violationCode as $key => $code)
                <div class="col-md-1 check__box">
                    <div class="checkbox-code">
                        <label class="check_box_code">
                            <input id="id-function-code" type="checkbox" name="violation_code[]"  value={{ $code->id }}>
                            <span class="checkmark_code"></span>
                            {{ $code->name }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="btn-confirm btn-confirm-mobile">
            <button class="confirm-btn btn-cancel close">Cancel</button>
            <button class="confirm-btn btn-select-code btn-confirm-style" id="">{{ __('Apply') }}</button>
        </div>
    </div>
</div>



<script>
    let STATUS_VIOLATION = '{{ STATUS_VIOLATION }}';
    let STATUS_NONE_VIOLATION = '{{ STATUS_NONE_VIOLATION }}';
    let AGREE = '{{ AGREE }}';
    let DISAGREE = '{{ DISAGREE }}';
    let ACTION_CHECK_STATUS = '{{ ACTION_CHECK_STATUS }}';
    let ACTION_CHECK_CODE = '{{ ACTION_CHECK_CODE }}';
    let csrf = "{{ csrf_token() }}";
    let CURRENT_ROLE = "{{ getRole() }}";
    let SUPERVISOR_ROLE = "{{ ROLE_SUPERVISOR }}";
    let OPERATOR_ROLE = "{{ ROLE_OPERATOR }}";
</script>
<script src="{{ asset('assets/js/pages/article-detail.js')}}"></script>
@endsection
