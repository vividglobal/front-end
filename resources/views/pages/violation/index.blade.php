@extends('layouts.app')
@section('content')

<div class="list--search--select" >
    <div class="list--title">
        <p>{{ __('Code violation list') }}</p>
    </div>
    @include('pages/components/query', ['list_filter' => ["search","date","brand","violation","country","apply","excel"], 'show_all_filter' => false])
    <!-- list Btn  -->
</div>
<div class="container-table" id="div-pc">
    <div class="container_row">
        <div class="col-left ">
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
                                <p>{{ __('Checking date') }}</p>
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
                            <div class=" heading th-title-right sort_penalty_issued">
                                <p>{{ __('Penalty issued') }}</p>
                                <span
                                    @class([
                                        'ico-sort theard-table sort_up',
                                        'disabled' => checkSort(request()->all(), 'penalty_issued', ASC)
                                    ])></span>
                                <span
                                    @class([
                                        'ico-sort theard-table sort_down',
                                        'disabled' => checkSort(request()->all(), 'penalty_issued', DESC)
                                    ])></span>
                            </div>
                        </div>
                        <div class="track track-link">
                            <div class="heading"><p>{{ __('Link') }}</p></div>
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
                            <div class="heading-three-viola"><p>{{ __('Violation type') }}</p></div>
                        </div>
                        @auth
                        <div class="track">
                            <div class=" heading th-title-right">
                                <p>{{ __('Status progress') }}</p>
                            </div>
                        </div>
                        @if(@Auth::user()->role === "OPERATOR")
                        <div class="track track-switch">
                            <div class="heading"><p>{{ __('Switch status') }}</p></div>
                        </div>
                        @endif
                        @endauth
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
                                    @if(isset($article->operator_review['date']))
                                    <h3>{{date("d/m/Y",$article->operator_review['date'] )}}</h3>
                                    @endif
                                </div>
                            </div>
                            <div class="track">
                                <div class="entry date-penalty">
                                    @if($article->has_document)
                                    <h3  id={{$article->_id}}>{{date("d/m/Y",$article->penalty_issued/1000)}}</h3>
                                    @else
                                    <h3 id={{$article->_id}}></h3>
                                    @endif
                                </div>
                            </div>
                            <div class="track track-link">
                                <div class="entry">
                                    <a href={{ __($article->link ?? '' )}} target="_blank"><img class="td-link a-link" src="{{ asset('assets/image/link.png')}}" alt="link-icon"></a>
                                </div>
                            </div>
                            <div class="track">
                                <div class="entry">
                                    <img class="td-link upload-file" id={{$article->_id}}
                                        @if($article->has_document)
                                            src="{{ asset('assets/image/dislega2.png') }}"
                                        @else
                                            src="{{ asset('assets/image/lega1.png') }}"
                                        @endif
                                        data-id={{$article->_id }} alt="upload-icon">
                                </div>
                            </div>

                            <div class="track ">
                                <div class="entry-three ">
                                    <div class="style__code--article style__code_vio">
                                            @foreach ($article->operator_review['violation_code'] as $detectioncode)
                                                    <div>
                                                        @isset($article->brand['name'])
                                                            <a href="{{ getUrlName( "violation_code_id" , $detectioncode['id'] ) }}" id={{ $detectioncode['id'] }}>
                                                                {{$detectioncode['name'] ?? ''}}
                                                            </a>
                                                        @endisset
                                                    </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="track track-one">
                                <div class="entry  entry-title-tyle bot-violation-code entry-one-item">
                                    @foreach ($article->operator_review['violation_types'] as $detectiontype)
                                        <p style="color:{{$detectiontype['color'] ?? ''}}">{{$detectiontype['name'] ?? ''}} </p>
                                    @endforeach
                                </div>
                            </div>
                            @auth
                            <div class="track">
                                <div class="entry">
                                    <div class="list--status {{@Auth::user()->role !== "OPERATOR" ? "none_list-status" : ""}}"
                                    id="status_{{ ($key + 1) + (($articles->currentpage() - 1) * $articles->perpage()) }}" data-idEL="{{ $article->_id }}" data-role="{{@Auth::user()->role}}">
                                        @if(isset($article->progress_status))
                                            @if($article->progress_status == "NOT_STARTED")
                                                <p data-id="not_started" >{{ __("Not started") }}</p>
                                            @elseif($article->progress_status == "PROCESSING")
                                                <p data-id="Processing" >{{ __("Processing") }}</p>
                                            @elseif($article->progress_status == "COMPLETED")
                                                <p data-id="Completed" >{{ __(' Completed ') }}</p>
                                            @endif
                                        @else
                                            <p data-id="not_started" >{{ __("Not started") }}</p>
                                        @endif
                                        <img src="{{asset('assets/image/Under-than.svg')}}" alt="">
                                        <div class="select--status violation_pc" id="toggle">
                                            <div class="select__one--status list-option"  id="not_started">
                                                <p data-id="not_started" >{{ __("Not started") }}</p>
                                                <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                                            </div>
                                            <div class="select__one--status list-option"  id="Processing">
                                                <p data-id="Processing" >{{ __("Processing") }}</p>
                                                <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                                            </div>
                                            @if($article->has_document)
                                                <div class="select__one--status list-option"  id="Completed">
                                                    <p data-id="Completed" >{{ __(' Completed ') }}</p>
                                                    <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(@Auth::user()->role === "OPERATOR")
                            <div class="track track-switch">
                                <div class="entry">
                                    <img  class="td-link btn-switch" src="{{asset('assets/image/switch.png')}}" alt="#" data-id={{$article->_id }} >
                                </div>
                            </div>
                            @endif
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

    <div class="modal-upload-file"id="uploadModal">
        @if(isRole(ROLE_OPERATOR))
            <div class="check-login" t-login="true"></div>
        @endif
        <div class="modal-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1 >Legal documents</h1>
            </div>
            <div class="modal-body">
                <div class="row row-upload" id="box_list_file">
                @if(isRole(ROLE_OPERATOR))
                <div class="col-sm-3 col-md-3 col-lg-3 mb-2 items_file btn-uploadfile">
                        <div class="content_file p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="suspected__file__area">
                                    <div class='file-input'>
                                        <input type='file' id="upload" accept="application/pdf" multiple @change="trySubmitFile">
                                        <span class='button'><img class="img-upfile" type="file" src="{{asset('assets/image/input-file.png')}}"  alt=""></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>


    <div class="modalimg">
        <div class="modal-content">
            <div class="div-close">
                <span class="close">&times;</span>
            </div>
            <div class="head-modal">
                <h1 >{{ __('Nature One Dairy Australiar') }}</h1>
            </div>
            <div>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
                </form>
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
</div>

<div class="container-table" id="div-moblie">
    <ul class="container-row-mobile">
        @foreach ($articles as $key => $article)
        <li class="lish-body">
            <a href="/articles/{{$article->_id}}/details" style="text-decoration: none;">
                <div class="lish-child">
                    <div class="media-img">
                        <img src={{ __($article->image ?? '' ) }} class="mr-3" style="width:100px;height:100px" alt="">                           
                    </div>
                    <div class="media-body">
                        <div class="media-body-top">
                            @if(isset($article->detection_result['violation_code']))
                            <?php
                                $botStatus = count($article->detection_result['violation_code']) > 0 && isset($article->detection_result['violation_code'])
                                ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                            ?>
                            @endif
                            <p
                                @class([
                                    'status-title',
                                    'violation-color'   => isViolationStatus($botStatus),
                                    'unviolation-color' => isNoneViolationStatus($botStatus)
                                ])
                                data-status="{{$botStatus}}"                   
                            >{{getStatusText($botStatus)}}</p>

                            <p class="p-style">{{date("d/m/Y",$article->published_date)}}</p>                                   
                        </div>
                        <h3 class="title-style">Nature One Dairy Australia</h3>
                        <h4 class="p-style">Nature One Dairy - Australia</h4>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    <div class="row-pagination">
    {{ $articles->links('layouts.my-paginate') }}
    </div>
</div>




<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
<script src="{{ asset('assets/js/btn_select/selectStatus.js') }}"></script>
<script src="{{ asset('assets/js/modal/modalConfirm.js') }}"></script>
<script src="{{ asset('assets/js/query/queryData.js') }}"></script>

@endsection
