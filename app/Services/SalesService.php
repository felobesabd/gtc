<?php
namespace App\Services;

use App\Models\Sales;
use Yajra\Datatables\Datatables;

class SalesService
{
    public function getSales(): object
    {
        $model = Sales::all();
        return $this->getTableData(model: $model);
    }

    public function createSales($data): object
    {
        $model = Sales::create($data);

        $folder = 'sales-attachment';
        editOrCreateFile(
            folder: $folder,
            obj: $model,
            attachment: $data['attachment'] ?? null,
            relation: 'attachment',
            attach_col_name: 'attachment_id'
        );

        return $model;
    }

    public function updateSales(Sales $sales, array $data): bool
    {
        $attachment = null;
        if (isset($data['attachment']) && $data['attachment'] instanceof \Illuminate\Http\UploadedFile) {
            $attachment = $data['attachment'];
        }

        $folder = 'sales-attachment';
        editOrCreateFile(
            folder: $folder,
            obj: $sales,
            attachment: $data['attachment'],
            relation: 'attachment',
            attach_col_name: 'attachment_id'
        );

        return $sales->fill($data)->save();
    }

    public function deleteSales($id): bool
    {
        $sales = Sales::findOrFail($id);
        return $sales->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('image', function ($row) {
                if (isset($row->attachment->path) && is_string($row->attachment->path)) {
                    $url = url($row->attachment->path);
                    return '<a href="' . $url . '" target="_blank"><img style="width:50px" src="' . $url . '"></a>';
                }

                return '<p>No image available</p>';
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.sales.edit', ['sale' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.sales.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
}
