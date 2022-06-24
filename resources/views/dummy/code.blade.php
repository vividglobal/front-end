@extends('layouts.dummy')

@section('content')

<div class="container">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= VIOLATION CODE =================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <h1>Violation Code</h4>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <button class="btn btn-primary" type="button">Add</button>
                </li>
            </ul>
            <table class="table table-striped">
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
                    <tr data-id="{{ $code->_id }}">
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