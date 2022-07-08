<div class="table_analysis">
    <ul class="table_analysis_header head_code">
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
            <li  class="base_code_item type_pc">{{ $code->type_name }}</li>
            <li  class="base_code_item type_mobi" style="color:{{ $code->type_color }}">{{ $code->type_name }}</li>
            <li  class="base_code_item">{{ $code->total_article }}</li>
    </ul>
    @endforeach
</div>
<div class="row-pagination">
    {{ $codeData->links('layouts.my-paginate') }}
</div>
<<<<<<< HEAD
=======
<script>
    var colors = ['#F37422', '#EEBA00', '#EF5DA8', '#0097A0'];
    var divs = $('.type_mobi');
    for (var i = 0; i < divs.length; i++) {
        var color = colors[i % colors.length];
        $(divs[i]).css('color', color);
    };

</script>
>>>>>>> 93d1a07 (fix progress status)
