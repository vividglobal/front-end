<div class="list--select--option <?php if($_SERVER['REQUEST_URI'] == "/analysis"){} ?> btn_analysis <?php ?>">
            <div class="list--select__left" >
            @if($_SERVER['REQUEST_URI']!= "/analysis")
                <div class="list--search">
                    <img src="{{ asset('assets/image/search.svg') }}" alt="" class="btn-search">
                    <input type="text" placeholder="Search" class="search">
                </div>
                    <div id="daterange">
                        <i class="ico-date"></i>
                        <img src="{{ asset('assets/image/calendar.svg') }}" alt="">
                        <input type="text" class="form--daterange" name="daterange"  placeholder="Select Date" autocomplete="off" readonly/>
                    </div>
            @endif
            @include('pages/components/Brand')
            @include('pages/components/Country')
            @include('pages/components/ViolationType')

            @if($_SERVER['REQUEST_URI']!= "/analysis")
                    <button class="btn__apply">Apply</button>
            @endif
            </div>
            @if($_SERVER['REQUEST_URI']!= "/analysis")
                <div class="list--select__right">
                    <p>Showing</p>
                    <div class="list--showing">
                        <select name="" id="">
                                    <!-- HTML -->
                        </select>
                    </div>
                        @auth
                            <a href="{{ getExportUrl() }}" target="_blank"
                            class="btn--export--excel">
                                    <p>Export Excel</p>
                            </a>
                        @endauth
                </div>
            @endif
</div>

