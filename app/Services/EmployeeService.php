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
        /** edit or store attachment */
        $folder = 'employees-attachment';
        editOrCreateMultipleFiles(
            folder: $folder,
            obj: $model,
            attachments: $data['attachments'] ?? null,
            attach_col_name: 'attachments_ids'
        );
        return $model;
    }

    public function updateEmployee(Employee $employee, array $data): bool
    {
        /** edit or store attachment */
        $folder = 'employees-attachment';
        editOrCreateMultipleFiles(
            folder: $folder,
            obj: $employee,
            attachments: $data['attachments'] ?? null,
            attach_col_name: 'attachments_ids'
        );

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
            ->editColumn('department_id', function (Employee $employee) {
                return $employee->getDepartmentName($employee->department_id);
            })
            ->editColumn('date_of_birth', function ($employee) {
                return date('d-M-y', strtotime($employee->date_of_birth));
            })
            ->editColumn('joining_date', function ($employee) {
                return date('d-M-y', strtotime($employee->joining_date));
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.employees.show', ['employee' => $row->id]) . '" class="btn btn-info" onclick="return true;">
                        View
                    </a>
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
