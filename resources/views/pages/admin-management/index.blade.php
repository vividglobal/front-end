
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="../assets/css/adminManagement/style.css">
<script src="{{ asset('assets/js/modal/modalCreateAccount.js') }}"></script>
@include("modal/createAccount");

<div class="list--search--select" >
        <div class="list--title">
            <p>Admin Management</p>
        </div>
        <!-- list Btn  -->
        <div class="list--select--option">
            <div class="list--select__left">
                <div class="list--search" style="width:203px">
                    <img src="{{ asset('assets/image/search.svg') }}" alt="" class="btn-search">
                    <input type="text" placeholder="Search" class="search">
                </div>
                <button class="btn__apply">Apply</button>
            </div>
            <div class="list--select__right">
                <p>Showing</p>
                <div class="list--showing">
                    <select name="" id="">
                        <!-- HTML -->
                    </select>
                </div>
                <div class="create__profile" style="width: 153px;display: flex;justify-content:center">
                    <p>Add admin</p>
                </div>
            </div>
        </div>
</div>
<div class="table__admin--management" style="margin: 28px 60px">
<div class=" admin__management">
            <table>
                <tr>
                  <th>No</th>
                  <th>Full name</th>
                  <th>Email</th>
                  <th>Phone number</th>
                  <th>Authority</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                @foreach ($admins as $admin)
                <tr>
                    <td scope="row">1</td>
                    <td>{{ $admin->full_name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone_number }}</td>
                    <td>{{ $admin->role }}</td>
                    <td class="edit__profile">
                        <img src="../assets/image/edit.svg" alt="">
                        <input type="hidden" data-name ={{ $admin["full_name"] }} data-phone ={{ $admin["phone_number"] }}
                        data-auth ={{ $admin["role"] }} data-id ={{ $admin["_id"] }} data-email ={{ $admin["email"] }}>
                    </td>
                    <td><img class="delete__profile" src="../assets/image/remove.svg" alt=""></td>
                </tr>
                @endforeach
            </table>
            <div class="demo__pagination">
                <span>&#60;</span>
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>...</span>
                <span>9</span>
                <span>10</span>
                <span>&#62;</span>
            </div>
    </div>
</div>
<!-- ---------------MODAL-DELETE------------------ -->
<div id="modal__delete-account" class="modal">
        <div class="modal__content" style="max-width: 426px;padding:23px 21px 46px 21px;">
            <div class="close__modal">
                <img class="modal__close" src="../assets/image/x.svg" alt="">
            </div>
            <div class="title-modal">
                <p>Remove user</p>
            </div>
            <div class="content-modal">
                <p style="font-weight: 500;">Are you sure to remove this user?</p>
            </div>
            <div class="btn-modal" style="display:inline-block;width: 100%;">
                <button class="btn__cancel-button" style="float:left;margin-right:10px">
                Cancel
                </button>
                <form action="admins/{{ $admin->_id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn__delete--user" type="submit">Yes</button>
                </form>
            </div>
        </div>
        <div class="overlay"></div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div><br />
@endif

@endsection
