
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/adminManagement/style.css') }}">
<script src="{{ asset('assets/js/modal/modalCreateAccount.js') }}"></script>
<script src="{{ asset('assets/js/query/queryData.js') }}"></script>
<script src="{{ asset('assets/js/pages/adminManagement.js') }}"></script>

@include("modal/createAccount")
<div class="list--search--select" >
    <div class="list--title">
        <p>{{ __('Admin management') }}</p>
        <span class="create__profile btn_create_user_mobi" style="cursor:pointer" ></span>
    </div>
    <!-- list Btn  -->
    <div class="list_query">
        <div class="query_left search_admin">
            <div class="search_admins">
                @include('pages/components/query', ['list_filter' => ["fillter_mobile","search","apply"], 'show_all_filter' => false])
            </div>
        </div>
        <div class="list_query-right">
            <div class="create__profile unvailable_create_profile" >
            </div>
        </div>

    </div>
</div>
<div class="table__admin--management" >
    <div class=" admin__management">
        <ul class="thead_admin">
            <li>{{ __('No') }}</li>
            <li>{{ __('Full name') }}</li>
            <li>{{ __('Email') }}</li>
            <li>{{ __('Phone number') }}</li>
            <li>{{ __('Authority') }}</li>
            <li>{{ __('Edit') }}</li>
            <li>{{ __('Delete') }}</li>
        </ul>
        @foreach ($admins as $key => $admin)
        <ul class="tbody_admin">
            <li class="updata-form" scope="row">{{ ($key + 1) + (($admins->currentpage() - 1) * $admins->perpage()) }}</li>
            <li class="updata-form">{{ $admin->full_name }}</li>
            <li class="updata-form">{{ $admin->email }}</li>
            <li class="updata-form">{{ $admin->phone_number }}</li>
            <li class="style_{{ $admin->role }} styleauthor updata-form">{{ $admin->role }}</li>
            <div class= "img_admin">
                <li class="edit__profile">
                    <span class="btn_edit"></span>
                    <input type="hidden" name="user_id" data-name ="{{ $admin["full_name"] }}" data-phone ={{ $admin["phone_number"] }}
                        data-auth ="{{ $admin["role"] }}" data-id ="{{ $admin["_id"] }}" data-email ="{{ $admin["email"] }}">
                </li>
                <li>
                    <img class="delete__profile" src="{{asset('assets/image/remove.svg')}}" alt="">
                    <input type="hidden" data-id ={{ $admin["_id"] }} >
                </li>
            </div>

        </ul>
        @endforeach
        @if(count($admins) == 0)
        <div class="no_search_reusult" >
            @include('noSearchResult/index')
        </div>
        @endif
    </div>
</div>
<div class="paginate_showing pagenate_admin">
    @if(count($admins) > 0)
        <div style="margin-top:20px">
            @include('pages/components/query', ['list_filter' => ["showing"], 'show_all_filter' => false])
        </div>
    @endif
    <div class="row-pagination">
        {{ $admins->links('layouts.my-paginate') }}
    </div>
</div>
<!-- ---------------MODAL-DELETE------------------ -->
<div id="modal__delete-account" class="modal">
    <div class="modal__content" style="max-width: 426px;padding:23px 21px 23px 21px;">
        <div class="close__modal">
        </div>
        <div class="title-modal">
            <p>{{ __('Remove admin') }}</p>
        </div>
        <div class="content-modal">
            <p style="font-weight: 500;">Are you sure to remove this admin ?</p>
        </div>
        <div class="btn-modal btn-modal_delete" >
            <button class="btn__cancel-button cancel_delete_user" >
            {{ __('Cancel') }}
            </button>
            <form  class="form_btn">
                <input type="hidden" data-id="">
                <button class="btn__delete--user" type="submit">{{ __('Yes') }}</button>
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
