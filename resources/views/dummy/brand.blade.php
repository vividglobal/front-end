@extends('layouts.dummy')

@section('content')

    <div class="container">
        <!-- ========================================================== -->
        <!-- ======================= COMPANY BRAND ==================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <h1>Company Brands</h4>
            <form action="/dummy/company-brands" method="POST">
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
                            <select class="form-select" required name="type" aria-label="Default select example">
                                <option value="COMPANY">COMPANY</option>
                                <option value="BRAND">BRAND</option>
                            </select>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Parent Company</span>
                            <select name="parent_id" class="form-control">
                                @foreach ($companyBrands as $key => $select)
                                    @if($select->type === 'COMPANY')
                                    <option value="{{ $select->_id }}">{{ $select->name }}</option>
                                    @endif
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
                    <th scope="col">Type</th>
                    <th scope="col">Parent Company</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companyBrands as $key => $brand)
                    <tr data-id="{{ $brand->_id }}">
                        <td>
                            <textarea class="form-control">{{ $brand->name }}</textarea>
                        </td>
                        <td>
                            <select class="form-select type" aria-label="Default select example">
                                @if($brand->type === 'BRAND')
                                    <option value="COMPANY">COMPANY</option>
                                    <option value="BRAND" selected>BRAND</option>
                                @else
                                    <option value="COMPANY" selected>COMPANY</option>
                                    <option value="BRAND">BRAND</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <select class="parent_id form-select {{ $brand->type === 'COMPANY' ? 'd-none' : '' }}" aria-label="Default select example">
                                <option value="">No Company</option>
                                @foreach ($companyBrands as $key => $select)
                                    @if($select->type === 'COMPANY')
                                    <?php
                                        $selected = $select->_id === $brand->parent_id ? 'selected' : '';
                                    ?>
                                    <option value="{{ $select->_id }}" {{ $selected }}>{{ $select->name }}</option>
                                    @endif
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
    <script>
        let CSRF = '{{ csrf_token() }}';
        let BASE_URL = '/dummy/company-brands';
    </script>
    <script src="{{ asset('assets/js/pages/dummy.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('select.type').change(function() {
                let thisVal = $(this).val();
                let companySelect = $(this).parents('tr').find('.parent_id');
                if(thisVal === 'COMPANY') {
                    companySelect.addClass('d-none')
                }else {
                    companySelect.removeClass('d-none')
                }
            });

            $('.btn-update').click(async function() {
                let rowParent = $(this).parents('tr');
                let dataId = rowParent.attr('data-id');
                let value = rowParent.find('textarea').val();
                let type = rowParent.find('.type').val();
                let parentId = rowParent.find('.parent_id').val();
                if(value.trim() === '') {
                    show_error('Please enter value');
                    return false;
                }
    
                await updateData(
                    BASE_URL + '/' + dataId,
                    {
                        name : value.trim(),
                        type : type,
                        parent_id : parentId
                    }
                )
            })
        })
    </script>
@endsection
