<table class="tbdata col-table">
    <thead class="col-thead">
        <tr>
            <th style="width:2%" class="style-title">{{ __('No') }}</th>
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
    <tbody class="tbdata">
        @foreach ($articles as $key => $article)
            <tr class="tr-boder" data-id="{{ $article->_id }}">
                <td>{{ ($key + 1) + (($articles->currentpage() - 1) * $articles->perpage()) }}</td>
                <td>
                @isset($article->company['name'])
                    <a  href={{ __(getUrlName("company_brand_id",$article->company['id'])) }}>
                        {{ __($article->company['name'] ?? '' )}}
                    </a>
                @endisset
                </td>
                <td>
                @isset($article->country['name'])
                    <a  href={{ getUrlName( "country" , $article->country['id']) }}>
                    {{ __($article->country['name'] ?? '' )}}
                    </a>
                @endisset
                </td>
                <td>
                @isset($article->brand['name'])
                    <a class="brand-name"  href={{ getUrlName( "company_brand_id" , $article->brand['id']) }}>
                        {{ __($article->brand['name'] ?? '' )}}
                    </a>
                @endisset
                </td>
                <td class="contenttb btn-caption"><a>{{ __($article->caption ?? '' ) }}</a></td>
                <td>
                    <div class="wr-img">
                        <img class="td-img clickimg lazy" data-original={{ __($article->image ?? '' ) }} alt="">
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
        <p class="title-modal"></p>
    </div>
</div>

<div class="modalimg open-modal" id="imageModal">
    <div class="modal-content">
        <div class="div-close">
            <span class="close">&times;</span>
        </div>
        <div class="head-modal">
            <h1></h1>
        </div>
        <div>
            <img class="modal-img">
        </div>
    </div>
</div>
