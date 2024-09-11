<?php
namespace App\Services;

use App\Models\StoreLocation;
use Yajra\Datatables\Datatables;

class StoreLocationService
{
    public function getStoreLocations(): object
    {
        $model = StoreLocation::all();
        return $this->getTableData(model: $model);
    }

    public function createStoreLocation($data): object
    {
        $model = StoreLocation::create($data);
        return $model;
    }

    public function updateStoreLocation(int $id, array $data): bool
    {
        $storeLocation = StoreLocation::findOrFail($id);
        return $storeLocation->fill($data)->save();
    }

    public function deleteStoreLocation($id): bool
    {
        $storeLocation = StoreLocation::findOrFail($id);
        return $storeLocation->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.storeLocations.edit', ['storeLocation' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.storeLocations.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
