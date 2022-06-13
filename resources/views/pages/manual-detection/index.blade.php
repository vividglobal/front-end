@extends('layouts.app')

@section('content')
<div class="list--search--select" >
        <div class="list--title">
            <p>Label violations</p>
        </div>
        <!-- Checkbox suspected -->
        <div class="list--suspected__text--img">
            <div style="display: flex; justify-content:space-between;max-width:703px">
                <label class="container__checkbox checkbox__suspected">Enter the suspected text/Drop image
                    <input type="radio" name="radio" id="image">
                    <span class="checkmark"></span>
                </label>
                <label class="container__checkbox checkbox__suspected">Enter the suspected URL
                    <input type="radio" name="radio" id="text">
                    <span class="checkmark"></span>
                </label>
            </div>
            <!-- choose file -->
            <div style="display: flex;">
                <div class="suspected__text__area">
                    <textarea name="" id="" cols="30" rows="10">
                    </textarea>
                </div>
                <div class="suspected__file__area">
                    <div class='file-input'>
                        <input type='file'>
                        <span class='button'><img src="{{ asset('assets/image/upfile.svg') }}" alt=""></span>
                        <span class='label' data-js-label>Or drop the image here</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- validate country  -->
        <div class="list--select--option">
            <div class="list--select__left">
                <div class="list--country" style="padding:14px 5px 14px 0px;margin-bottom: 20px;" id="validate-country">
                    <img src="{{ asset('assets/image/Country.svg') }}" alt="">
                    <p>Country</p>
                    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">

                    <div class="select--country" id="validate-select-country" style="top:45px;
                    left: -1%;z-index: 1;">
                        <div class="search--input--country" id="div-validate-search-country">
                            <img src="{{ asset('assets/image/search.svg') }}" alt="">
                            <input type="text" placeholder="Search for country" class="search--country" id="validate-search-country">
                        </div>
                        <div class="contain--selection">
                            <!-- //HTML -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages/manual-detection/captcha')
        <div class="title__result">
            <p>Result:</p>
        </div>
        <!-- list Btn  -->
        @include('pages/components/query')
</div>
<div class="row-a">
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
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
@endsection
