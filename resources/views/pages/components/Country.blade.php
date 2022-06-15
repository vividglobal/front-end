<div class="list--country" id="btn-language">
    <img src="{{ asset('assets/image/Country.svg') }}" alt="">
    <p>Country</p>
    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">
    <div class="select--country" id="language">
        <div class="search--input--country" id="div-search">
            <img src="{{ asset('assets/image/search.svg') }}" alt="">
            <input type="text" placeholder="Search for country" class="search--country" id="language-search">
        </div>
        <div class="contain--selection">
                    <div class="select__one--country">
                        <p data-id=0 >-Select country-</p>
                        <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
                    </div>
                @foreach ($countries as $country)
                    <div class="select__one--country">
                        <p data-id={{$country->_id}}>{{$country->name}}</p>
                        <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
                    </div>
                @endforeach
        </div>
    </div>
</div>
