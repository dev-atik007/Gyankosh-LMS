<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ManageAdminController extends Controller
{
    public function allAdmin()
    {
        $admin = User::where('role', 'admin')->get();

        return view('admin.admin.index', compact('admin'));
    }

    public function addAdmin()
    {
        $roles = Role::all();

        return view('admin.admin.add', compact('roles'));
    }

    public function storeAdmin(Request $request)
    {
        $admin = new User();

        $admin->username    = $request->username;
        $admin->name        = $request->name;
        $admin->email       = $request->email;
        $admin->phone       = $request->phone;
        $admin->address     = $request->address;
        $admin->password    = Hash::make($request->password);
        $admin->role        = 'admin';
        $admin->status      = '1';
        $admin->save();

        // if ($request->roles) {
        //     $admin->assignRole($request->roles);
        // }
        if ($request->roles) {
            $role = Role::findById($request->roles);
            if ($role) {
                $admin->assignRole($role->name);
            }
        }

        $notification = array(
            'message'   => 'New Admin Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.admin')->with($notification);
    }

    public function editAdmin($id)
    {
        $admin = User::find($id);
        $roles = Role::all();

        return view('admin.admin.edit', compact('admin', 'roles'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::find($id);

        $admin->username    = $request->username;
        $admin->name        = $request->name;
        $admin->email       = $request->email;
        $admin->phone       = $request->phone;
        $admin->address     = $request->address;
        $admin->role        = 'admin';
        $admin->status      = '1';
        $admin->save();

        $admin->roles()->detach();
        // if ($request->roles) {
        //     $admin->assignRole($request->roles);
        // }
        if ($request->roles) {
            $role = Role::findById($request->roles);
            if ($role) {
                $admin->assignRole($role->name);
            }
        }

        $notification = array(
            'message'   => 'Admin Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.admin')->with($notification);
    }

    public function deleteAdmin($id)
    {
        $admin = User::find($id);
        if (!is_null($admin)) {
            $admin->delete();
        }

        $notification = array(
            'message'   => 'Admin Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.admin')->with($notification);
    }
}
