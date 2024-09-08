<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->departmentService->getDepartments();
        }

        return view('admin.departments.index');
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(DepartmentRequest $request)
    {
        $department = $this->departmentService->createDepartment(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function show(Request $request, $id)
    {
        $department = Department::find($id);
    }

    public function edit(Request $request, $id)
    {
        $department = Department::find($id);
        return view('admin.departments.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, $id)
    {
        $department = $this->departmentService->updateDepartment(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $department = $this->departmentService->deleteDepartment($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
