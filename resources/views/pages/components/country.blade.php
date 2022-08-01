<div class="list--country ctr_general " id="btn-language">
    <img src="{{asset('assets/image/Country.svg')}}" alt="">
    <p></p>
    <img src="{{asset('assets/image/Under-than.svg')}}" alt="">
    <div class="select--country slc_general country_pc" id="language">
        <div class="search--input--country search_general" id="div-search">
            <img src="{{asset('assets/image/search.svg')}}" alt="">
            <input type="text" placeholder="Search for country" class="search--country" id="language-search">
        </div>
        <div class="contain--selection">
            <div class="select__one--country option_general  " id=0>
                <p data-id=0 >{{ __('-Select country-') }}</p>
                <img src="{{asset('assets/image/tickV.svg')}}" alt="">
            </div>
            @foreach ($countries as $country)
                <div class="select__one--country option_general  " id="{{$country->_id}}">
                    <p  data-id={{$country->_id}}>{{$country->name}}</p>
                    <img src="{{asset('assets/image/tickV.svg')}}" alt="">
                </div>
            @endforeach
            @include('noSearchResult.search_filter')
        </div>
    </div>
</div>

