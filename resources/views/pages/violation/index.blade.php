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
                    @foreach ($articles as $key => $article)
                        <tr class="tr-boder">
                            <td>{{$key + 1}}</td>
                            <td><a href="#">{{ __($article->company['name'] ?? '') }}
                            <td><a href="#">{{ __($article->country['name'] ?? '') }}</a></td>
                            <td><a href="#">{{ __($article->brand['name'] ?? '') }}</a></td>
                            <td class="contenttb btn-caption"><a>{{ __('How to communicate positively with your toddler, with communicate positively with your toddler, with communicate positively with your toddler, with Amanda Abel ...') }}</a></td>
                            <td>
                                <div class="wr-img">
                                    <img class="td-img clickimg" src="../assets/image/img1.png" alt="">
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
                            <div class=" heading th-title-right">
                                <p>{{ __('Penalty issued') }}</p>
                                <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                            </div>
                        </div>
                        <div class="track">
                            <div class="heading">{{ __('Link') }}</div>
                        </div>
                        <div class="track">
                            <div class=" heading th-title-right">
                                <p>{{ __('Legal documents') }}</p>
                            </div>
                        </div>
                        <div class="track">
                            <div class=" heading th-title-right">
                                <p>{{ __('Code article') }}</p>
                            </div>
                        </div>
                        <div class="track track-one">
                            <div class="heading-three-viola">{{ __('VIVID') }}</div>
                        </div>
                        <div class="track">
                            <div class=" heading th-title-right">
                                <p>{{ __('Status progress') }}</p>
                            </div>
                        </div>
                        <div class="track">
                            <div class="heading">{{ __('Switch status') }}</div>
                        </div>
                    </div>
                </div>

                <div class="tracks syncscroll container-scroll" name="myElements">
                    <div class="track">
                        <div class="entry">
                            <h3>05/04/2022</h3>
                        </div>
                    </div>
                    <div class="track">
                        <div class="entry">
                            <h3>05/04/2022</h3>
                        </div>
                    </div>
                    <div class="track">
                        <div class="entry">
                            <h3></h3>
                        </div>
                    </div>
                    <div class="track">
                        <div class="entry">
                            <img class="td-link" src="../assets/image/link.png" alt="#">
                        </div>
                    </div>
                    <div class="track">
                        <div class="entry">
                            <img class="td-link" src="../assets/image/lega1.png" alt="#">
                        </div>
                    </div>
                    <div class="track">
                        <div class="entry">
                            <a href="#">6.1-SCT</a> <br>
                            <a href="#">4.3.a</a> <br>
                            <a href="#">4.3.c</a> <br>
                        </div>
                    </div>
                    <div class="track track-one">
                        <div class="entry-three">
                            <div class="entry-title-threee"><p>{{ __('Information for Health Workers') }}</p></div>
                        </div>
                    </div>
                    <div class="track">
                        <div class="entry">
                            <div class="list--select-right" id="btn-language">
                                    <p>Select</p>
                                    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">
                                    <div class="select--country" id="language">
                                        <div class="search--input--country" id="div-search">
                                            <img src="{{ asset('assets/image/search.svg') }}" alt="">
                                            <input type="text" placeholder="Search for country" class="search--country" >
                                        </div>
                                        <div class="contain--selection">
                                            <div class="select__one--country select-language">
                                                <p>Processing</p>
                                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                            </div>
                                            <div class="select__one--country select-language">
                                                <p>Completed</p>
                                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="track">
                        <div class="entry">
                            <img class="td-link" src="../assets/image/switch.png" alt="#">
                        </div>
                    </div>
                </div>
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
<script src="{{ asset('assets/js/btn_select/selectStatus.js') }}"></script>
@endsection
