<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VehicleRequest;
use App\Models\Category;
use App\Models\Group;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class VehicleController
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->vehicleService->getVehicles();
        }

        return view('admin.vehicles.index');
    }

    public function create()
    {
        $categories = Category::all();
        $groups = Group::all();
        return view('admin.vehicles.create', compact('categories', 'groups'));
    }

    public function store(VehicleRequest $request)
    {
        $vehicle = $this->vehicleService->createVehicle(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $categories = Category::all();
        $groups = Group::all();
        return view('admin.vehicles.edit', compact(
            'vehicle',
            'categories',
            'groups',
        ));
    }

    public function update(VehicleRequest $request, $id)
    {
        $vehicle = $this->vehicleService->updateVehicle(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $vehicle = $this->vehicleService->deleteVehicle($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
