<div class="table_analysis">
    <ul class="table_analysis_header head_code">
        <li class="base_code_item">No</li>
        <li  class="base_code_item">{{ __('Violation type') }}</li>
        <li  class="base_code_item">{{ __('Code article') }}</li>
        <li  class="base_code_item">
            <div class="th-title-rights">
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
    </ul>
    @foreach($codeData as $key => $code)
    <ul class="table_analysis_body">
            <li  class="base_code_item updata-form-analysis">
                {{ ($key + 1) + (($codeData->currentpage() - 1) * $codeData->perpage()) }}
            </li>
            <li  class="base_code_item type_pc updata-form-analysis" style="color:{{ $code->type_color }}">{{ $code->type_name }}</li>
            <li  class="base_code_item updata-form-analysis">{{ $code->name }}</li>
            <li  class="base_code_item type_mobi updata-form-analysis" style="color:{{ $code->type_color }}">{{ $code->type_name }}</li>
            <li  class="base_code_item total_code updata-form-analysis">{{ $code->total_article }}</li>
    </ul>
    @endforeach
</div>
<div class="row-pagination">
    {{ $codeData->links('layouts.my-paginate') }}
</div>
