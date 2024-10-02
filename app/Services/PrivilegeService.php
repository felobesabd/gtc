<?php
namespace App\Services;

use App\Models\Privilege;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class PrivilegeService
{
    public function getPrivileges(): object
    {
        $model = Privilege::all();
        return $this->getTableData(model: $model);
    }

    public function createPrivilege($data): object
    {
        $model = Privilege::create($data);
        return $model;
    }

    public function updatePrivilege(Privilege $privileges, array $data): bool
    {
        return $privileges->fill($data)->save();
    }

    public function deletePrivilege($id): bool
    {
        $privileges = Privilege::findOrFail($id);
        return $privileges->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('roles', function ($row) {
                $roles = DB::table('roles')->get();
                $roleNames = [];

                foreach ($roles as $role) {
                    $roleNames[] = $role->name;
                }
                return implode(', ', $roleNames);
            })
            ->editColumn('user_id', function ($row) {
                return $row->user->full_name;
            })
            ->addColumn('permission', function ($row) {
                $user_id = $row->user->id;
                $res = '
                    <a href="' . route('admin.privileges.add.permission', ['user_id' => $user_id]) . '" class="btn btn-primary" onclick="return true;">
                        Permission
                    </a>
                    ';
                return $res;
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.privileges.edit', ['privilege' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.privileges.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action', 'permission'])
            ->make(true);
    }
}
