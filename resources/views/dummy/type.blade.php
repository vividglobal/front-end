@extends('layouts.app')

@section('content')

<div class="grid">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= VIOLATION TYPE =================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <legend>Violation Types</legend>
            <button class="btn btn-primary" type="button">Add</button>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($violationTypes as $key => $type)
                    <tr>
                        <td>
                            <textarea class="form-control">{{ $type->name }}</textarea>
                        </td>
                        <td>
                            <button class="btn btn-success" type="button">Save</button>
                        </td>
                        <td>
                            <form action="violation-types/{{ $type->_id }}" method="post">
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