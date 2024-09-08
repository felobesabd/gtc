<?php
namespace App\Services;

use App\Models\Department;
use Yajra\Datatables\Datatables;

class DepartmentService
{
    public function getDepartments(): object
    {
        $model = Department::all();
        return $this->getTableData(model: $model);
    }

    public function createDepartment($data): object
    {
        $model = Department::create($data);
        return $model;
    }

    public function updateDepartment(int $id, array $data): bool
    {
        $department = Department::findOrFail($id);
        return $department->fill($data)->save();
    }

    public function deleteDepartment($id): bool
    {
        $department = Department::findOrFail($id);
        return $department->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.departments.edit', ['department' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.departments.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
