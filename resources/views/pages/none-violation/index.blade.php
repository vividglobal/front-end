@extends('layouts.app')

@section('content')
<div class="list--search--select" >
        <div class="list--title">
            <p>Non-violation list</p>
        </div>
        <!-- list Btn  -->
        @include('pages/components/query')

</div>
    <div class="container-table">
        <div class="container-row-non-vio">
            <div class="col-left-non-vio">
                <table class="tbdata col-table">
                    <thead class="col-thead">
                        <tr>
                            <th style="width:2%" class="style-title">{{ __('No') }}</th>
                            <th style="width:12%" class="style-title">
                                <div class="th-title-right">
                                    <p>{{ __('Company') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png"  alt="ico">
                                </div>
                            </th>
                            <th style="width:12%" class="style-title">
                                <div class="th-title-right">
                                    <p>{{ __('Country') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png"  alt="ico">
                                </div>
                            </th>
                            <th style="width:12%" class="style-title">
                                <div class="th-title-right">
                                    <p>{{ __('Brand') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png"  alt="ico">
                                </div>
                            </th>
                            <th style="width:15%" class="style-title">{{ __('Caption') }}</th>
                            <th style="width:12%" class="style-title">{{ __('Image') }}</th>
                            <th rowspan="2" class="style-title">
                                <div class="th-title-right">
                                    <p>{{ __('Published date') }}</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png"  alt="ico">
                                </div>
                            </th>
                            <th rowspan="2" class="style-title">
                                <div class="th-title-right">
                                    <p>Crawl date</p>
                                    <img class="ico-sort" src="../assets/image/ico-sort.png.png"  alt="ico">
                                </div>
                            </th>
                            <th  rowspan="2"class="style-title">Link</th>
                            <th  rowspan="2"class="style-title">Switch status</th>
                        </tr>
                    </thead>
                    <tbody class="tbdata">
                        <tr class="tr-boder">
                            <td>1</td>
                            <td><a href="#">Nature One Dairy</a></td>
                            <td><a href="#">Australia</a></td>
                            <td><a href="#">Nature One Dairy Australia</a></td>
                            <td class="contenttb btn-caption"><a href="#">How to communicate positively with your toddler, with communicate positively with your toddler, with communicate positively with your toddler, with Amanda Abel ...</a></td>
                            <td>
                                <div class="wr-img">
                                    <img class="td-img clickimg" src="../assets/image/img1.png" alt="">
                                </div>
                            </td>
                            <td>05/04/2022</td>
                            <td>05/04/2022</td>
                            <td><img class="td-link" src="../assets/image/link.png" alt="#"></td>
                            <td><img class="td-link" src="../assets/image/switch.png" alt="#"></td>
                        </tr>
                        <tr class="tr-boder">
                            <td>1</td>
                            <td><a href="#">Nature One Dairy</a></td>
                            <td><a href="#">Australia</a></td>
                            <td><a href="#">Nature One Dairy Australia</a></td>
                            <td class="contenttb btn-caption"><a href="#">How to communicate positively with your toddler, with communicate positively with your toddler, with communicate positively with your toddler, with Amanda Abel ...</a></td>
                            <td>
                                <div class="wr-img">
                                    <img class="td-img clickimg" src="../assets/image/img1.png" alt="#">
                                </div>
                            </td>
                            <td>05/04/2022</td>
                            <td>05/04/2022</td>
                            <td><img class="td-link" src="../assets/image/link.png" alt="#"></td>
                            <td><img class="td-link" src="../assets/image/switch.png" alt="#"></td>
                        </tr>
                    </tbody>
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
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
@endsection
