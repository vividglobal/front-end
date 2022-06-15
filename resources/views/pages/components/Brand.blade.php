<div class="list--company--brand">
    <img src="{{ asset('assets/image/brand-tag.svg') }}" alt="">
    <p>Brand/Company</p>
    <img src="{{ asset('assets/image/under-than.svg') }}" alt="">
    <div class="select--company-or-brand" id="toggle">
        <div class="search--input">
            <img src="{{ asset('assets/image/search.svg') }}" alt="">
            <input type="text" placeholder="Search for Brand" class="search--brand">
        </div>
        <div class="contain--selection">
            <div class="select__one">
                <p data-id=0>- Select brand -</p>
                <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
            </div>
            @foreach ($brands as $brand)
                <div class="select__one">
                    <p data-id={{$brand->_id}}>{{$brand->name}}</p>
                    <img src="http://localhost:8099/assets/image/tickV.svg" alt="">
                </div>
            @endforeach
        </div>
    </div>
</div>
