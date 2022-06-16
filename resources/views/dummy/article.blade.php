@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- ========================================================== -->
        <!-- ========================== ARTICLES ====================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <legend>Create dummy article data</legend>
            <form method="post" action="/dummy/articles">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Company</label>
                    <select class="form-select" name="company" aria-label="Default select example">
                        @foreach ($companies as $key => $company)
                        <option value="{{ $company->name }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <select class="form-select" name="country" aria-label="Default select example">
                        @foreach ($countries as $key => $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <select class="form-select" name="brand" aria-label="Default select example">
                        @foreach ($companies as $key => $company)
                        <option value="{{ $company->name }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Caption</label>
                    <textarea class="form-control" name="caption" ></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image (Url)</label>
                    <input type="text" class="form-control" name="link" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" aria-label="Default select example">
                        <option value="PENDING">PENDING</option>
                        <option value="VIOLATION">VIOLATION</option>
                        <option value="NON_VIOLATION">NON_VIOLATION</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Detection type</label>
                    <select class="form-select" name="detection_type" aria-label="Default select example">
                        <option value="BOT">BOT</option>
                        <option value="MANUAL">MANUAL</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>  <!-- End of col 12 -->

        <!-- ========================================================== -->
        <!-- ======================= LIST =================== -->
        <!-- ========================================================== -->
        <hr class="mb-3 mt-3">
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
                        <td>
                            <form action="/dummy/articles/{{ $article->_id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> <!-- End of row -->
@endsection
