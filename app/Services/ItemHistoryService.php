<?php
namespace App\Services;

use App\Models\ItemCategory;
use App\Models\ItemHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class ItemHistoryService
{
    public function getItemHistories(): object
    {
        $model = ItemHistory::all();
        return $this->getTableData(model: $model);
    }

    public function createItemHistory($data): object
    {
        DB::beginTransaction();

        try {
            $item = ItemCategory::find($data['item_id']);

            if ($item->quantity < $data['quantity_out']) {
                throw ValidationException::withMessages([
                    'quantity_out' => 'Item quantity not enough.',
                ]);
            }

            // Update item quantity
            $total_quantity = $item->quantity - $data['quantity_out'];
            $item->update(['quantity' => $total_quantity]);

            // calculation price
            $data['price'] = $data['quantity_out'] * $data['cost'];

            // Update the item history record
            $model = ItemHistory::create($data);

            DB::commit();
            return $model;

        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    //        $item = ItemCategory::where('id', $data['item_id'])->first();
//        if (!$item) {
//            throw new ValidationException('Item not found.');
//        }
//
//        if ($item->quantity >= $data['quantity_out']) {
//            $total_quantity = $item->quantity - $data['quantity_out'];
//            $update_quantity = $item->update(['quantity' => $total_quantity]);
//
//            // calculation price
//            $data['price'] = $data['quantity_out'] * $data['cost'];
//            $model = ItemHistory::create($data);
//        } else {
//            throw new ValidationException('Item quantity not enough.');
//        }
//
//        return $model;

    public function updateItemHistory(int $id, array $data): bool
    {
        DB::beginTransaction();
        $itemCat = ItemHistory::findOrFail($id);

        try {
            $item = ItemCategory::find($data['item_id']);
            $add_quantity_after_change = $item->quantity + $itemCat->quantity_out;

            $item->update(['quantity' => $add_quantity_after_change]);

            if ($item->quantity < $data['quantity_out']) {
                throw ValidationException::withMessages([
                    'quantity_out' => 'Item quantity not enough.',
                ]);
            }

            // Update item quantity
            $total_quantity = $item->quantity - $data['quantity_out'];
            $item->update(['quantity' => $total_quantity]);

            // calculation price
            $data['price'] = $data['quantity_out'] * $data['cost'];

            // Update the item history record
            $model = $itemCat->fill($data)->save();

            DB::commit();
            return $model;

        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    //        $item = ItemCategory::where('id', $itemCat->item_id)->first();
//        if (!$item) {
//            throw new ValidationException('Item not found.');
//        }
//
//        if ($item->quantity >= $data['quantity_out']) {
//            $total_quantity = $item->quantity - $data['quantity_out'];
//            $update_quantity = $item->update(['quantity' => $total_quantity]);
//
//            // calculation price
//            $data['price'] = $data['quantity_out'] * $data['cost'];
//
//
//            return $itemCat->fill($data)->save();
//
//        } else {
//            throw new ValidationException('Item quantity not enough.');
//        }

    public function deleteItemHistory($id): bool
    {
        $itemCat = ItemHistory::findOrFail($id);
        return $itemCat->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->editColumn('item_id', function ($row) {
                return $row->itemCategory->item_name;
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.item_history.edit', ['item_history' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.item_history.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function totalCost($data)
    {
        $total_cost = $data['parts_cost'] + $data['subcontractor_cost'] + $data['lubrication_cost'];
        return $total_cost;
    }
}
