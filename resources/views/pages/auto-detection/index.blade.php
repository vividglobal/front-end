@extends('layouts.app')

@section('content')
<div class="row-a">
    <div class="list--search--select" >
        <div class="list--title">
            <p>Auto-detect violations</p>
        </div>
        <!-- list Btn  -->
        @include('pages/components/query', ['list_filter' => ["search","date","brand","violation","country","apply","excel","fillter_mobile"], 'show_all_filter' => false])
    </div>
        <!-- Table -->
        @include('pages/components/table-detect-label', compact('violationCode'))
    </div>
</div>
<script src="{{ asset('assets/js/autodetect/scroll.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/modal.js') }}"></script>
<script src="{{ asset('assets/js/autodetect/syncscroll.js') }}"></script>
<script src="{{ asset('assets/js/query/queryData.js') }}"></script>

@endsection
