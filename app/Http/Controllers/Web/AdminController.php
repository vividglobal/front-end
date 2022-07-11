<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Requests\Admin\ChangePasswordRequest;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $params = $request->all();
        $adminModel = new Admin;
        $admins = $adminModel->getList($params);

        return view('pages/admin-management/index', compact('admins'));
    }

    public function create(CreateRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $admin = Admin::where(['email' => $validated['password'], 'phone_number' => $validated['phone_number']])->first();
        if($admin) {

            return $this->responseFail([], "Email or phone number already existed.");
        }
        $newAdmin = Admin::create($validated);

        return $this->responseSuccess($newAdmin, "Create admin successfully");
    }

    public function update(UpdateRequest $request, Admin $admin ,$id)
    {
        $validated = $request->validated();
        $admin = Admin::find($id);
        if(!$admin) {

            return $this->responseFail([], "Admin not found");
        }

        $admin->update($validated);

        return $this->responseSuccess([], "Update admin successfully");
    }

    public function changePassword(ChangePasswordRequest $request ,$id)
    {
        $validated = $request->validated();
        $admin = Admin::find($id);
        if(!$admin) {
            return $this->responseFail([], "Admin not found");
        }

        $newPassword = Hash::make($validated['password']);
        if($newPassword !== $admin->password) {
            return $this->responseFail([], "Current password does not match");
        }

        $validated['password'] =  $newPassword;
        $admin->update($validated);

        return $this->responseSuccess([], "Update admin successfully");
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        if(!$admin) {

            return $this->responseFail([], "Admin not found");
        }

        $admin->delete();

        return $this->responseSuccess([], "Delete admin successfully");
    }
}
