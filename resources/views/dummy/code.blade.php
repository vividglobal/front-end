@extends('layouts.dummy')

@section('content')

<div class="container">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= VIOLATION CODE =================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <h1>Violation Code</h4>
            <form action="/dummy/violation-code" method="POST">
                @csrf
                <ul class="nav justify-content-end">
                    <li>
                        @if ($message = Session::get('success'))
                        <p class="text-success">{{ $message }}</p>
                        @endif
                        @if ($error = Session::get('error'))
                        <p class="text-danger">{{ $error }}</p>
                        @endif
                    </li>
                    <li class="nav-item">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Name </span>
                            <input required type="text" class="form-control" name="name" placeholder="Enter name" aria-label="Name" aria-describedby="addon-wrapping">
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Type</span>
                            <select required name="type_id" class="form-control">
                                @foreach ($violationTypes as $key => $type)
                                <option value="{{ $type->_id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="input-group flex-nowrap">
                            <button class="btn btn-primary btn-create" type="submit">Add</button>
                        </div>
                    </li>
                </ul>
            </form>
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
                                $selected = $type->_id === $code->type_id ? 'selected' : '';
                            ?>
                            <option value="{{ $type->_id }}" {{ $selected }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        </td>
                        <td>
                            <button class="btn btn-success btn-update" type="button">Save</button>
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
    let BASE_URL = '/dummy/violation-code';
</script>
<script src="{{ asset('assets/js/pages/dummy.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.btn-update').click(async function() {
            let dataId = $(this).parents('tr').attr('data-id');
            let value = $(this).parents('tr').find('textarea').val();
            let typeID = $(this).parents('tr').find('select').val();
            if(value.trim() === '') {
                show_error('Please enter value');
                return false;
            }

            await updateData(
                BASE_URL + '/' + dataId,
                {
                    name : value.trim(),
                    type_id : typeID
                }
            )
        })
    })
</script>
@endsection