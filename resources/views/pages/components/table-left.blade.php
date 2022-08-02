<table class="tbdata col-table">
    <thead class="col-thead">
        <tr>
            <th style="width:2%" class="style-title">{{ __('No') }}</th>
            <th style="width:12%" class="style-title">
                <div class="th-title-right sort_country">
                    <p>{{ __('Country') }}</p>
                    <span
                        @class([
                            'ico-sort theard-table sort_up',
                            'disabled' => checkSort(request()->all(), 'country_name', ASC)
                        ])></span>
                    <span
                        @class([
                            'ico-sort theard-table sort_down',
                            'disabled' => checkSort(request()->all(), 'country_name', DESC)
                        ])></span>
                </div>
            </th>
            <th style="width:12%" class="style-title">
                <div class="th-title-right sort_company">
                    <p>{{ __('Company') }}</p>
                    <span
                        @class([
                            'ico-sort theard-table sort_up',
                            'disabled' => checkSort(request()->all(), 'company_name', ASC)
                        ])></span>
                    <span
                        @class([
                            'ico-sort theard-table sort_down',
                            'disabled' => checkSort(request()->all(), 'company_name', DESC)
                        ])></span>
                </div>
            </th>
            
            <th style="width:12%" class="style-title sort_brand">
                <div class="th-title-right">
                    <p>{{ __('Brand') }}</p>
                    <span
                        @class([
                            'ico-sort theard-table sort_up',
                            'disabled' => checkSort(request()->all(), 'brand_name', ASC)
                        ])></span>
                    <span
                        @class([
                            'ico-sort theard-table sort_down',
                            'disabled' => checkSort(request()->all(), 'brand_name', DESC)
                        ])></span>
                </div>
            </th>
            <th style="width:15%" class="style-title">{{ __('Caption') }}</th>
            <th style="width:15%" class="style-title">{{ __('Image') }}</th>
        </tr>
    </thead>
    <tbody class="tbdata" id="children-length">
        @foreach ($articles as $key => $article)
            <tr class="tr-boder" data-id="{{ $article->_id }}">
                <td>{{ ($key + 1) + (($articles->currentpage() - 1) * $articles->perpage()) }}</td>
                <td>
                @isset($article->country['name'])
                    <a href={{ getUrlName( "country" , $article->country['id']) }} class="updata-form">
                    {{ __($article->country['name'] ?? '' )}}
                    </a>
                @endisset
                </td>
                <td>
                @isset($article->company['name'])
                    <a  href={{ __(getUrlName("company_brand_id",$article->company['id'])) }} class="updata-form">
                        {{ __($article->company['name'] ?? '' )}}
                    </a>
                @endisset
                </td>
                <td>
                @isset($article->brand['name'])
                    <a class="brand-name updata-form"  href={{ getUrlName( "company_brand_id" , $article->brand['id']) }}>
                        {{ __($article->brand['name'] ?? '' )}}
                    </a>
                @endisset
                </td>
                <td class="contenttb btn-caption"><a class="updata-form">{{ __($article->caption ?? '' ) }}</a></td>
                <td>
                    <div class="wr-img">
                    <img class="links-img" attr-img="
                        @if(isset($article->gallery))
                            @foreach ($article->gallery as $detectionCode)
                        {{$detectionCode}};
                            @endforeach
                        @endif;
                        ">
                        @if($article->image)
                        <img class="td-img clickimg lazy" data-id={{$article->id}} data-original={{ __($article->image ?? '' ) }}>
                        @else
                        <img class="td-img no-img" src="{{ asset('assets/image/no-image.jpeg') }}" >
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="modal-title open-modal" id="captionModal">
    <div class="modal-content">
        <div class="div-close">
            <span class="close">&times;</span>
        </div>
        <div class="head-modal">
            <h1></h1>
        </div>
        <div style="
            overflow-wrap: break-word;
            max-height: 30%;
            overflow-y: auto;
            ">
                <p class="title-modal updata-form"></p>
        </div>
    </div>
</div>

<div class="modalimg open-modal" id="imageModal">
    <div class="modal-content modal-content-img">
        <div class="div-close">
            <span class="close">&times;</span>
        </div>
        <div class="head-modal">
            <h1></h1>
        </div>
        <div class="img-sline">
            <img class="modal-img img-disabled">
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/pages/slineimg.js') }}"></script>


