<div class="list--select--option">
            <div class="list--select__left">
                <div class="list--search">
                    <img src="{{ asset('assets/image/search.svg') }}" alt="" class="btn-search">
                    <input type="text" placeholder="Search" class="search">
                </div>
                    <div id="daterange">
                        <i class="ico-date"></i>
                        <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                        <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                    </div>
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
                                <!-- HTML -->
                            </div>
                    </div>
                </div>

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
                                <!-- HTML -->
                        </div>
                    </div>
                </div>
                <div class="list--violation--type">
                    <img src="{{ asset('assets/image/type.svg') }}" alt="">
                    <p>Violation type</p>
                    <img src="{{ asset('assets/image/Under-than.svg') }}" alt="">

                    <div class="select--violation--type" id="toggle">
                                <!-- HTML -->
                    </div>
                </div>
                    <button class="btn__apply">Apply</button>
            </div>
            <div class="list--select__right">
                <p>Showing</p>
                <div class="list--showing">
                    <select name="" id="">
                                <!-- HTML -->
                    </select>
                </div>
                @auth
                <div class="btn--export--excel">
                    <p>Export Excel</p>
                </div>
                @endauth
            </div>
</div>
