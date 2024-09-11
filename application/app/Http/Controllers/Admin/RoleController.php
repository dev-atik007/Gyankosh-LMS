<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function allrole()
    {
        $roles = Role::all();

        return view('admin.pages.role.index', compact('roles'));
    }

    public function addRole()
    {
        return view('admin.pages.role.form');
    }

    public function storeRole(Request $request)
    {
        $roles = new Role();

        $roles->name        = $request->name;
        $roles->save();

        $notification = array(
            'message'   => 'Roles Created Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.roles')->with($notification);
    }

    public function editRole($id)
    {
        $roles = Role::find($id);

        return view('admin.pages.role.edit', compact('roles'));
    }

    public function updateRole(Request $request)
    {
        $id = $request->id;

        $roles = Role::find($id);

        $roles->name        = $request->name;
        $roles->save();

        $notification = array(
            'message'   => 'Roles Updated Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteRole($id)
    {
        $roles = Role::find($id);

        $roles->delete();

        $notification = array(
            'message'   => 'Role deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }




    //// Add Role Permission All Method
    public function rolesPermission()
    {
        $roles = Role::all();

        $permission_groups = User::getpermissionGroups();

        return view('admin.pages.role_setup.add_roles_permission', compact('roles', 'permission_groups'));
    }

    public function storePermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        $permissions = $request->permission;

        if (!empty($permissions)) {

            $permissionNames = Permission::whereIn('id', $permissions)->pluck('name')->toArray();

            $role->syncPermissions($permissionNames);
        }

        $notification = array(
            'message' => 'Role Permissions Stored Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AllRolesPermission()
    {
        $roles = Role::with('permissions')->get();

        return view('admin.pages.role_setup.all_roles_permission', compact('roles'));
    }

    public function EditRolesPermission($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return view('admin.pages.role_setup.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
    }

    public function UpdateRolesPermission(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = $request->permission;

        if ($role) {
            // Verify that permissions exist
            $validPermissions = Permission::whereIn('id', $permissions)->pluck('id')->toArray();

            if (!empty($validPermissions)) {
                $role->syncPermissions($validPermissions);
            } else {
                $notification = array(
                    'message' => 'No valid permissions found to update.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

            $notification = array(
                'message' => 'Role Permissions Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.all.roles.permission')->with($notification);
        } else {
            $notification = array(
                'message' => 'Role not found.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function DeleteRolesPermission($id)
    {
        $role = Role::find($id);
        if (!is_null($role)) {
            $role->delete();
        }
        $notification = array(
            'message' => 'Role Permission Delete Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
