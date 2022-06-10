@extends('layouts.app')

@section('content')

<div class="list--search--select" >
        <div class="list--title">
            <p>Violation list</p>
        </div>
        @include('pages/components/query')
        <!-- list Btn  -->
    </div>

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
                    <?php if(count($articles) > 0){ ?>
                    @foreach ($articles as $key => $article)
                        <tr class="tr-boder">
                            <td>{{$key}}</td>
                            <td><a href="#">{{ __($article->company) }}
                            <td><a href="#">{{ __($article->country) }}</a></td>
                            <td><a href="#">{{ __($article->brand) }}</a></td>
                            <td class="contenttb btn-caption"><a>{{ __($article->caption) }}</a></td>
                            <td>
                                <div class="wr-img">
                                    <img class="td-img clickimg" src="../assets/image/img1.png" alt="">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <?php } ?>
                </tbody>
            </table>
        </div>

    <div class="col-right col-right-form ">
        <table class="tbdata col-right-form container-scroll">
                    <thead class="col-thead">
                        <tr>
                            <th rowspan="2" class="style-title">
                                <div class="th-title-right">
                                    <p>Published date</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="ico">
                                </div>
                            </th>
                            <th rowspan="2" class="style-title">
                                <div class="th-title-right">
                                    <p>Crawl date</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="ico">
                                </div>
                            </th>
                            <th rowspan="2" class="style-title">
                                <div class="th-title-right">
                                    <p>Penalty issued</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="ico">
                                </div>
                            </th>
                            <th  rowspan="2"class="style-title">Link</th>
                            <th  rowspan="2"class="style-title">Legal document</th>
                            <th  rowspan="2"class="style-title">Code article</th>
                            <th  white-space: nowrap rowspan="2"class="style-title">Violation type</th>
                            <th  rowspan="2"class="style-title">Status progress</th>
                            <th  rowspan="2"class="style-title">Switch status</th>
                        </tr>
                    </thead>
                    <tbody class="tbdata">
                        <tr class="tr-boder">
                            <td>{{ __($article->modified->toDateTime()->format('Y/m/d')) }}</td>
                            <td>{{ __($article->created_at->toDateTime()->format('Y/m/d')) }}</td>
                            <td></td>
                            <td><a href={{ __($article->link) }} ><img class="td-link" src="../assets/image/link.png" alt="#"></a></td>
                            <td><img class="td-link" src="../assets/image/folder-gray.svg" alt="#"></td>
                            <td>
                                <!-- <a href="#">6.1-SCT</a>
                                <a href="#">4.3.a</a>
                                <a href="#">4.3.c</a> -->
                            </td>
                            <td white-space: nowrap>
                                <!-- <p>Labeling, packaging and messaging</p>
                                <p>Imformation for Health Workers</p> -->
                            </td>
                            <td>
                                <div class="dropdown">
                                    <div class="dropdown-btn">Select
                                        <img class='img-dropdown' src="../assets/image/Under-than.svg" alt="img-dropdown">
                                    </div>
                                    <div class="dropdown-content">
                                        <div class="dropdown-items">
                                            Not started
                                        </div>
                                        <div class="dropdown-items">
                                            Processing
                                        </div>
                                        <div class="dropdown-items">
                                            Completed
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><img class="td-link" src="../assets/image/switch.svg" alt="#"></td>
                        </tr>
                    </tbody>
        </table>
    </div>
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
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
@endsection
