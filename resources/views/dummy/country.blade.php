@extends('layouts.dummy')

@section('content')

<div class="container">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= COUNTRIES ======================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <h1>Countries</h4>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <button class="btn btn-primary" type="button">Add</button>
                </li>
            </ul>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">List URL</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $key => $country)
                    <tr data-id="{{ $country->_id }}">
                        <td>
                            <textarea class="form-control">{{ $country->name }}</textarea>
                        </td>
                        <td>
                            <textarea rows="10" class="form-control">{{ implode(', ', $country->list_url) }}</textarea>
                        </td>
                        <td>
                            <button class="btn btn-success" type="button">Save</button>
                        </td>
                        <td>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div> <!-- End of row -->
    
</div>
@endsection