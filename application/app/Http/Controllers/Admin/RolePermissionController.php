<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Exports\PermissionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PermissionImport;

class RolePermissionController extends Controller
{
    public function allPermission()
    {
        $permissions = Permission::all();

        return view('admin.pages.permission.index', compact('permissions'));
    }

    public function addPermission()
    {
        return view('admin.pages.permission.form');
    }

    public function storePermission(Request $request)
    {
        $permissions = new Permission();

        $permissions->name        = $request->name;
        $permissions->group_name  = $request->group_name;
        $permissions->save();

        $notification = array(
            'message'   => 'Permission Created Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.permission')->with($notification);
    }

    public function editPermission($id)
    {
        $permission = Permission::find($id);

        return view('admin.pages.permission.edit', compact('permission'));
    }

    public function updatePermission(Request $request)
    {
        $id = $request->id;

        $permission = Permission::find($id);

        // Duplicate check
        $duplicate = Permission::where('name', $request->name)
            ->where('guard_name', $permission->guard_name) // Same guard_name check
            ->where('id', '!=', $id) // Exclude current permission
            ->exists();

        if ($duplicate) {
            return redirect()->back()->withErrors('Permission with the same name already exists.');
        }

        $permission->name        = $request->name;
        $permission->group_name  = $request->group_name;
        $permission->save();

        $notification = array(
            'message'   => 'Permission Created Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);

        $permission->delete();

        $notification = array(
            'message'   => 'Permission deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function importPermission()
    {
        return view('admin.pages.import.form');
    }

    public function export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message'   => 'Permission Imported successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
