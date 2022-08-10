@extends('layouts.app')

@section('content')
<div class="list--search--select" >
    <div class="list--title">
        <p>{{ __('Unable to detect') }}</p>
    </div>
    @include('pages/components/query', ['list_filter' => ["search","date","brand","country","apply","excel","fillter_mobile"], 'show_all_filter' => false])
    <!-- list Btn  -->
</div>

<div class="container-table" id="div-pc">
    <div class="container_row">
        <div class="col-left ">
            @include('pages.components.table-left')
        </div>
        <div class="col-right col-right-form  col-form-nonvio">
            <table class="wrap">
                <div class="headers">
                    <div class="scroller syncscroll" name="myElements">
                        <div class="track track-non">
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
                        <div class="track track-non">
                            <div class=" heading th-title-right sort_checking_date">
                                <p>{{ __('Review date') }}</p>
                                <span
                                    @class([
                                        'ico-sort theard-table sort_up',
                                        'disabled' => checkSort(request()->all(), 'checking_date', ASC)
                                    ])></span>
                                <span
                                    @class([
                                        'ico-sort theard-table sort_down',
                                        'disabled' => checkSort(request()->all(), 'checking_date', DESC)
                                    ])></span>
                            </div>
                        </div>
                        <div class="track track-non">
                            <div class="heading"><p>{{ __('Link') }}</p></div>
                        </div>
                        @if(@Auth::user()->role === "OPERATOR")
                        <div class="track track-non">
                            <div class="heading"><p>{{ __('Switch status') }}</p></div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="tracks syncscroll container-scroll-non" name="myElements">
                    @foreach ($articles as $key => $article)
                        <div class="scroll-table" data-id="{{ $article->_id }}">
                        <div class="track track-non">
                                <div class="entry">
                                    @isset($article->published_date)
                                    <h3 class="updata-form">{{date("m-d-Y",$article->published_date)}}</h3>
                                    @endisset
                                </div>
                            </div>
                            <div class="track track-non">
                                <div class="entry">
                                    <h3 class="updata-form">{{date("m-d-Y",$article->operator_review['review_date'] )}}</h3>
                                </div>
                            </div>
                            <div class="track track-non">
                                <div class="entry">
                                @if($article->link)
                                    <a href={{ __($article->link ?? '' )}} target="_blank">
                                        <img class="td-link a-link" src="{{asset('assets/image/link.png')}}" alt="">
                                    </a>
                                @else
                                    <a class="onclick-link-check">
                                        <img class="td-link a-link" src="{{ asset('assets/image/link.png') }}" alt="">
                                    </a>
                                @endif
                                </div>
                            </div>
                            @if(@Auth::user()->role === "OPERATOR")
                            <div class="track track-non">
                                <div class="entry">
                                    <img  class="td-link btn-switch" src="{{asset('assets/image/switch.png')}}" alt="#" data-id={{$article->_id }} >
                                </div>
                            </div>
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
            {{ $articles->links('layouts.my-paginate') }}
        </div>
    </div>
</div>

<div class="container-table container-table-mobile" id="div-moblie">
    <ul class="container-row-mobile">
        @foreach ($articles as $key => $article)
            <li class="lish-body">
                <a href="/articles/{{$article->_id}}/non-violation" style="text-decoration: none;">
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
                                @if(isset($article->operator_review['violation_code']))
                                <?php
                                    $botStatus = count($article->detection_result['violation_code']) > 0 && isset($article->detection_result['violation_code'])
                                    ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                                ?>
                                @endif
                                <p class="status-title unviolation-color" data-status="NON_VIOLATION">Unable to detect</p>
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
    <div class="row-pagination">
    {{ $articles->onEachSide(1)->links('layouts.my-paginate')}}
    </div>
    @if(count($articles) == 0)
    @include('noSearchResult/index')
    @endif
</div>

<div class="modal-confirm-title">
        <div class="modal-confirm-content">
            <div class="head-confirm">
                <h1>Confirmation</h1>
                <p>Switch status successfully</p>
            </div>
            <div class="head-confirm-btn">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-yes" id="confirm-yes">Confirm</button>
            </div>
        </div>
    </div>



<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
<script src="{{ asset('assets/js/btn_select/selectStatus.js') }}"></script>
<script src="{{ asset('assets/js/modal/modalConfirm.js') }}"></script>
<script src="{{ asset('assets/js/query/queryData.js') }}"></script>

@endsection
