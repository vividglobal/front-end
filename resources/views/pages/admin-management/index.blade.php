
@extends('layouts.app')

@section('content')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
  Add
</button>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fullname</label>
                <input type="text" class="form-control"  aria-describedby="Fullname">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control"  aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="radio" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone number</th>
      <th scope="col">Authority</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($admins as $admin)
    <tr>
      <th scope="row">1</th>
      <td>{{ $admin->full_name }}</td>
      <td>{{ $admin->email }}</td>
      <td>{{ $admin->phone_number }}</td>
      <td>{{ $admin->role }}</td>
      <td>Edit</td>
      <td>
        <form action="admins/{{ $admin->_id }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- For display success message -->
@if(session()->get('success'))
    {{ session()->get('success') }}  
@endif
<!-- For display errors message -->
@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div><br />
@endif
<!-- For update method : put these inside <form> tag -->
<!-- @csrf
@method('UPDATE') -->

@endsection