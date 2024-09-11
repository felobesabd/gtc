<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->employeeService->getEmployees();
        }

        return view('admin.employees.index');
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.employees.create', compact('departments'));
    }

    public function store(EmployeeRequest $request)
    {
        $department = $this->employeeService->createEmployee(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        return view('admin.employees.view', compact('employee', 'departments'));
    }

    public function edit(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $uploadEmployee = $this->employeeService->updateEmployee($employee, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $employee = $this->employeeService->deleteEmployee($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
