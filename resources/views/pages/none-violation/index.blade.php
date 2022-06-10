@extends('layouts.app')

@section('content')
<div class="list--search--select" >
        <div class="list--title">
            <p>Violation list</p>
        </div>
        <!-- list Btn  -->
        @include('pages/components/query')

</div>
<div class="row">
    <div class="col-12">
        <legend>List Articles</legend>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Company</th>
                <th scope="col">Country</th>
                <th scope="col">Brand</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Detection Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $key => $article)
                <tr>
                    <td>
                        {{ $article->company }}
                    </td>
                    <td>
                        {{ $article->country }}
                    </td>
                    <td>
                        {{ $article->brand }}
                    </td>
                    <td>
                        {{ $article->link }}
                    </td>
                    <td>
                        {{ $article->status }}
                    </td>
                    <td>
                        {{ $article->detection_type }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
