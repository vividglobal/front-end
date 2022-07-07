@extends('layouts.app')

@section('content')
<div class="list--search--select" >
    <div class="list--title">
        <p>{{ __('Non-violation list') }}</p>
    </div>
    @include('pages/components/query', ['list_filter' => ["search","date","brand","country","apply","excel"], 'show_all_filter' => false])
    <!-- list Btn  -->
</div>

<div class="container-table">
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
                        <div class="track track-non">
                            <div class="heading"><p>{{ __('Link') }}</p></div>
                        </div>
                        @auth
                        <div class="track track-non">
                            <div class="heading"><p>{{ __('Switch status') }}</p></div>
                        </div>
                        @endauth
                    </div>
                </div>
                <div class="tracks syncscroll container-scroll-non" name="myElements">
                    @foreach ($articles as $key => $article)
                        <div class="scroll-table" data-id="{{ $article->_id }}">
                        <div class="track track-non">
                                <div class="entry">
                                    <h3>{{date("d/m/Y",$article->published_date)}}</h3>
                                </div>
                            </div>
                            <div class="track track-non">
                                <div class="entry">
                                    <h3>{{date("d/m/Y",$article->crawl_date)}}</h3>
                                </div>
                            </div>
                            <div class="track track-non">
                                <div class="entry">
                                    <a href={{ __($article->link ?? '' )}}><img class="td-link a-link" src="{{asset('assets/image/link.png')}}" alt=""></a>
                                </div>
                            </div>
                            @auth
                            <div class="track track-non">
                                <div class="entry">
                                    <img  class="td-link btn-switch" src="{{asset('assets/image/switch.png')}}" alt="#" data-id={{$article->_id }} >
                                </div>
                            </div>
                            @endauth
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

<div class="modal-confirm-title">
        <div class="modal-confirm-content">
            <div class="head-confirm">
                <h1>Confirmation</h1>
                <p>Are you sure moving this post to auto-detect violations list?</p>
            </div>
            <div class="head-confirm-btn">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-yes" id="confirm-yes">Yes</button>
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
