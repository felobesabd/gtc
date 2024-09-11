<?php
namespace App\Services;

use App\Models\Supplier;
use Yajra\Datatables\Datatables;

class SupplierService
{
    public function getSuppliers(): object
    {
        $model = Supplier::all();
        return $this->getTableData(model: $model);
    }

    public function createSupplier($data): object
    {
        $model = Supplier::create($data);
        return $model;
    }

    public function updateSupplier(int $id, array $data): bool
    {
        $driver = Supplier::findOrFail($id);
        return $driver->fill($data)->save();
    }

    public function deleteSupplier($id): bool
    {
        $driver = Supplier::findOrFail($id);
        return $driver->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.suppliers.edit', ['supplier' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.suppliers.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
