<div class="container-table" id="div-pc">
    <div class="container_row">
        <div class="col-left">
            @include('pages.components.table-left')
        </div>
        <div class="col-right col-right-form ">
            <table class="wrap">
                <div class="headers">
                    <div class="scroller syncscroll scroll_same_time" name="myElements">
                        <div class="track">
                            <div class=" heading th-title-right sort_public_date">
                                <p>{{ __('Published date') }}</p>
                                <span
                                    @class([
                                        'ico-sort theard-table sort_up',
                                        'disabled' => checkSort(request()->all(), 'published_date', ASC)
                                    ])></span>
                                <span
                                    @class([
                                        'ico-sort theard-table sort_down',
                                        'disabled' => checkSort(request()->all(), 'published_date', DESC)
                                    ])></span>
                            </div>
                        </div>
                        <div class="track">
                            <div class=" heading th-title-right sort_crawl_date">
                                <p>{{ __('Crawl date') }}</p>
                                <span
                                    @class([
                                        'ico-sort theard-table sort_up',
                                        'disabled' => checkSort(request()->all(), 'crawl_date', ASC)
                                    ])></span>
                                <span
                                    @class([
                                        'ico-sort theard-table sort_down',
                                        'disabled' => checkSort(request()->all(), 'crawl_date', DESC)
                                    ])></span>
                            </div>
                        </div>
                        <div class="track track-link">
                            <div class="heading"><p>{{ __('Link') }}</p></div>
                        </div>
                        <div class="track track-three">
                            <div class="heading-three"><p>{{ __('VIVID') }}</p></div>
                            <div class="heading-three-title">
                                <div class="th-title-right-three sort_bot_status">
                                    <p data-sort="bot_status"  class="status-title-p">{{ __('Status') }}</p>
                                    <span
                                        @class([
                                            'ico-sort theard-table sort_up',
                                            'disabled' => checkSort(request()->all(), 'bot_status', ASC)
                                        ])></span>
                                    <span
                                        @class([
                                            'ico-sort theard-table sort_down',
                                            'disabled' => checkSort(request()->all(), 'bot_status', DESC)
                                        ])></span>
                                </div>
                                <div class="th-title-right-three">
                                    <p>{{ __('Code article') }}</p>
                                </div>
                                <div class="th-title-right heading-three-violation">
                                    <p>{{ __('Violation type') }}</p>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user())
                        <div class="track track-three">
                            <div class="heading-three"><p>{{ __('Supervisor') }}</p></div>
                            <div class="heading-three-title">
                                <div class="th-title-right-three sort_supervisor">
                                    <p data-sort="supervisor_status" class="status-title-p">{{ __('Status') }}</p>
                                    <span
                                        @class([
                                            'ico-sort theard-table sort_up',
                                            'disabled' => checkSort(request()->all(), 'supervisor_status', ASC)
                                        ])></span>
                                    <span
                                        @class([
                                            'ico-sort theard-table sort_down',
                                            'disabled' => checkSort(request()->all(), 'supervisor_status', DESC)
                                        ])></span>
                                </div>
                                <div class="th-title-right-three">
                                    <p>{{ __('Code article') }}</p>
                                </div>
                                <div class="th-title-right heading-three-violation">
                                    <p>{{ __('Violation type') }}</p>
                                </div>
                            </div>
                        </div>
                        @if(isRole(ROLE_ADMIN) || isRole(ROLE_OPERATOR))
                        <div class="track track-three">
                            <div class="heading-three"><p>{{ __('Operator') }}</p></div>
                            <div class="heading-three-title">
                                <div class="th-title-right-three sort_operator">
                                    <p data-sort="operator_status" class="status-title-p">{{ __('Status') }}</p>
                                    <span
                                        @class([
                                            'ico-sort theard-table sort_up',
                                            'disabled' => checkSort(request()->all(), 'operator_status', ASC)
                                        ])></span>
                                    <span
                                        @class([
                                            'ico-sort theard-table sort_down',
                                            'disabled' => checkSort(request()->all(), 'operator_status', DESC)
                                        ])></span>
                                </div>
                                <div class="th-title-right-three">
                                    <p>{{ __('Code article') }}</p>
                                </div>
                                <div class="th-title-right heading-three-violation">
                                    <p>{{ __('Violation type') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                <div class="tracks syncscroll container-scroll scroll_same_time" name="myElements">
                    @foreach ($articles as $key => $article)
                        <div data-id="{{ $article->_id }}" class="scroll-table " >
                            <div class="track">
                                <div class="entry">
                                    @isset($article->published_date)
                                    <h3 class="updata-form">{{date("m-d-Y",$article->published_date)}}</h3>
                                    @endisset
                                </div>
                            </div>
                            <div class="track">
                                <div class="entry">
                                    <h3 class="updata-form">{{date("m-d-Y",$article->crawl_date)}}</h3>
                                </div>
                            </div>
                            <div class="track track-link">
                                <div class="entry">
                                    @if($article->link)
                                    <a target="_blank" href={{ __($article->link ?? '' )}} >
                                        <img class="td-link a-link" src="{{ asset('assets/image/link.png') }}" alt="">
                                    </a>
                                    @else
                                    <a class="onclick-link-check">
                                        <img class="td-link a-link" src="{{ asset('assets/image/link.png') }}" alt="">
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="track track-three">
                                <div class="entry-three">
                                    <div class="entry-title css_status">
                                        @if($article->detection_result !== null)
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
                                            >{{ getStatusText($botStatus)}}</p>
                                        @endif
                                    </div>
                                    <div class="style__code--article" style="display:block;justify-content:@if(count($article->detection_result['violation_code']) < 7) center @endif">
                                        @if(isset($article->detection_result['violation_code']))
                                        @foreach ($article->detection_result['violation_code'] as $detectionCode)
                                            <div id={{ $detectionCode['id'] }} value={{ $detectionCode['id'] }}>
                                                <a class="updata-form" href="javascript:void(0)" id={{ $detectionCode['id'] }}>
                                                    {{$detectionCode['name'] ?? ''}}
                                                </a>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle bot-violation-code style_violation_type" style="justify-content:@if(count($article->detection_result['violation_types']) > 5) flex-start @endif">
                                        @foreach ($article->bot_violation_types as $detectionType)
                                            <a class="updata-form" href="javascript:void(0)" id={{ $detectionType->_id }}
                                            style="color:{{$detectionType->color ?? ''}};text-decoration:none;line-height: 20px">
                                                {{$detectionType->name ?? ''}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user())
                            {{-- ==================================================== --}}
                            {{-- ================= SUPERVISOR COLUMN ================ --}}
                            {{-- ==================================================== --}}
                            <div class="track track-three">
                                <div class="entry-three ">
                                    {{-- ==================================================== --}}
                                    {{-- ============== VIOLATION STATUS COLUMN ============= --}}
                                    {{-- ==================================================== --}}
                                    <div class="entry-title supervisor-violation-action">
                                        @if(isPendingStatus($article->supervisor_review['status']) && isRole(ROLE_SUPERVISOR))
                                            <div class="btn-status">
                                                <a attr-status={{AGREE}} class="check-true check-status" href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}} class="check-false check-status" href="javascript:void(0)"></a>
                                            </div>
                                        @else
                                            <div class="entry-title-threee entry-title-tyle reviewing-title alignt-item_center">
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
                                        @endif
                                    </div>
                                    {{-- ==================================================== --}}
                                    {{-- ============== VIOLATION CODE COLUMN =============== --}}
                                    {{-- ==================================================== --}}
                                    <div class="entry-title supervisor-violation-code ">
                                        @if(isPendingStatus($article->supervisor_review['status']) && isRole(ROLE_SUPERVISOR))
                                            <div class="btn-status">
                                                <a attr-status={{AGREE}} class="check-true-disabled check-violation-code" href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}} class="check-false-disabled check-violation-code" href="javascript:void(0)"></a>
                                            </div>
                                        @elseif(isViolationStatus($article->supervisor_review['status']) && isRole(ROLE_SUPERVISOR)
                                                && count($article->supervisor_review['violation_code']) === 0)
                                            <div class="btn-status">
                                                <a attr-status={{AGREE}} class="check-true check-violation-code" href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}} class="check-false-disabled check-violation-code" href="javascript:void(0)"></a>
                                            </div>
                                        @else
                                            <div class="style__code--article" style="width:100%;justify-content:@if(count($article->supervisor_review['violation_code']) < 7) center @endif">
                                                @if((isPendingStatus($article->supervisor_review['status']) || isViolationStatus($article->supervisor_review['status'])) && !isRole(ROLE_SUPERVISOR)
                                                && count($article->supervisor_review['violation_code']) === 0)
                                                    <div class="entry-title-threee entry-title-tyle reviewing-title alignt-item_center">
                                                        <p
                                                            class="status-title reviewing-color"
                                                        >{{ 'Reviewing' }}</p>
                                                    </div>
                                                @else
                                                    @foreach ($article->supervisor_review['violation_code'] as $detectionCode)
                                                        <div>
                                                            <a class="updata-form" href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
                                                                {{$detectionCode['name'] ?? ''}}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle supervisor-violation-type style_violation_type" style="justify-content:@if(count($article->supervisor_review['violation_types']) >= 5) flex-start @endif">
                                        @foreach ($article->supervisor_violation_types as $supervisorType)
                                        <div>
                                            <a class="detectiontype updata-form" href="{{ getUrlName( "violation_type_id" , $supervisorType->_id ) }}" id={{ $supervisorType->_id }} style="color:{{ $supervisorType->color ?? ''}}">{{ $supervisorType->name ?? '' }}</a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- ==================================================== --}}
                            {{-- ================= OPERATOR COLUMN ================== --}}
                            {{-- ==================================================== --}}
                            @if(isRole(ROLE_ADMIN) || isRole(ROLE_OPERATOR))
                            <div class="track track-three">
                                <div class="entry-three">
                                    {{-- ==================================================== --}}
                                    {{-- ============== VIOLATION STATUS COLUMN ============= --}}
                                    {{-- ==================================================== --}}
                                    <div class="entry-title operator-violation-action">
                                        @if(isPendingStatus($article->operator_review['status']) && isRole(ROLE_OPERATOR))
                                            <div class="btn-status">
                                                <a attr-status={{AGREE}} class="check-true check-status" href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}} class="check-false check-status" href="javascript:void(0)"></a>
                                            </div>
                                        @else
                                            <div class="entry-title-threee entry-title-tyle reviewing-title">
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
                                        @endif
                                    </div>
                                    {{-- ==================================================== --}}
                                    {{-- ============== VIOLATION CODE COLUMN =============== --}}
                                    {{-- ==================================================== --}}
                                    <div class="entry-title operator-violation-code">
                                        @if(isPendingStatus($article->operator_review['status']) && isRole(ROLE_OPERATOR))
                                            <div class="btn-status">
                                                <a attr-status={{AGREE}} class="check-true-disabled check-violation-code" href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}} class="check-false-disabled check-violation-code" href="javascript:void(0)"></a>
                                            </div>
                                        @elseif(isViolationStatus($article->operator_review['status']) && isRole(ROLE_OPERATOR)
                                            && count($article->operator_review['violation_code']) === 0)
                                            <div class="btn-status">
                                                <a attr-status={{AGREE}} class="check-true check-violation-code " href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}}
                                                    class="check-violation-code dishable_overlay
                                                    {{ isViolationStatus($article->operator_review['status'])
                                                        && count($article->detection_result['violation_code']) > 0
                                                        ? 'check-false' : 'check-false-disabled'
                                                    }}"
                                                    href="javascript:void(0)"></a>
                                            </div>
                                        @else
                                            <div class="style__code--article" style="width:100%;justify-content:@if(count($article->operator_review['violation_code']) < 7) center @endif">
                                                @if((isPendingStatus($article->operator_review['status']) || isViolationStatus($article->operator_review['status'])) && !isRole(ROLE_OPERATOR)
                                                && count($article->operator_review['violation_code']) === 0)
                                                    <div class="entry-title-threee entry-title-tyle reviewing-title alignt-item_center">
                                                        <p
                                                            class="status-title reviewing-color"
                                                        >{{ 'Reviewing' }}</p>
                                                    </div>
                                                @else
                                                    @foreach ($article->operator_review['violation_code'] as $detectionCode)
                                                        <div>
                                                            <a class="updata-form" href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
                                                                {{$detectionCode['name'] ?? ''}}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle operator-violation-type style_violation_type">
                                        @foreach ($article->operator_violation_types as $operatorType)
                                            <p class="updata-form" style="color:{{ $operatorType->color ?? ''}}">{{ $operatorType->name ?? '' }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </table>
        </div>
    </div>
    @if(count($articles) == 0)
        @include('noSearchResult/index')
    @endif

    <div class="paginate_showing">
        @if(count($articles) > 0)
            <div style="margin-top:20px">
                @include('pages/components/query', ['list_filter' => ["showing"], 'show_all_filter' => false])
            </div>
        @endif
        <div class="row-pagination">
            {{ $articles->onEachSide(1)->links('layouts.my-paginate')}}
        </div>
    </div>


    <div class="modal-title open-modal" id="confirmActionModal">
        <div class="modal-confirm-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1>{{ __('Confirmation') }}</h1>
            </div>
            @if(isRole(ROLE_SUPERVISOR))
                <p class="title-modal title-modal-style" style="text-align: center;display: block;">
                {{ __("Are you sure to define this post's status unable to detect?")}}
                </p>
                <p class="title-modal title-modal-watching" style="text-align: center;display: block;">
                    {{__("* You cannot change your decision in the future")}}
                </p>
            @else
                <p class="title-modal title-modal-style" style="text-align: center;display: block;">
                    {{ __("Are you sure to move this post to the unable to detect list?") }}
                </p>
            @endif
            <div class="head-confirm-btn">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-confirm-non-violation btn-confirm-style" id="confirm-yes">{{ __('Confirm') }}</button>
            </div>
        </div>
    </div>

    <div class="modal-title open-modal" id="confirmActionModal-violation">
        <div class="modal-confirm-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1>{{ __('Confirmation') }}</h1>
            </div>
            @if(isRole(ROLE_SUPERVISOR))
                <p class="title-modal title-modal-style" style="text-align: center;display: block;">
                    {{ __("Are you sure to define this post's status violation?")}}
                </p>
                <p class="title-modal title-modal-watching" style="text-align: center;display: block;">
                    {{__("* Please re-check the violation code for this post")}}
                </p>
            @else
                <p class="title-modal title-modal-style" style="text-align: center;display: block;">
                    {{ __("Are you sure to define this post's status violation?")}}
                </p>
            @endif
            <div class="head-confirm-btn">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-confirm-violation btn-confirm-style" id="confirm-yes">{{ __('Confirm') }}</button>
            </div>
        </div>
    </div>

    <div class="modal-title open-modal" id="confirmArticleAsViolation">
        <div class="modal-confirm-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1>{{ __('Confirmation') }}</h1>
            </div>
                @if(isRole(ROLE_SUPERVISOR))
                        <p class="title-modal title-modal-style" style="text-align: center;display: block;">
                            {{ __("Are you sure to define this post's status violation?")}}
                        </p>
                        <p class="title-modal title-modal-watching" style="text-align: center;display: block;">
                            {{__("* You need to verify the violation code for this post and cannot change your decision in the future")}}
                        </p>
                @else
                        <p class="title-modal title-modal-style" style="text-align: center;display: block;">
                            {{ __("Are you sure to define this post's status violation?")}}
                        </p>
                @endif
            <div class="head-confirm-btn">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-confirm-violation-and-choose-code btn-confirm-style" id="confirm-yes">{{ __('Confirm') }}</button>
            </div>
        </div>
    </div>




    <div class="modal-title open-modal" id="selectCodeModal">
        <div class="modal-content modal-content-code chosee-code-style">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1 class="fix_heade_modal">{{ __('Choose violation code') }}</h1>
            </div>
            <div class="search_code_article">
                <img src="{{ asset('assets/image/search.svg') }}" alt="search" class="btn-search img-style-focus">
                <input type="text" placeholder="Search for violation code" class="search input-style-focus">
            </div>
            <div class="row" style="overflow-y: auto">
                @foreach($violationCode as $key => $code)
                <div class="col-md-4 check__box" id={{ $code->id }}>
                    <div class="checkbox-code">
                        <label class="check_box_code">
                            <input type="checkbox" name="violation_code[]" value={{ $code->id }}>
                            <span class="checkmark_code"></span>
                            {{ $code->name }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="btn-confirm">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-select-code btn-confirm-style" id="">{{ __('Save change') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container-table container-table-mobile" id="div-moblie">
    <ul class="container-row-mobile">
        @foreach ($articles as $key => $article)
        <li class="lish-body">
            <a href="/articles/{{$article->_id}}/details" style="text-decoration: none;">
                <div class="lish-child">
                    <div class="media-img">
                        @if($article->image)
                        <img src={{ __($article->image ?? '' ) }} class="mr-3" style="width:100px;max-height:100px" alt="">
                        @else
                        <img  src="{{ asset('assets/image/no-image.jpeg') }}" class="mr-3" style="width:100px">
                        @endif
                    </div>
                    
                    <div class="media-body">
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
                            @isset($article->published_date)
                            <p class="p-style">{{date("m-d-Y",$article->published_date)}}</p>
                            @endisset
                        </div>
                        <h3 class="title-style">{{ __($article->brand['name'] ?? '' )}}</h3>
                        <h4 class="p-style">{{ __($article->company['name'] ?? '' )}}</h4>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    @if(count($articles) == 0)
        @include('noSearchResult/index')
    @endif
    <div class="row-pagination">
    {{ $articles->onEachSide(1)->links('layouts.my-paginate')}}
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
<script src="{{ asset('assets/js/pages/article-action.js') }}"></script>
<link href="{{ asset('assets/css/modal/modalCode.css') }}" rel="stylesheet">
