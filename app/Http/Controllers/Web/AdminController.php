<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Traits\ApiResponse;

class AdminController extends Controller
{
    use ApiResponse;

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
        return redirect('/admins')->with('success', 'Create admin successfully');
    }

    public function update(UpdateRequest $request, Admin $admin)
    {
        // $admin = Admin::find($id);
        // if($admin) {
        //     $admin->update($request->all());
        //     return redirect('/admins')->with('success', 'Update admin successfully');
        // }
        // return redirect('/admins')->with('error', 'Admin not found');
        $admin->update($request->all());
        return redirect('/admins')->with('success', 'Update admin successfully');
    }

    public function delete($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete($id);
        return $this->responseSuccess([], "Delete admin successfully");
    }
}
