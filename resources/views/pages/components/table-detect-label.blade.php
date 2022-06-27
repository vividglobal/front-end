<div class="container-table" id="div-pc">
    <div class="container_row">
        <div class="col-left">
            @include('pages.components.table-left')
        </div>
        <div class="col-right col-right-form ">
            <table class="wrap">
                <div class="headers">
                    <div class="scroller syncscroll" name="myElements">
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
                        <div class="track">
                            <div class="heading"><p>{{ __('Link') }}</p></div>
                        </div>
                        <div class="track track-three">
                            <div class="heading-three"><p>{{ __('VIVID') }}</p></div>
                            <div class="heading-three-title">
                                <div class="th-title-right-three sort_bot_status">
                                    <p data-sort="bot_status" >{{ __('Status') }}</p>
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
                                    <p data-sort="supervisor_status">{{ __('Status') }}</p>
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
                        @if(@Auth::user()->role === "OPERATOR")
                        <div class="track track-three">
                            <div class="heading-three"><p>{{ __('Operator') }}</p></div>
                            <div class="heading-three-title">
                                <div class="th-title-right-three sort_operator">
                                    <p data-sort="operator_status">{{ __('Status') }}</p>
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
                <div class="tracks syncscroll container-scroll" name="myElements">
                    @foreach ($articles as $key => $article)
                        <div data-id="{{ $article->_id }}" class="scroll-table" >
                            <div class="track">
                                <div class="entry">
                                    <h3>{{date("d/m/Y",$article->published_date)}}</h3>
                                </div>
                            </div>
                            <div class="track">
                                <div class="entry">
                                    <h3>{{date("d/m/Y",$article->crawl_date)}}</h3>
                                </div>
                            </div>
                            <div class="track">
                                <div class="entry">
                                    <a href={{ __($article->link ?? '' )}} target="_blank"><img class="td-link a-link" src="../assets/image/link.png" alt=""></a>
                                </div>
                            </div>
                            <div class="track track-three">
                                <div class="entry-three">
                                    <div class="entry-title css_status">
                                        @if(isset($article->detection_result['violation_code']))
                                        <?php
                                            $botStatus = count($article->detection_result['violation_code']) > 0
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
                                        >{{ getStatusText($botStatus) }}</p>
                                    </div>
                                    <div class="style__code--article">
                                        @if(isset($article->detection_result['violation_code']))
                                        @foreach ($article->detection_result['violation_code'] as $detectionCode)
                                            <div>
                                                <a href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
                                                    {{$detectionCode['name'] ?? ''}}
                                                </a>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle bot-violation-code">
                                        @if(isset($article->detection_result['violation_types']))
                                        @foreach ($article->detection_result['violation_types'] as $detectionType)
                                            <p style="color:{{$detectionType['color'] ?? ''}}">{{$detectionType['name'] ?? ''}}</p>
                                        @endforeach
                                        @endif
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
                                                >{{ getStatusText($article->supervisor_review['status']) }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    {{-- ==================================================== --}}
                                    {{-- ============== VIOLATION CODE COLUMN =============== --}}
                                    {{-- ==================================================== --}}
                                    <div class="entry-title supervisor-violation-code">
                                        @if(isPendingStatus($article->supervisor_review['status']) && isRole(ROLE_SUPERVISOR))
                                            <div class="btn-status">
                                                <a attr-status={{AGREE}} class="check-true-disabled check-violation-code" href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}} class="check-false-disabled check-violation-code" href="javascript:void(0)"></a>
                                            </div>
                                        @elseif(isViolationStatus($article->supervisor_review['status']) && isRole(ROLE_SUPERVISOR)
                                                && count($article->supervisor_review['violation_code']) === 0)
                                            <div class="btn-status">
                                                <a attr-status={{AGREE}} class="check-true check-violation-code" href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}} class="check-false check-violation-code" href="javascript:void(0)"></a>
                                            </div>
                                        @else
                                            <div class="style__code--article" style="width:100%">
                                                @foreach ($article->supervisor_review['violation_code'] as $detectionCode)
                                                    <div>
                                                        <a href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
                                                            {{$detectionCode['name'] ?? ''}}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle supervisor-violation-type">
                                        @foreach ($article->supervisor_review['violation_types'] as $supervisorType)
                                            <p style="color:{{ $supervisorType['color'] ?? ''}}">{{ $supervisorType['name'] ?? '' }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- ==================================================== --}}
                            {{-- ================= OPERATOR COLUMN ================== --}}
                            {{-- ==================================================== --}}
                            @if(@Auth::user()->role === "OPERATOR")
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
                                                <a attr-status={{DISAGREE}} class="check-false check-violation-code dishable_overlay" href="javascript:void(0)"></a>
                                            </div>
                                        @else
                                            <div class="style__code--article" style="width:100%">
                                                @foreach ($article->operator_review['violation_code'] as $detectionCode)
                                                    <div>
                                                        <a href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
                                                            {{ $detectionCode['name'] ?? '' }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle operator-violation-type">
                                        @foreach ($article->operator_review['violation_types'] as $operatorType)
                                            <p style="color:{{ $operatorType['color'] ?? ''}}">{{ $operatorType['name'] ?? '' }}</p>
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
    <div class="row-pagination">
        {{ $articles->links('layouts.my-paginate') }}
    </div>

    <div class="modal-title open-modal" id="confirmActionModal">
        <div class="modal-confirm-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1>{{ __('Are you sure?') }}</h1>
            </div>
            <p class="title-modal" style="text-align: center;display: block;">
                {{ __("When you move this post to non-violation list, you can not change the status in the future.") }}
            </p>
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
                <h1>{{ __('Are you sure?') }}</h1>
            </div>
            <p class="title-modal" style="text-align: center;display: block;">
                {{ __("When you move this post to violation list, you can not change the status in the future.") }}
            </p>
            <div class="head-confirm-btn">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-confirm-violation btn-confirm-style" id="confirm-yes">{{ __('Confirm') }}</button>
            </div>
        </div>
    </div>

    <div class="modal-title open-modal" id="selectCodeModal">
        <div class="modal-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1 class="fix_heade_modal">{{ __('Choose violation code') }}</h1>
            </div>
            <div class="search_code_article">
                <img src="{{ asset('assets/image/search.svg') }}" alt="search" class="btn-search">
                <input type="text" placeholder="Search for violation code" class="search">
            </div>
            <div class="row">
                @foreach($violationCode as $key => $code)
                <div class="col-md-4 ">
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
                <button class="confirm-btn btn-select-code btn-confirm-style" id="confirm-yes">{{ __('Save change') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container-table" id="div-moblie">
    <h1>Moblie</h1>
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
