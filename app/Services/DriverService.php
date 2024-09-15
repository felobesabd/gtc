<?php
namespace App\Services;

use App\Models\Driver;
use Yajra\Datatables\Datatables;

class DriverService
{
    public function getDrivers(): object
    {
        $model = Driver::all();
        return $this->getTableData(model: $model);
    }

    public function createDriver($data): object
    {
        $model = Driver::create($data);

        $attachments = $data['attachments'] ?? [];
        if (!is_array($attachments)) {
            $attachments = [];
        }

        /** for ordering */
        ordering(model: 'App\Models\Driver', obj: $model);
        /** edit or store attachment */
        $folder = 'driver-attachment';
        editOrCreateMultipleFiles(
            folder: $folder,
            obj: $model,
            attachments: $attachments,
            attach_col_name: 'images'
        );

        return $model;
    }

    public function updateDriver(Driver $driver, array $data): bool
    {
        $attachments = $data['attachments'] ?? [];
        if (!is_array($attachments)) {
            $attachments = [];
        }

        /** edit or store attachment */
        $folder = 'driver-attachment';
        editOrCreateMultipleFiles(
            folder: $folder,
            obj: $driver,
            attachments: $attachments,
            attach_col_name: 'images'
        );

        return $driver->fill($data)->save();
    }

    public function deleteDriver($id): bool
    {
        $driver = Driver::findOrFail($id);
        return $driver->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.drivers.show', ['driver' => $row->id]) . '" class="btn btn-info" onclick="return true;">
                        View
                    </a>
                    <a href="' . route('admin.drivers.edit', ['driver' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.drivers.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
