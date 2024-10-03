<?php

namespace App\Http\Controllers\Admin;

use App\Models\Privilege;
use App\Models\User;
use App\Services\PrivilegeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PrivilegeController
{
    protected $privilegeService;

    public function __construct(PrivilegeService $privilegeService)
    {
        $this->privilegeService = $privilegeService;
    }

    public function index(Request $request)
    {
        checkUserHasRolesOrRedirect('roles.list');
        $roles = DB::table('roles')->get();
        return view('admin.privileges.index', compact('roles'));
    }

    public function addPermission($role_id)
    {
        checkUserHasRolesOrRedirect('roles.add');

        $role = DB::table('roles')->where('id', $role_id)->first();
        $all_models = all_models();

        return view('admin.privileges.create', compact('role', 'all_models'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission' => 'required|array',
        ]);

        $permissions = $request->permission;
        $role = Role::findOrFail($request->role_id);

        $add_permissions = [];
        $permission_ids = [];
        foreach ($permissions as $permission_name) {
            $permission = Permission::updateOrCreate(['name' => $permission_name]);

            $permission_ids[] = $permission->id;
        }

        foreach ($permission_ids as $permission_id) {
            if (!$role->permissions()->where('permission_id', $permission_id)->exists()) {
                $role->permissions()->attach($permission_id);
            } else {
                return redirect()->back()->with('error', 'Permissions already exists');
            }
        }

        return redirect()->back()->with('success', 'Permissions created successfully');
    }

    public function editPermission($role_id)
    {
        checkUserHasRolesOrRedirect('roles.edit');
        $role = DB::table('roles')->where('id', $role_id)->first();
        $permissions = DB::table('role_has_permissions')
            ->where('role_id', $role_id)
            ->pluck('permission_id');

        $found_permissions =  DB::table('permissions')->whereIn('id', $permissions)->get();
        $permission_names = $found_permissions->pluck('name')->toArray();


        $all_models = all_models();

        return view('admin.privileges.edit', compact('role', 'all_models', 'permission_names'));
    }

    public function updatePermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission' => 'required|array',
        ]);

        $permissions = $request->permission;
        $role = Role::findOrFail($request->role_id);

        $add_permissions = [];
        foreach ($permissions as $permission_name) {
            $add_permissions[] = Permission::updateOrCreate(['name' => $permission_name]);
        }

        $role->syncPermissions($add_permissions);

        return redirect()->back()->with('success', 'Permission Updated successfully');
    }

    public function destroyPermission($role_id)
    {
        checkUserHasRolesOrRedirect('roles.delete');
        $roles = DB::table('role_has_permissions')->where('role_id', $role_id)->delete();
        return redirect()->back()->with('success', 'Permission Deleted successfully for user');
    }
}
