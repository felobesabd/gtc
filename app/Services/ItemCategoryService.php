<?php
namespace App\Services;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
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

    public function searchItems(Request $request)
    {
        $search = $request->get('term');

        $items = ItemCategory::where('part_no', 'LIKE', '%' . $search . '%')->pluck('part_no');
        return $items;
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
            ->editColumn('category_id', function (ItemCategory $item) {
                return $item->getNameById('categories', $item->category_id, 'id', 'category_id', 'category_name');
            })
            ->editColumn('group_id', function (ItemCategory $item) {
                return $item->getNameById('groups', $item->group_id, 'id',  'group_id','group_name');
            })
            ->editColumn('unit_id', function (ItemCategory $item) {
                return $item->getNameById('units', $item->unit_id, 'id',  'unit_id','name');
            })
            ->editColumn('rate', function ($row) {
                if (is_null($row->rate)) {
                    return '---';
                } else {
                    return $row->rate;
                }
            })
            ->editColumn('rate_per', function ($row) {
                if (is_null($row->rate_per)) {
                    return '---';
                } else {
                    return $row->rate_per;
                }
            })
            ->editColumn('min_allowed_value', function ($row) {
                if (is_null($row->min_allowed_value)) {
                    return '---';
                } else {
                    return $row->min_allowed_value;
                }
            })
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
