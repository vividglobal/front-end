{{-- SORT FOR MOBILE --}}

<div class="checkbox_list_sort" id="toggle">
    @if(!request ()-> is ('analysis'))
        <div class="sort_value">
            <label class="container_checkbox asc" > <p data-value="A to Z">A to Z</p>
                <input type="checkbox" name="radio" class="input_checkbox">
                <span class="checkmark_checkbox"></span>
            </label>
            <label class="container_checkbox desc" > <p data-value="Z to A">Z to A</p>
                <input type="checkbox" name="radio" class="input_checkbox">
                <span class="checkmark_checkbox"></span>
            </label>
        </div>
        <div class="sort_by">
            <label class="container_checkbox" id="company_name" > <p data-by="company_name">Company</p>
                <input type="checkbox" name="radio" class="input_checkbox">
                <span class="checkmark_checkbox"></span>
            </label>
            <label class="container_checkbox" id="country_name" > <p data-by="country_name">Country</p>
                <input type="checkbox" name="radio" class="input_checkbox">
                <span class="checkmark_checkbox"></span>
            </label>
            <label class="container_checkbox" id="brand_name" > <p data-by="brand_name">Brand</p>
                <input type="checkbox" name="radio" class="input_checkbox">
                <span class="checkmark_checkbox"></span>
            </label>
            <label class="container_checkbox" id="published_date" > <p data-by="published_date">Published date</p>
                <input type="checkbox" name="radio" class="input_checkbox">
                <span class="checkmark_checkbox"></span>
            </label>
            <label class="container_checkbox" id="crawl_date" > <p data-by="crawl_date">Crawl date</p>
                <input type="checkbox" name="radio" class="input_checkbox">
                <span class="checkmark_checkbox"></span>
            </label>
            @auth
                @if(request ()-> is ('articles/auto-detection') || request ()-> is ('articles/manual-detection'))
                    <label class="container_checkbox" id="bot_status" > <p data-by="bot_status">VIVID's status</p>
                        <input type="checkbox" name="radio" class="input_checkbox">
                        <span class="checkmark_checkbox"></span>
                    </label>
                    <label class="container_checkbox" id="supervisor_status" > <p data-by="supervisor_status">Supervisor's status</p>
                        <input type="checkbox" name="radio" class="input_checkbox">
                        <span class="checkmark_checkbox"></span>
                    </label>
                    @if(@Auth::user()->role === "OPERATOR")
                    <label class="container_checkbox" id="operator_status" > <p data-by="operator_status">Operator's status</p>
                        <input type="checkbox" name="radio" class="input_checkbox">
                        <span class="checkmark_checkbox"></span>
                    </label>
                    @endif
                @endif
            @endauth
            @if(request ()-> is ('articles/violation'))
                <label class="container_checkbox" id="sort_penalty_issued" > <p data-by="sort_penalty_issued">Penalty issued</p>
                    <input type="checkbox" name="radio" class="input_checkbox">
                    <span class="checkmark_checkbox"></span>
                </label>
            @endif
        </div>
        @else
            <div class="sort_based_on_brands">
                <p>Sort based on brand</p>
                <label class="container_checkbox" > <p data-sort-field="total_article" data-sort-value="ASC" data-table="vio-based-brand">Article: Sort Ascending</p>
                    <input type="checkbox" name="radio" class="input_checkbox">
                    <span class="checkmark_checkbox"></span>
                </label>
                <label class="container_checkbox" > <p data-sort-field="total_article" data-sort-value="DESC" data-table="vio-based-brand">Article: Sort Descending</p>
                    <input type="checkbox" name="radio" class="input_checkbox">
                    <span class="checkmark_checkbox"></span>
                </label>
                <label class="container_checkbox" > <p data-sort-field="total_violation_article" data-sort-value="ASC" data-table="vio-based-brand">Violation: Sort Ascending</p>
                    <input type="checkbox" name="radio" class="input_checkbox">
                    <span class="checkmark_checkbox"></span>
                </label>
                <label class="container_checkbox" > <p data-sort-field="total_violation_article" data-sort-value="DESC" data-table="vio-based-brand">Violation: Sort Descending</p>
                    <input type="checkbox" name="radio" class="input_checkbox">
                    <span class="checkmark_checkbox"></span>
                </label>
            </div>
            <div class="sort_based_on_code">
                <p>Sort based on code</p>
                <label class="container_checkbox" > <p data-sort-field="total_article" data-sort-value="ASC" data-table="vio-based-code">Article: Sort Ascending</p>
                    <input type="checkbox" name="radio" class="input_checkbox">
                    <span class="checkmark_checkbox"></span>
                </label>
                <label class="container_checkbox" > <p data-sort-field="total_article" data-sort-value="DESC" data-table="vio-based-code">Article: Sort Descending</p>
                    <input type="checkbox" name="radio" class="input_checkbox">
                    <span class="checkmark_checkbox"></span>
                </label>
            </div>
        @endif
</div>
