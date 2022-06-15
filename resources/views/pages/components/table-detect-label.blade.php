
<div class="container-table">
        <div class="container_row">
            <div class="col-left ">
                <table class="tbdata col-table">
                    <thead class="col-thead">
                        <tr>
                            <th style="width:2%" class="style-title">{{ __('No') }}</th>
                            <th style="width:12%" class="style-title">
                                <div class="th-title-right">
                                    <p>{{ __('Company') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                </div>
                            </th>
                            <th style="width:12%" class="style-title">
                                <div class="th-title-right">
                                    <p>{{ __('Country') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                </div>
                            </th>
                            <th style="width:12%" class="style-title">
                                <div class="th-title-right">
                                    <p>{{ __('Brand') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                </div>
                            </th>
                            <th style="width:15%" class="style-title">{{ __('Caption') }}</th>
                            <th style="width:12%" class="style-title">{{ __('Image') }}</th>
                        </tr>
                    </thead>
                    <tbody class="tbdata">
                        @foreach ($articles as $key => $article)
                            <tr class="tr-boder">
                                <td>{{$key + 1}}</td>
                                <td><a href="#">{{ __($article->company['name'] ?? '' )}}</a></td>
                                <td><a href="#">{{ __($article->country['name'] ?? '' )}}</a></td>
                                <td><a href="#">{{ __($article->brand['name'] ?? '' )}}</a></td>
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
                                <div class=" heading th-title-right">
                                    <p>{{ __('Published date') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                </div>
                            </div>
                            <div class="track">
                                <div class=" heading th-title-right">
                                    <p>{{ __('Crawl date') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                </div>
                            </div>
                            <div class="track">
                                <div class="heading">{{ __('Link') }}</div>
                            </div>
                            <div class="track track-three">
                                <div class="heading-three">{{ __('VIVID') }}</div>
                                <div class="heading-three-title">
                                    <div class="th-title-right-three">
                                        <p>{{ __('Status') }}</p>
                                        <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
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
                                <div class="heading-three">{{ __('Supervisor') }}</div>
                                <div class="heading-three-title">
                                    <div class="th-title-right-three">
                                        <p>{{ __('Status') }}</p>
                                        <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
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
                                    <div class="th-title-right-three">
                                        <p>{{ __('Status') }}</p>
                                        <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                    </div>
                                    <div class="th-title-right-three">
                                        <p>{{ __('Code article') }}</p>
                                    </div>
                                    <div class="th-title-right heading-three-violation">
                                        <p>{{ __('Violation type') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($articles as $key => $article)
                        <div class="tracks syncscroll container-scroll" name="myElements">
                            <div class="track">
                                <div class="entry">
                                    <h3>{{date("d-m-Y",$article->published_date)}}</h3>
                                </div>
                            </div>
                            <div class="track">
                                <div class="entry">
                                    <h3>{{date("d-m-Y",$article->published_date)}}</h3>
                                </div>
                            </div>
                            <div class="track">
                                <div class="entry">
                                    <a href={{ __($article->link ?? '' )}}><img class="td-link" src="../assets/image/link.png" alt=""></a>
                                </div>
                            </div>
                            <div class="track track-three">
                                <div class="entry-three">
                                    <div class="entry-title">Reviewing</div>
                                    <?php if($article->detection_result !== ""){ ?>
                                    <div class="entry-title">
                                        @foreach ($article->detection_result['violation_code'] as $detection)
                                        <p>{{$detection['name'] ?? ''}}</p>
                                        @endforeach
                                    </div>
                                    <div class="entry-title-threee entry-title-tyle">
                                        @foreach ($article->detection_result['violation_types'] as $detectiontype)
                                            <p>{{$detectiontype['name'] ?? ''}}</p>
                                        @endforeach
                                    </div>
                                    <?php }?>
                                </div>
                            </div>

                            <div class="track track-three">
                                <div class="entry-three">
                                    <div class="entry-title">
                                        @if(isPendingStatus($article->supervisor_review['status']) && isRole("SUPERVISOR"))
                                            <div class="btn-status">
                                                <a attr-status="true" class="check-true check-status" href="javascript:void(0)"></a>
                                                <a attr-status="false" class="check-false check-status" href="javascript:void(0)"></a>
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
                                    <div class="entry-title">
                                        @if(isPendingStatus($article->supervisor_review['status']) && isRole("SUPERVISOR"))
                                            <div class="btn-status">
                                                <a attr-status="true" class="check-true-disabled check-status" href="javascript:void(0)"></a>
                                                <a attr-status="false" class="check-false-disabled check-status" href="javascript:void(0)"></a>
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

                                    @if(isPendingStatus($article->supervisor_review['status']) && isRole("SUPERVISOR"))
                                        <div class="entry-title-threee entry-title-tyle">
                                            @foreach ($article->supervisor_review['violation_types'] as $supervisortype)
                                                <p>{{$supervisortype['name'] ?? ''}}</p>
                                            @endforeach
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
                            </div>

                            <div class="track track-three">
                                <div class="entry-three">
                                    <div class="entry-title">
                                            @if(isPendingStatus($article->operator_review['status']) && isRole("OPERATOR"))
                                                <div class="btn-status">
                                                    <a attr-status="true" class="check-true check-status" href="javascript:void(0)"></a>
                                                    <a attr-status="false" class="check-false check-status" href="javascript:void(0)"></a>
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
                                    <div class="entry-title">
                                        @if(isPendingStatus($article->operator_review['status']) && isRole("OPERATOR"))
                                            <div class="btn-status">
                                                <a attr-status="true" class="check-true-disabled check-status" href="javascript:void(0)"></a>
                                                <a attr-status="false" class="check-false-disabled check-status" href="javascript:void(0)"></a>
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
                                    @if(isPendingStatus($article->operator_review['status']) && isRole("OPERATOR"))
                                        <div class="entry-title-threee entry-title-tyle">
                                            @foreach ($article->operator_review['violation_types'] as $operatortype)
                                                <p>{{$operatortype['name'] ?? ''}}</p>
                                            @endforeach
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
                            </div>
                        </div>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="row-pagination">
            {{ $articles->links('layouts.my-paginate') }}
        </div>

        <div class="modal-title">
            <div class="modal-content">
                <div class="div-close">
                    <span class="close">&times;</span>
                </div>
                <div class="head-modal">
                    <h1 >Nature One Dairy Australia</h1>
                </div>
                <p class="title-modal">
                    ⭐ [KẾT QUẢ MINIGAME] HÀNH TRANG SỨC KHỎE CHO BÉ - QUÀ XỊN TRAO TAY MẸ ⭐<br><br>Chúc mừng 10 bố mẹ đã có câu trả lời đúng và đẩy đủ trong minigame và nhận được phần quà là 01 sản phẩm NAN Optipro 4 - 900G (trị giá 375,000 VND)<br><br>Nestle Mom&amp;Me xin bật mí “hành trang sức khỏe” ẩn giấu trong ô chữ lần này chính là NAN. <br><br>Bật mí với bố mẹ: Hai ly NAN Optipro 4 mỗi ngày, với bộ đôi HMO và đạm độc quyền Optipro, sẽ giúp bé hấp thụ các dưỡng chất và tiêu hóa tốt hơn, đồng thời tăng cường sức đề kháng để bé dễ dàng chống lại được các tác nhân gây bệnh trong môi trường, giảm ốm vặt. Từ đó, bé yêu được chuẩn bị một nền tảng sức khỏe vững chắc để luôn sẵn sàng trở lại trường bất kỳ lúc nào!
                </p>
            </div>
        </div>

        <div class="modalimg">
            <div class="modal-content">
                <div class="div-close">
                    <span class="close">&times;</span>
                </div>
                <div class="head-modal">
                    <h1 >Nature One Dairy Australia</h1>
                </div>
                <div>
                    <img class="modal-img" src="../assets/image/img1.png" alt="">
                </div>
            </div>
        </div>
</div>
