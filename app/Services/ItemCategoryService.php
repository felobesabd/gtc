<?php
namespace App\Services;

use App\Models\ItemCategory;
use Yajra\Datatables\Datatables;

class ItemCategoryService
{
    public function getItemCats(): object
    {
        $model = ItemCategory::all();
        return $this->getTableData(model: $model);
    }

    public function createItemCat($data): object
    {
        $model = ItemCategory::create($data);
        return $model;
    }

    public function updateItemCat(int $id, array $data): bool
    {
        $itemCat = ItemCategory::findOrFail($id);
        return $itemCat->fill($data)->save();
    }

    public function deleteItemCat($id): bool
    {
        $itemCat = ItemCategory::findOrFail($id);
        return $itemCat->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.itemCats.edit', ['itemCat' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.itemCats.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
