<?php
namespace App\Services;

use App\Models\Department;
use App\Models\Employee;
use Yajra\Datatables\Datatables;

class EmployeeService
{
    public function getEmployees(): object
    {
        $model = Employee::all();
        return $this->getTableData(model: $model);
    }

    public function createEmployee($data): object
    {
        $model = Employee::create($data);
        return $model;
    }

    public function updateEmployee(int $id, array $data): bool
    {
        $employee = Employee::findOrFail($id);
        return $employee->fill($data)->save();
    }

    public function deleteEmployee($id): bool
    {
        $employee = Employee::findOrFail($id);
        return $employee->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.employees.edit', ['employee' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.employees.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
