@extends('layouts.app')

@section('content')

<div class="grid">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= VIOLATION CODE =================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <legend>Violation Code</legend>
            <button class="btn btn-primary" type="button">Add</button>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Types</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($violationCode as $key => $code)
                    <tr>
                        <td>
                            <textarea class="form-control">{{ $code->name }}</textarea>
                        </td>
                        <td>
                        <select class="form-select" aria-label="Default select example">
                            @foreach ($violationTypes as $key => $type)
                            <?php
                                $selected = $type->_id === $code->parent_id ? 'selected' : '';
                            ?>
                            <option value="{{ $type->_id }}" {{ $selected }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
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