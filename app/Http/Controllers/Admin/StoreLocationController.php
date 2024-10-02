<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreLocationRequest;
use App\Models\StoreLocation;
use App\Services\StoreLocationService;
use Illuminate\Http\Request;

class StoreLocationController
{
    protected $storeLocationService;

    public function __construct(StoreLocationService $storeLocationService)
    {
        $this->storeLocationService = $storeLocationService;
    }

    public function index(Request $request)
    {
        checkUserHasRolesOrRedirect('store_location.list');
        if ($request->ajax()) {
            return $this->storeLocationService->getStoreLocations();
        }

        return view('admin.storeLocations.index');
    }

    public function create()
    {
        checkUserHasRolesOrRedirect('store_location.add');
        return view('admin.storeLocations.create');
    }

    public function store(StoreLocationRequest $request)
    {
        $storeLocation = $this->storeLocationService->createStoreLocation(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        checkUserHasRolesOrRedirect('store_location.edit');
        $storeLocation = StoreLocation::findOrFail($id);
        return view('admin.storeLocations.edit', compact('storeLocation'));
    }

    public function update(StoreLocationRequest $request, $id)
    {
        $storeLocation = $this->storeLocationService->updateStoreLocation(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        checkUserHasRolesOrRedirect('store_location.delete');
        $storeLocation = $this->storeLocationService->deleteStoreLocation($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
