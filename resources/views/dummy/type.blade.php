@extends('layouts.dummy')

@section('content')

<div class="container">
    <div class="row">
        <!-- ========================================================== -->
        <!-- ======================= VIOLATION TYPE =================== -->
        <!-- ========================================================== -->
        <div class="col-12">
            <h1>Violation Types</h1>
            <small><a href="https://www.w3schools.com/colors/colors_picker.asp" target="_blank">Select color here</a></small>
            <form action="/dummy/violation-types" method="POST">
                @csrf
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
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Name </span>
                            <input required type="text" class="form-control" name="name" placeholder="Enter name" aria-label="Name" aria-describedby="addon-wrapping">
                        </div>
                    </li>
                    <li>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Color </span>
                            <input required type="text" class="form-control" name="color" placeholder="Enter color" aria-label="Color" aria-describedby="addon-wrapping">
                        </div>
                    </li>
                    <li>
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
                    <th scope="col">Color</th>
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
                            <span style="color:{{ $type->color }}">{{ $type->color }}</span>
                            <input class="form-control" name="update-color" value="{{ $type->color }}">
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
            let color = $(this).parents('tr').find('input').val();
            if(value.trim() === '') {
                show_error('Please enter name');
                return false;
            }
            if(color.trim() === '') {
                show_error('Please enter color');
                return false;
            }

            await updateData(
                BASE_URL + '/' + dataId,
                {
                    name  : value.trim(),
                    color :color.trim()
                }
            )
        });

        $(document).on('keypress', 'input[name="update-color"]', function() {
            console.log('here')
            updateInputColor($(this))
        })

        $(document).on('paste', 'input[name="update-color"]', function() {
            console.log('here 2')
            updateInputColor($(this))
        })

        function updateInputColor($this) {
            setTimeout(() => {
                let value = $this.val();
                $this.parent().find('span').text(value);
                $this.parent().find('span').css('color', value);
            }, 300);
        }
    })
</script>
@endsection