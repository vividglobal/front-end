<div class="list--company--brand">
    <img src="{{asset('assets/image/brand-tag.svg')}}" alt="">
    <p></p>
    <img src="{{asset('assets/image/Under-than.svg')}}" alt="">
    <div class="select--company-or-brand brand_pc" id="toggle">
        <div class="search--input">
            <img src="{{asset('assets/image/search.svg')}}" alt="">
            <input type="text" placeholder="Search for Brand" class="search--brand">
        </div>
        <div class="contain--selection">
            <div class="select__one" id=0>
                <p  data-id=0>{{ __('- Select brand -') }}</p>
                <img src="{{asset('assets/image/tickV.svg')}}" alt="">
            </div>
            @foreach ($brands as $brand)
                <div class="select__one" id={{$brand->_id}}>
                    <p  data-id={{$brand->_id}}>{{$brand->name}}</p>
                    <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                </div>
            @endforeach
            @include('noSearchResult.search_filter')
        </div>
    </div>
</div>

