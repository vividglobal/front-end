<div class="container-table">
    <div class="container_row">
        <div class="col-left">
            <table class="tbdata col-table">
                <thead class="col-thead">
                    <tr>
                        <th style="width:2%" class="style-title">{{ __('No') }}</th>
                        <th style="width:12%" class="style-title">
                            <div class="th-title-right sort_company">
                                <p>{{ __('Company') }}</p>
                                <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                                <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
                            </div>
                        </th>
                        <th style="width:12%" class="style-title">
                            <div class="th-title-right sort_country">
                                <p>{{ __('Country') }}</p>
                                <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                                <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
                            </div>
                        </th>
                        <th style="width:12%" class="style-title sort_brand">
                            <div class="th-title-right">
                                <p>{{ __('Brand') }}</p>
                                <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                                <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
                            </div>
                        </th>
                        <th style="width:15%" class="style-title">{{ __('Caption') }}</th>
                        <th style="width:12%" class="style-title">{{ __('Image') }}</th>
                    </tr>
                </thead>
                <tbody class="tbdata">
                    @foreach ($articles as $key => $article)
                        <tr class="tr-boder" data-id="{{ $article->_id }}">
                            <td>{{$key + 1}}</td>
                            <td>
                            @isset($article->company['name'])
                                <a  href={{ __(getUrlName("company_brand_id",$article->company['id'])) }}>
                                    {{ __($article->company['name'] ?? '' )}}
                                </a>
                            @endisset
                            </td>
                            <td>
                            @isset($article->country['name'])
                                <a  href={{ getUrlName( "country" , $article->country['id']) }}>
                                {{ __($article->country['name'] ?? '' )}}
                                </a>
                            @endisset
                            </td>
                            @isset($article->brand['name'])
                            <td>
                                <a class="brand-name"  href={{ getUrlName( "company_brand_id" , $article->brand['id']) }}>
                                    {{ __($article->brand['name'] ?? '' )}}
                                </a>
                            </td>
                            @endisset
                            <td class="contenttb btn-caption"><a>{{ __($article->caption ?? '' ) }}</a></td>
                            <td>
                                <div class="wr-img">
                                    <img class="td-img clickimg" src={{ __($article->image ?? '' ) }} alt="">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-right col-right-form ">
            <table class="wrap">
                <div class="headers">
                    <div class="scroller syncscroll" name="myElements">
                        <div class="track">
                            <div class=" heading th-title-right sort_public_date">
                                <p>{{ __('Published date') }}</p>
                                <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                                <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
                            </div>
                        </div>
                        <div class="track">
                            <div class=" heading th-title-right sort_crawl_date">
                                <p>{{ __('Crawl date') }}</p>
                                <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                                <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
                            </div>
                        </div>
                        <div class="track">
                            <div class="heading">{{ __('Link') }}</div>
                        </div>
                        <div class="track track-three">
                            <div class="heading-three">{{ __('VIVID') }}</div>
                            <div class="heading-three-title">
                                <div class="th-title-right-three sort_bot_status">
                                    <p data-sort="bot_status" >{{ __('Status') }}</p>
                                    <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                                    <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
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
                            <div class="heading-three">{{ __('Supervisor') }}</div>
                            <div class="heading-three-title">
                                <div class="th-title-right-three sort_supervisor">
                                    <p data-sort="supervisor_status">{{ __('Status') }}</p>
                                    <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                                    <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
                                </div>
                                <div class="th-title-right-three">
                                    <p>{{ __('Code article') }}</p>
                                </div>
                                <div class="th-title-right heading-three-violation">
                                    <p>{{ __('Violation type') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="track track-three">
                            <div class="heading-three">{{ __('Operator') }}</div>
                            <div class="heading-three-title">
                                <div class="th-title-right-three sort_operator">
                                    <p data-sort="operator_status">{{ __('Status') }}</p>
                                    <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                                    <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
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
                                    <a href={{ __($article->link ?? '' )}}><img class="td-link" src="../assets/image/link.png" alt=""></a>
                                </div>
                            </div>
                            <div class="track track-three">
                                <div class="entry-three">
                                    <div class="entry-title">
                                        <?php
                                            $botStatus = count($article->detection_result['violation_code']) > 0
                                                        ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                                        ?>
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
                                        @foreach ($article->detection_result['violation_code'] as $detectioncode)
                                            <div>
                                                <a href="{{ getUrlName( "violation_code_id" , $detectioncode['id'] ) }}" id={{ $detectioncode['id'] }}>
                                                    {{$detectioncode['name'] ?? ''}}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle bot-violation-code">
                                        @foreach ($article->detection_result['violation_types'] as $detectiontype)
                                            <p style="color:{{$detectiontype['color'] ?? ''}}">{{$detectiontype['name'] ?? ''}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user())
                            {{-- ==================================================== --}}
                            {{-- ================= SUPERVISOR COLUMN ================ --}}
                            {{-- ==================================================== --}}
                            <div class="track track-three">
                                <div class="entry-three">
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
                                            <div class="entry-title-threee entry-title-tyle reviewing-title">
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
                                            <div class="entry-title-threee entry-title-tyle reviewing-title">
                                                @foreach ($article->supervisor_review['violation_code'] as $detectiontype)
                                                    <p>{{ $detectiontype['name'] ?? '' }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="entry-title-threee entry-title-tyle supervisor-violation-type">
                                        @foreach ($article->supervisor_review['violation_types'] as $supervisortype)
                                            <p>{{ $supervisortype['name'] ?? '' }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- ==================================================== --}}
                            {{-- ================= OPERATOR COLUMN ================== --}}
                            {{-- ==================================================== --}}
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
                                                <a attr-status={{AGREE}} class="check-true check-violation-code" href="javascript:void(0)"></a>
                                                <a attr-status={{DISAGREE}} class="check-false check-violation-code" href="javascript:void(0)"></a>
                                            </div>
                                        @else
                                            <div class="entry-title-threee entry-title-tyle reviewing-title">
                                                @foreach ($article->operator_review['violation_code'] as $detectiontype)
                                                    <p>{{ $detectiontype['name'] ?? '' }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle operator-violation-type">
                                        @foreach ($article->operator_review['violation_types'] as $supervisortype)
                                            <p style="color:{{$detectiontype['color'] ?? ''}}">{{ $supervisortype['name'] ?? '' }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </table>
        </div>
    </div>
    <div class="row-pagination">
        {{ $articles->links('layouts.my-paginate') }}
    </div>

    <div class="modal-title open-modal" id="captionModal">
        <div class="modal-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1></h1>
            </div>
            <p class="title-modal"></p>
        </div>
    </div>

    <div class="modalimg open-modal" id="imageModal">
        <div class="modal-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1></h1>
            </div>
            <div>
                <img class="modal-img">
            </div>
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
            <p class="title-modal" style="text-align: center;display: block;">
                {{ __("Do you want to mark this article as Non-Violation") }}
            </p>
            <div class="head-confirm-btn">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-confirm-non-violation btn-confirm-style" id="confirm-yes">{{ __('Confirm') }}</button>
            </div>
        </div>
    </div>

    <div class="modal-title open-modal" id="selectCodeModal">
        <div class="modal-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1>{{ __('Select violation code') }}</h1>
            </div>
            <div class="row">
                @foreach($violationCode as $key => $code)
                <div class="col-md-4">
                    <div class="checkbox-code">
                        <div class="checkbox-style">
                            <input class="click-on" type="checkbox" id="code_{{$key}}" name="violation_code[]" value={{ $code->id }}>
                        </div>
                        <div>
                            <label class="click-on" for="code_{{$key}}">{{ $code->name }}</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="btn-confirm">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-select-code btn-confirm-style" id="confirm-yes">{{ __('Confirm') }}</button>
            </div>
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
<script src="{{ asset('assets/js/pages/article-action.js') }}"></script>
