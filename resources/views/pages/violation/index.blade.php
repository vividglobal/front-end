@extends('layouts.app')
@section('content')

<div class="list--search--select" >
    <div class="list--title">
        <p>{{ __('Code violation list') }}</p>
    </div>
    @include('pages/components/query', ['list_filter' => [], 'show_all_filter' => true])
    <!-- list Btn  -->
</div>
<div class="container-table">
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
                                                {{-- <a href="{{ getUrlName( "violation_code_id" , $detectioncode['id'] ) }}" id={{ $detectioncode['id'] }}>
                                                    {{$detectioncode['name'] ?? ''}}
                                                </a> --}}
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
                                @if(@Auth::user()->role === "OPERATOR")
                                    <select class="list--select-right" id="cars">
                                        <option class="list-option" value="Select">Not started</option>
                                        <option class="list-option" value="Processing">Processing</option>
                                        @if($article->has_document)
                                        <option class="list-option" value="Completed">Completed</option>
                                        @endif
                                    </select>
                                @else
                                    <select class="list--select-right disabled-select" id="cars" disabled>
                                        <option value="Select">Not started</option>
                                        <option value="Processing">Processing</option>
                                        @if($article->has_document)
                                        <option value="Completed">Completed</option>
                                        @endif
                                    </select>
                                @endif
                                </div>
                            </div>
                            @if(@Auth::user()->role === "OPERATOR")
                            <div class="track track-switch">
                                <div class="entry">
                                    <img  class="td-link btn-switch" src="../assets/image/switch.png" alt="#" data-id={{$article->_id }} >
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
    <div class="row-pagination">
        {{ $articles->links('layouts.my-paginate') }}
    </div>
    <div class="modal-upload-file"id="uploadModal">
    @if(isRole(ROLE_OPERATOR) || isRole(ROLE_SUPERVISOR))
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
                <div class="row " id="box_list_file">

                @if(@Auth::user()->role === "OPERATOR" || @Auth::user()->role === "SUPERVISOR")
                <div class="col-sm-3 col-md-3 col-lg-3 mb-2 items_file btn-uploadfile">
                        <div class="content_file p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="suspected__file__area">
                                    <div class='file-input'>
                                        <input type='file' id="upload" accept="application/pdf" multiple @change="trySubmitFile">
                                        <span class='button'><img class="img-upfile" type="file" src="../assets/image/input-file.png"  alt=""></span>
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
                <p>Are you sure moving this post to auto-detect violations link?</p>
            </div>
            <div class="head-confirm-btn">
                <button class="confirm-btn btn-cancel close">Cancel</button>
                <button class="confirm-btn btn-yes" id="confirm-yes">Yes</button>
            </div>
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
