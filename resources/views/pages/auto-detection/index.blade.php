@extends('layouts.app')

@section('content')

<div class="row-a">
    <div class="col-12">
    <div class="list--search--select" >
        <div class="list--title">
            <p>Violation list</p>
        </div>
        <!-- list Btn  -->
        <div class="list--select--option">
            <div class="list--select__left">
                <div class="list--search">
                    <img src="{{ asset('assets/image/search.svg') }}" alt="">
                    <input type="text" placeholder="Search" class="search">
                </div>
                    <div id="daterange">
                        <i class="ico-date"></i>
                        <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                        <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                    </div>
                <div class="list--company--brand">
                    <img src="{{ asset('assets/image/brand-tag.svg') }}" alt="">
                    <p>Brand/Company</p>
                    <img src="{{ asset('assets/image/under-than.svg') }}" alt="">
                    <div class="select--company-or-brand" id="toggle">
                            <div class="search--input">
                                <img src="{{ asset('assets/image/search.svg') }}" alt="">
                                <input type="text" placeholder="Search for Brand" class="search--brand">
                            </div>
                            <div class="contain--selection">
                                <div class="select__one">
                                    <p>- Select Brand -</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                                <div class="select__one">
                                    <p>Nestle</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                                <div class="select__one">
                                    <p>Dutch Lady</p>
                                    <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                                </div>
                            </div>
                    </div>
                </div>

                <div class="list--country" id="btn-language">
                    <img src="{{ asset('assets/image/Country.svg') }}" alt="">
                    <p>Country</p>
                    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">

                    <div class="select--country" id="language">
                        <div class="search--input--country" id="div-search">
                            <img src="{{ asset('assets/image/search.svg') }}" alt="">
                            <input type="text" placeholder="Search for country" class="search--country" id="language-search">
                        </div>
                        <div class="contain--selection">
                            <div class="select__one--country select-language">
                                <p>- Select country -</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                            <div class="select__one--country select-language">
                                <p>Endland</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                            <div class="select__one--country select-language">
                                <p>Albania</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list--violation--type">
                    <img src="{{ asset('assets/image/type.svg') }}" alt="">
                    <p>Violation type</p>
                    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">

                    <div class="select--violation--type" id="toggle">
                            <div class="select__one--violation--type">
                                <p>- Select Brand -</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                            <div class="select__one--violation--type">
                                <p>Nestle</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                            <div class="select__one--violation--type">
                                <p>Dutch Lady</p>
                                <img src="{{ asset('assets/image/tickV.svg') }}" alt="">
                            </div>
                    </div>
                </div>
            </div>
            <div class="list--select__right">
                <p>Showing</p>
                <div class="list--showing">
                    <select name="" id="">
                        <option value="">10</option>
                        <option value="">25</option>
                        <option value="">50</option>
                        <option value="">100</option>
                    </select>
                </div>
                <div class="btn--export--excel">
                    <p>Export Excel</p>
                </div>
            </div>
        </div>
    </div>
        <!-- Table -->
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
                                        <td><a href="#">{{ __($article->company) }}
                                        <td><a href="#">{{ __($article->country) }}</a></td>
                                        <td><a href="#">{{ __($article->brand) }}</a></td>
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
                                        <div class="heading">{{ __('Link') }}</div>
                                    </div>
                                    <div class="track track-three">
                                        <div class="heading-three">{{ __('VIVID') }}</div>
                                        <div class="heading-three-title">
                                            <div class="th-title-right">
                                                <p>{{ __('Status') }}</p>
                                                <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                            </div>
                                            <div class="th-title-right">
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
                                            <div class="th-title-right">
                                                <p>{{ __('Status') }}</p>
                                                <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                            </div>
                                            <div class="th-title-right">
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
                                            <div class="th-title-right">
                                                <p>{{ __('Status') }}</p>
                                                <img class="ico-sort" src="../assets/image/ico-sort.png.png" alt="">
                                            </div>
                                            <div class="th-title-right">
                                                <p>{{ __('Code article') }}</p>
                                            </div>
                                            <div class="th-title-right heading-three-violation">
                                                <p>{{ __('Violation type') }}</p>
                                            </div>
                                        </div>
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
                                        <img class="td-link" src="../assets/image/link.png" alt="#">
                                    </div>
                                </div>
                                <div class="track track-three">
                                    <div class="entry-three">
                                        <div class="entry-title">Reviewing</div>
                                        <div class="entry-title">Reviewing</div>
                                        <div class="entry-title-threee"><p>{{ __('Information for Health Workers') }}</p></div>
                                    </div>
                                </div>
                                <div class="track track-three">
                                    <div class="entry-three">
                                        <div class="entry-title">Reviewing</div>
                                        <div class="entry-title">Reviewing</div>
                                        <div class="entry-title-threee"><p>{{ __('Information for Health Workers') }}</p></div>
                                    </div>
                                </div>
                                <div class="track track-three">
                                    <div class="entry-three">
                                        <div class="entry-title">Reviewing</div>
                                        <div class="entry-title">Reviewing</div>
                                        <div class="entry-title-threee"><p>{{ __('Information for Health Workers') }}</p></div>
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
    </div>
</div>
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
@endsection
