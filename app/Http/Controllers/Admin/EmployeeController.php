<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Services\EmployeeService;
use Carbon\Carbon;
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
        checkUserHasRolesOrRedirect('employee.list');

        if ($request->ajax()) {
            return $this->employeeService->getEmployees();
        }


        return view('admin.employees.index');
    }

    public function create()
    {
        checkUserHasRolesOrRedirect('employee.add');

        $departments = Department::all();
        $countries = generate_country_codes();

        return view('admin.employees.create', compact('departments', 'countries'));
    }

    public function store(Request $request)
    {
        //        $passportExpiryWarning = Carbon::parse($request->passport_expires_at)->subMonths(6);
//        $drivingLicenseExpiryWarning = Carbon::parse($request->driving_license_expires_at)->subMonths(3);
//
//        $now = Carbon::now();
//
//        if ($now->greaterThanOrEqualTo($passportExpiryWarning)) {
//            $warnings[] = 'Your passport will expire in less than 6 months!';
//        }
//
//        if ($now->greaterThanOrEqualTo($drivingLicenseExpiryWarning)) {
//            $warnings[] = 'Your driving license will expire in less than 3 months!';
//        }
//
//        if (!empty($warnings)) {
//            return redirect()->back()->with('warnings', $warnings);
//        }

        $department = $this->employeeService->createEmployee(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function show($id)
    {
        checkUserHasRolesOrRedirect('employee.show');

        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $countries = generate_country_codes();

        return view('admin.employees.view', compact('employee', 'departments', 'countries'));
    }

    public function edit(Request $request, $id)
    {
        checkUserHasRolesOrRedirect('employee.edit');

        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $countries = generate_country_codes();

        return view('admin.employees.edit', compact('employee', 'departments', 'countries'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $uploadEmployee = $this->employeeService->updateEmployee($id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        checkUserHasRolesOrRedirect('employee.delete');
        $employee = $this->employeeService->deleteEmployee($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
