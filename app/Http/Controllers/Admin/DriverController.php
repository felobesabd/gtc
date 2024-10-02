<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use App\Services\DriverService;
use Illuminate\Http\Request;

class DriverController
{
    protected $driverService;

    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }

    public function index(Request $request)
    {
        checkUserHasRolesOrRedirect('driver.list');

        if ($request->ajax()) {
            return $this->driverService->getDrivers();
        }

        return view('admin.drivers.index');
    }

    public function create()
    {
        checkUserHasRolesOrRedirect('driver.add');

        return view('admin.drivers.create');
    }
    public function show($id)
    {
        checkUserHasRolesOrRedirect('driver.show');

        $driver = Driver::findOrFail($id);
        return view('admin.drivers.view', compact('driver'));
    }

    public function store(DriverRequest $request)
    {
        $driver = $this->driverService->createDriver(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        checkUserHasRolesOrRedirect('driver.edit');

        $driver = Driver::findOrFail($id);
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(DriverRequest $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $updateDriver = $this->driverService->updateDriver($driver, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        checkUserHasRolesOrRedirect('driver.delete');

        $driver = $this->driverService->deleteDriver($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
