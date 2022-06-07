@extends('layouts.app')

@section('content')

<div class="grid">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= COUNTRIES ======================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <legend>Countries</legend>
            <button class="btn btn-primary" type="button">Add</button>
            <table class="table">
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
                    <tr>
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
                            <form action="countries/{{ $country->_id }}" method="post">
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
    
</div>
@endsection