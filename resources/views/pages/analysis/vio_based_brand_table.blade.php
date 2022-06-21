<table class="table_analysis">
    <thead>
        <tr>
            <th>{{ __('No') }}</th>
            <th>{{ __('Brand/Company') }}</th>
            <th>
                <div class="th-title-right flex-space_beetween">
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
                </th>
            <th>
                <div class="th-title-right flex-space_beetween">
                    <p>{{ __('Violations') }}</p>
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
            </th>
            <th>{{ __('Percentage') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($brandData as $key => $brand)
        <tr>
            <td>
                {{ ($key + 1) + (($brandData->currentpage() - 1) * $brandData->perpage()) }}
            </td>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->total_article }}</td>
            <td>{{ $brand->total_violation_article }}</td>
            <td>{{ $brand->percent_violation_per_article }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row-pagination">
    {{ $brandData->links('layouts.my-paginate') }}
</div>
