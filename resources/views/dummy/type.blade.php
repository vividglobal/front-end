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
                    @if ($message = Session::get('success'))
                    <p class="text-success">{{ $message }}</p>
                    @endif
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                <li>
                    <form action="/dummy/violation-types" method="POST">
                        @csrf
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Name </span>
                            <input required type="text" class="form-control" name="name" placeholder="Enter name" aria-label="Name" aria-describedby="addon-wrapping">
                            <button class="btn btn-primary btn-create" type="submit">Add</button>
                        </div>
                    </form>
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
    let BASE_URL = '/dummy/violation-types';
</script>
<script src="{{ asset('assets/js/pages/dummy.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.btn-update').click(async function() {
            let dataId = $(this).parents('tr').attr('data-id');
            let value = $(this).parents('tr').find('textarea').val();
            if(value.trim() === '') {
                show_error('Please enter value');
                return false;
            }

            await updateData(
                BASE_URL + '/' + dataId,
                {
                    name : value.trim()
                }
            )
        })
    })
</script>
@endsection