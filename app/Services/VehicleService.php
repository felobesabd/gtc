<?php
namespace App\Services;

use App\Models\Vehicle;
use Yajra\Datatables\Datatables;

class VehicleService
{
    public function getVehicles(): object
    {
        $model = Vehicle::all();
        return $this->getTableData(model: $model);
    }

    public function createVehicle($data): object
    {
        $model = Vehicle::create($data);
        return $model;
    }

    public function updateVehicle(int $id, array $data): bool
    {
        $itemCat = Vehicle::findOrFail($id);
        return $itemCat->fill($data)->save();
    }

    public function deleteVehicle($id): bool
    {
        $itemCat = Vehicle::findOrFail($id);
        return $itemCat->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->editColumn('category_id', function (Vehicle $vehicle) {
                return $vehicle->getCategoryName($vehicle->category_id);
            })
            ->editColumn('group_id', function (Vehicle $vehicle) {
                return $vehicle->getGroupName($vehicle->group_id);
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.vehicles.edit', ['vehicle' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.vehicles.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
