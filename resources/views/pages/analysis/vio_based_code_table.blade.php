<div class="table_analysis">
    <ul class="table_analysis_header">
        <li class="base_code_item">No</li>
        <li  class="base_code_item">{{ __('Code article') }}</li>
        <li  class="base_code_item">{{ __('Violation type') }}</li>
        <li  class="base_code_item">
            <div class="th-title-rights">
                <p>{{ __('Articles') }}</p>
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
    </ul>
    @foreach($codeData as $key => $code)
    <ul class="table_analysis_body">
            <li  class="base_code_item">
                {{ ($key + 1) + (($codeData->currentpage() - 1) * $codeData->perpage()) }}
            </li>
            <li  class="base_code_item">{{ $code->name }}</li>
            <li  class="base_code_item">{{ $code->type_name }}</li>
            <li  class="base_code_item">{{ $code->total_article }}</li>
    </ul>
    @endforeach
</div>
<div class="row-pagination">
    {{ $codeData->links('layouts.my-paginate') }}
</div>
