<table class="table_analysis">
    <tr>
        <th>{{ __('No') }}</th>
        <th>{{ __('Brand/Company') }}</th>
        <th>
            <div class="th-title-right flex-space_beetween">
                <p>{{ __('Articles') }}</p>
                <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
            </div>
            </th>
        <th>
            <div class="th-title-right flex-space_beetween">
                <p>{{ __('Violations') }}</p>
                <img class="ico-sort theard-table sort_up" data-date="datePost" src="../assets/image/Archive/up_enable.svg" alt="">
                <img class="ico-sort theard-table sort_down" data-date="datePost" src="../assets/image/Archive/down_enable.svg" alt="">
            </div>
        </th>
        <th>{{ __('Percentage') }}</th>
    </tr>
    @foreach($brandData as $key => $brand)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $brand->name }}</td>
        <td>{{ $brand->total_article }}</td>
        <td>{{ $brand->total_violation_article }}</td>
        <td>{{ $brand->percent_violation_per_article }}%</td>
    </tr>
    @endforeach
</table>
<div class="row-pagination">
    {{ $brandData->links('layouts.my-paginate') }}
</div>