@extends('layouts.dummy')

@section('content')

    <div class="container">
        <!-- ========================================================== -->
        <!-- ======================= COMPANY BRAND ==================== -->
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
                            <select class="form-select" aria-label="Default select example">
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
                            @if($brand->type === 'BRAND')
                            <select class="form-select" aria-label="Default select example">
                                @foreach ($companyBrands as $key => $select)
                                    @if($select->type === 'COMPANY')
                                    <?php
                                        $selected = $select->_id === $brand->parent_id ? 'selected' : '';
                                    ?>
                                    <option value="{{ $select->_id }}" {{ $selected }}>{{ $select->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @endif
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

@endsection
