<table class="table_analysis">
<<<<<<< HEAD
    <thead>
        <tr>
            <th>No</th>
            <th style="width: 19.2%;">
            {{ __('Code article') }}
            </th>
            <th style="width: 53.5%;">
            {{ __('Violation type') }}
            </th>
            <th style="width: 14.8%;">
            <div class="th-title-right flex-space_beetween">
                <p>{{ __('Articles') }}</p>
                <span
                    @class([
                        'ico-sort theard-table sort_up',
                        'disabled' => checkSort($params, 'total_article', ASC)
                    ])
                    data-sort-field="total_article" data-sort-value="{{ ASC }}"></span>
                <span
                    @class([
                        'ico-sort theard-table sort_down',
                        'disabled' => checkSort($params, 'total_article', DESC)
                    ])
                    data-sort-field="total_article" data-sort-value="{{ DESC }}"></span>
            </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($codeData as $key => $code)
        <tr>
            <td>
                {{ ($key + 1) + (($codeData->currentpage() - 1) * $codeData->perpage()) }}
            </td>
            <td>{{ $code->name }}</td>
            <td>{{ $code->type_name }}</td>
            <td>{{ $code->total_article }}</td>
        </tr>
        @endforeach
    </tbody>
=======
    <tr>
        <th>No</th>
        <th style="width: 19.2%;">
        {{ __('Code article') }}
        </th>
        <th style="width: 53.5%;">
        {{ __('Violation type') }}
        </th>
        <th style="width: 14.8%;">
        <div class="th-title-right_analysis flex-space_beetween">
            <p>{{ __('Articles') }}</p>
            <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
            <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
        </div>
        </th>
    </tr>
    @foreach($codeData as $key => $code)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $code->name }}</td>
        <td>{{ $code->type_name }}</td>
        <td>{{ $code->total_article }}</td>
    </tr>
    @endforeach
>>>>>>> 8fe4ebc (ui)
</table>
<div class="row-pagination">
    {{ $codeData->links('layouts.my-paginate') }}
</div>
