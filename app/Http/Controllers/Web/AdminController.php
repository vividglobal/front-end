<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;
use Illuminate\Hashing\BcryptHasher;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $perpage = $request->query('perpage') ? $request->query('perpage') : 10;

        $admins = Admin::paginate($perpage);
        return view('pages/admin-management/index', compact('admins'));
    }

    public function create(CreateRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        Admin::create($input);
        return $this->responseSuccess([], "Create admin successfully");
    }

    public function update(UpdateRequest $request, Admin $admin ,$id)
    {
        $admin = Admin::find($id);
        $hasher = app('hash');
        $input = $request->all();

        if(isset($input['password'])){
            if ($hasher->check($input['password_current'], $admin->password)) {
                $input['password'] = Hash::make($input['password']);
            }else{
                return $this->responseFail([], "Incorrect old password. Please re-enter correct password.");
            }
        }

        $admin->update($input);
        return $this->responseSuccess([], "Update admin successfully");

        return $this->responseFail([], "Update admin Failed");
    }

    public function delete($id)
    {
        $admin = Admin::findOrFail($id);
        $result =  $admin->delete($id);

        if($result){
        return $this->responseSuccess([], "Delete profile successfully");
        }

        return $this->responseFail([], "Delete profile Failed");
    }
}
