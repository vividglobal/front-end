<div class="table_analysis table_brand">
    <ul class="table_analysis_header header_brand">
        <li >{{ __('No') }}</li>
        <li>{{ __('Brand/Company') }}</li>
        <li>
            <div class="th-title-rights ">
                <p>{{ __('Entries') }}</p>
                <span
                    @class([
                        'ico-sort theard-table sort_up',
                        'disabled' => checkSort(request()->all(), 'total_article', ASC)
                    ])
                    data-sort-field="total_article" data-sort-value="{{ ASC }}"></span>
                <span
                    @class([
                        'ico-sort theard-table sort_down',
                        'disabled' => checkSort(request()->all(), 'total_article', DESC)
                    ])
                    data-sort-field="total_article" data-sort-value="{{ DESC }}"></span>
            </div>
        </li>
        <li>
            <div class="th-title-rights ">
                <p>{{ __('Violations') }} </p>
                <span
                    @class([
                        'ico-sort theard-table sort_up',
                        'disabled' => checkSort(request()->all(), 'total_violation_article', ASC)
                    ])
                    data-sort-field="total_violation_article" data-sort-value="{{ ASC }}"></span>
                <span
                    @class([
                        'ico-sort theard-table sort_down',
                        'disabled' => checkSort(request()->all(), 'total_violation_article', DESC)
                    ])
                    data-sort-field="total_violation_article" data-sort-value="{{ DESC }}"></span>
            </div>
        </li>
        <li>
            <div class="th-title-rights ">
                <p>{{ __('Percentage') }}</p>
                <span
                @class([
                    'ico-sort theard-table sort_up',
                    'disabled' => checkSort(request()->all(), 'percent_violation_per_article', ASC)
                ])
                data-sort-field="percent_violation_per_article" data-sort-value="{{ ASC }}"></span>
                <span
                @class([
                    'ico-sort theard-table sort_down',
                    'disabled' => checkSort(request()->all(), 'percent_violation_per_article', DESC)
                ])
                data-sort-field="percent_violation_per_article" data-sort-value="{{ DESC }}"></span>
            </div>
        </li>
    </ul>
    @foreach($brandData as $key => $brand)
        <ul class="table_analysis_body">
            <li class="item_base_on_brand updata-form">
                {{ ($key + 1) + (($brandData->currentpage() - 1) * $brandData->perpage()) }}
            </li>
            <li class="item_base_on_brand updata-form">{{ $brand->name }}</li>
            <div class="res_item_brand">
                <li class="item_base_on_brand updata-form">{{ $brand->total_article }}</li>
                <li class="item_base_on_brand updata-form">{{ $brand->total_violation_article }}</li>
                <li class="item_base_on_brand updata-form">{{ $brand->percent_violation_per_article }}%</li>
            </div>
        </ul>
        @endforeach
</div>
<div class="row-pagination">
    {{ $brandData->links('layouts.my-paginate') }}
</div>
