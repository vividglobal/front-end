@extends('layouts.dummy')

@section('content')

<div class="container">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= VIOLATION TYPE =================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <h1>Violation Types</h4>
            <ul class="nav justify-content-end">
                <li>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Name </span>
                        <input type="text" class="form-control" name="name" placeholder="Enter name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                </li>
                <li class="nav-item">
                    <button class="btn btn-primary" type="button">Add</button>
                </li>
            </ul>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($violationTypes as $key => $type)
                    <tr data-id="{{ $type->_id }}">
                        <td>
                            <textarea class="form-control">{{ $type->name }}</textarea>
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

<script>
    let CSRF = '{{ csrf_token() }}';
    let BASE_URL = '/dummy/violation-types';
</script>
<script src="{{ asset('assets/js/pages/dummy.js') }}"></script>

@endsection