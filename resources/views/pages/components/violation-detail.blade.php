@extends('layouts.app')

@section('content')


<div class="container-table container-table-mobile" id="">
    <div class="container-row-mobile">
        <div class="list-child">
            <div class="lish-top">
                <img class="history-back" src="{{ asset('assets/image/back.png') }}" alt="">
                <h1 class="lish-title-style">{{ __($article->brand['name'] ?? '' )}}</h1>
            </div>
        @if($article->image)
                @if(isset($article->gallery))
                <div class="slideshow-container">
                    @foreach ($article->gallery as $detectionCode)
                    <div class="mySlides fadeimg">
                        <div style="display: flex;justify-content: center;">
                        <img  src={{($detectionCode)}} style="max-width: 88%;margin-bottom: 15px;max-height: 350px;">
                        </div>
                    </div>
                    @endforeach
                </div>
                @if(count($article->gallery) > 1)
                    <a class="prevslide mobleprevnext" onclick="plusSlides(-1)">❮</a>
                    <a class="nextslide mobleprevnext" onclick="plusSlides(1)">❯</a>
                @endif
                @else
                <img  src={{ __($article->image ?? '' ) }} style="max-width: 100%;margin-bottom: 15px;">
                @endif
            @else
            <img  style="width:100%;margin-bottom: 15px;"  src="{{ asset('assets/image/no-image.jpeg') }}" >
            @endif
            <div class="media-body-top">
                @if(isset($article->detection_result['violation_code']))
                    <?php
                        $botStatus = count($article->detection_result['violation_code']) > 0 && isset($article->detection_result['violation_code'])
                        ? STATUS_VIOLATION : STATUS_NONE_VIOLATION;
                    ?>
                    @endif
                    <p class="status-title violation-color" data-status="VIOLATION">Violation</p>
                <div class="media-link" id="copy-link"  link-copy={{$article -> link ?? '' }}>
                    <img src="{{ asset('assets/image/link_dark_gray.svg') }}" alt="">
                    <p>Copy URL</p>
                </div>
            </div>
            <ul class="detail-info">
                <li class="detail-infoi detail-infoi-left">
                    <a href="{{ url()->previous() }}">
                        <img  class="img-icon-detail" src="{{ asset('assets/image/tem.png') }}" alt="">
                    </a>
                    <div>
                        <h4 class="p-style">Company</h4>
                        <h4 class="h4-title">{{ __($article->company['name'] ?? '' )}}</h4>
                    </div>
                </li>
                <li class="detail-infoi detail-infoi-right">
                    <img class="img-icon-detail" src="{{ asset('assets/image/td.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Country</h4>
                        <h4 class="h4-title">{{ __($article->country['name'] ?? '' )}}</h4>
                    </div>
                </li>
                <li class="detail-infoi detail-infoi-left">
                    <img class="img-icon-detail" src="{{ asset('assets/image/date.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Published date</h4>
                        @isset($article->published_date)
                        <h4 class="h4-title">{{date("m-d-Y",$article->published_date)}}</h4>
                        @endisset
                    </div>
                </li>
                <li class="detail-infoi detail-infoi-right">
                    <img class="img-icon-detail" src="{{ asset('assets/image/date.png') }}" alt="">
                    <div>
                        <h4 class="p-style">Review date</h4>
                        <h4 class="h4-title">{{date("m-d-Y",$article->operator_review['review_date'] )}}</h4>
                    </div>
                </li>
            </ul>
            <div style="overflow-wrap: break-word;">
                <p class="detail-content">
                    {{$article -> caption}}
                </p>
            </div>
            <h3 class="title-style title-style-checking">Violation checking</h3>
            <div class="table-code">
            @if(($article->operator_review['violation_code']))
                <div class="table-code-aticle">
                    <img class="img-icon-detail" src="{{ asset('assets/image/dis-code.png') }}" alt="">
                    <div>
                        @if(isset($article->operator_review['violation_code']))
                            <h4 class="p-style">Code article</h4>
                            @foreach ($article->operator_review['violation_code'] as $detectionCode)
                                <div>
                                    <h4 class="h4-title" href="{{ getUrlName( "violation_code_id" , $detectionCode['id'] ) }}" id={{ $detectionCode['id'] }}>
                                        {{$detectionCode['name'] ?? ''}}
                                    </h4>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="table-code-tile">
                    @if(isset($article->operator_review['violation_types']))
                        @foreach ($article->operator_review['violation_types'] as $detectionType)
                            <div style="display: flex;align-items: center;">
                                <div class="color-circle-big" >
                                    <div class="color-circle" style="background-color:{{$detectionType['color'] ?? ''}}"></div>
                                </div>
                                <h4 class="p-style">{{$detectionType['name'] ?? ''}}</h4>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif
            </div>
        </div>
        <div class="list-child-function">
            @if(Auth::user())
            <div class="list-child-top">
                <h3 class="title-style status-leal">Status progress</h3>
                <div class="list--status list--status-mobile {{@Auth::user()->role !== "OPERATOR" ? "none_list-status" : ""}}"
                data-idEL="{{ $article->_id }}" id="status_1" data-role="{{@Auth::user()->role}}">
                    @if(isset($article->progress_status) && $article->progress_status != "")
                        @if($article->progress_status == "NOT_STARTED" || $article->progress_status == "PENDING")
                            <p class="updata-form" data-id="not_started" >{{ __("Not started") }}</p>
                        @elseif($article->progress_status == "PROCESSING" )
                            <p class="updata-form" data-id="Processing" >{{ __("Processing") }}</p>
                        @elseif($article->progress_status == "COMPLETED")
                            <p class="updata-form" data-id="Completed" >{{ __(' Completed ') }}</p>
                        @endif
                    @else
                        <p data-id="not_started" >{{ __("Not started") }}</p>
                    @endif

                    @if(isRole(ROLE_OPERATOR))
                        <img src="{{asset('assets/image/Under-than.svg')}}" alt="">
                    @endif
                    <div class="select--status select--status-moblie violation_pc" id="toggle">
                        <div class="select__one--status list-option"  id="not_started">
                            <p class="updata-form" data-id="not_started" >{{ __("Not started") }}</p>
                            <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                        </div>
                        <div class="select__one--status list-option"  id="Processing">
                            <p class="updata-form" data-id="Processing" >{{ __("Processing") }}</p>
                            <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                        </div>
                        <div class="select__one--status list-option completed"  id="Completed">
                            <p class="updata-form" data-id="Completed" >{{ __(' Completed ') }}</p>
                            <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(isRole(ROLE_OPERATOR))
            <div class="list-child-top">
                <h3 class="title-style status-leal">Switch status</h3>
                <img  class="td-link btn-switch-mobile" src="{{asset('assets/image/switch-mobile.png')}}" alt="#" data-id={{$article->_id }} >
            </div>
            @endif
            <div class="list-child-top">
                <h3 class="title-style status-leal">Legal documents</h3>
                <img class="td-link upload-file-mobile" data-id={{$article->_id}} src={{ asset('assets/image/ico-upload-mobile.png') }} data-user="{{@Auth::user()->role}}">
            </div>
        </div>
    </div>
</div>

<div class="modal-confirm-title modal-confirm-title-mobile">
    <div class="modal-confirm-content modal-confirm-content-mobile">
        <div class="head-confirm">
            <h1>Confirmation</h1>
            <p class="title-modal-style" style="text-align: center;">Switch status successfully</p>
        </div>
        <div class="head-confirm-btn">
            <button class="confirm-btn btn-cancel close button-cancel-style">Cancel</button>
            <button class="confirm-btn btn-yes" id="confirm-mobile">Confirm</button>
        </div>
    </div>
</div>

<div class="modal-upload-file"id="uploadModal">
        @if(isRole(ROLE_OPERATOR))
            <div class="check-login" t-login="true"></div>
        @endif
    <div class="modal-body-mobile">
        <div class="head-modal" style="margin-top: 20px;">
            <h1 class="modal-tile-uploadfile">Legal documents</h1>
        </div>
        <div class="modal-file-data" id="add-file">

        </div>
        <div class="no_files">

        </div>
    </div>
    @if(isRole(ROLE_OPERATOR))
    <div class="head-confirm-btn button-upload-file">
        <button class="confirm-btn btn-cancel close button-upload-style button-cancel-style">Cancel</button>
        <!-- <input type='file' class="confirm-btn btn-yes" id="confirm-mobile" accept="application/pdf" multiple @change="trySubmitFile"></input> -->
        <div class='file-input input-style file-input-mobile button-upload-style'>
            <input type='file' id="upload" accept="application/pdf" @change="trySubmitFile" multiple>
            <span class='button' >Upload file</span>
        </div>
    </div>
    @else
    <div class="head-confirm-btn button-upload-file button-upload-cancel">
        <button class="confirm-btn btn-cancel close btn-cancel-moblie button-cancel-style" style="margin-bottom: 10px;">Cancel</button>
    </div>
    @endif
</div>



@push('styles')
    <link href="{{ asset('assets/css/autodetect/article-detail-desktop.css') }}" rel="stylesheet">
@endpush
<!-- <script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/btn_select/selectStatus.js') }}"></script> -->
<script src="{{ asset('assets/js/query/queryData.js') }}"></script>
<script src="{{ asset('assets/js/pages/violation-detail.js')}}"></script>
<script src="{{ asset('assets/js/pages/slineimg.js') }}"></script>
@endsection
