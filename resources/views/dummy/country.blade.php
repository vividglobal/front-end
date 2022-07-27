@extends('layouts.dummy')

@section('content')

<div class="container">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= COUNTRIES ======================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <h1>Countries</h4>
            <form action="/dummy/countries" method="POST">
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
                            <span class="input-group-text" id="addon-wrapping">List URL</span>
                            <textarea required name="list_url" class="form-control"></textarea>
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
                    <th scope="col">List URL</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $key => $country)
                    <tr data-id="{{ $country->_id }}">
                        <td>
                            <textarea class="form-control country_name">{{ $country->name }}</textarea>
                        </td>
                        <td>
                            <textarea rows="10" class="form-control list_urls">{{ implode(', ', $country->list_url) }}</textarea>
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
    let BASE_URL = '/dummy/countries';
</script>
<script src="{{ asset('assets/js/pages/dummy.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.btn-update').click(async function() {
            let dataId = $(this).parents('tr').attr('data-id');
            let value = $(this).parents('tr').find('.country_name').val();
            let urls = $(this).parents('tr').find('.list_urls').val();
            if(value.trim() === '') {
                show_error('Please enter value');
                return false;
            }

            await updateData(
                BASE_URL + '/' + dataId,
                {
                    name : value.trim(),
                    list_url : urls
                }
            )
        })
    })
</script>
@endsection