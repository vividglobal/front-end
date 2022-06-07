@extends('layouts.app')

@section('content')
<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/dummy/articles">Articles</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/dummy/violation-types">Violation Types</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/dummy/violation-code">Violation Codes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/dummy/countries">Countries</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/dummy/company-brands">Company Brand</a>
    </li>
</ul>
@endsection