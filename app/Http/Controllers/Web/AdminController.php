<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        return view('pages/admin-management/index', compact('admins'));
    }

    public function create(CreateRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        Admin::create($input);
        return $this->responseSuccess([], "Update admin successfully");
    }

    public function update(UpdateRequest $request, Admin $admin ,$id)
    {
        $admin = Admin::find($id);
        $input = $request->all();
        if(isset($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }

        if($admin) {
            $admin->update($input);
            return $this->responseSuccess([], "Update admin successfully");
        }
        return $this->responseFail([], "Update admin Failed");
    }

    public function delete($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete($id);
        return redirect('/admins')->with('success', 'Delete admin successfully');
    }
}
