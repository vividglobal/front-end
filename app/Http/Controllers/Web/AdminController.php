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
        $admin = Admin::where('email' , '=' , $validated['email'])->orWhere('phone_number' , '=' , $validated['phone_number'])->first();
        if($admin) {
            return $this->responseFail([], "Email or phone number already existed.");
        }
        $newAdmin = Admin::create($validated);

        return $this->responseSuccess($newAdmin, "Create account successfully");
    }

    public function update(UpdateRequest $request, Admin $admin ,$id)
    {
        $validated = $request->validated();
        $admin = Admin::find($id);

        if($admin -> email !== $request->email){
            $checkEmailIsExist = Admin::where('email' , '=' , $validated['email'])->first();

            if($checkEmailIsExist) {
                return $this->responseFail([], "Email already existed.");
            }
        }

        if($admin -> phone_number !== $request->phone_number){
            $checkNumberisExist = Admin::where('phone_number' , '=' , $validated['phone_number'])->first();

            if($checkNumberisExist) {
                return $this->responseFail([], "Phone number already existed.");
            }
        }

        if(!$admin) {
            return $this->responseFail([], "Account not found");
        }

        $admin->update($validated);
        return $this->responseSuccess([], "Successfully updated");
    }

    public function changePassword(ChangePasswordRequest $request ,$id)
    {
        $validated = $request->validated();
        $admin = Admin::find($id);
        if(!$admin) {
            return $this->responseFail([], "Account not found");
        }

        $currentPassword = Hash::check($validated['current_password'], $admin->password);
        if(!$currentPassword) {
            return $this->responseFail([], "Old password is incorrect! Please re-enter");
        }

        $newPassword = Hash::make($validated['password']);
        $validated['password'] =  $newPassword;
        $admin->update($validated);

        return $this->responseSuccess([], "Successfully updated");
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        if(!$admin) {
            return $this->responseFail([], "Account not found");
        }
        $admin->delete();

        return $this->responseSuccess([], "Account deleted successfully");
    }
}
