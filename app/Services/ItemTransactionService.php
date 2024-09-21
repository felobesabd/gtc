<?php
namespace App\Services;

use App\Models\ItemCategory;
use App\Models\ItemTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class ItemTransactionService
{
    public function getItemTransactions(): object
    {
        $model = ItemTransaction::all();
        return $this->getTableData(model: $model);
    }

    public function createItemTransaction($data): object
    {
        DB::beginTransaction();

        try {
            $item = ItemCategory::find($data['item_id']);

            if ($data['transaction_type'] == 1 ) {
                $quantity_in = $item->quantity + $data['quantity'];
                $item->update(['quantity' => $quantity_in]);
            } else {
                if ($item->quantity < $data['quantity']) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Item quantity not enough.',
                    ]);
                }

                // Update item quantity
                $total_quantity = $item->quantity - $data['quantity'];
                $item->update(['quantity' => $total_quantity]);
            }

            // calculation price
            $data['price'] = $data['quantity'] * $data['cost'];

            // Update the item history record
            $model = ItemTransaction::create($data);

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
//            $model = ItemTransaction::create($data);
//        } else {
//            throw new ValidationException('Item quantity not enough.');
//        }
//
//        return $model;

    public function updateItemTransaction(int $id, array $data): bool
    {
        DB::beginTransaction();
        $itemTransaction = ItemTransaction::findOrFail($id);

        try {
            $item = ItemCategory::find($data['item_id']);

            if ($data['transaction_type'] == 1 ) {
                $decrement_quantity = $item->quantity - $itemTransaction->quantity; // 20 - 15 = 5
                $item->quantity = $decrement_quantity + $data['quantity'];
                $item->update(['quantity' => $item->quantity]);
            } else {
                $add_quantity_after_change = $item->quantity + $itemTransaction->quantity;

                $item->update(['quantity' => $add_quantity_after_change]);

                if ($item->quantity < $data['quantity']) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Item quantity not enough.',
                    ]);
                }

                // Update item quantity
                $total_quantity = $item->quantity - $data['quantity'];
                $item->update(['quantity' => $total_quantity]);
            }

            // calculation price
            $data['price'] = $data['quantity'] * $data['cost'];

            // Update the item history record
            $model = $itemTransaction->fill($data)->save();

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

    public function deleteItemTransaction($id): bool
    {
        $itemCat = ItemTransaction::findOrFail($id);
        return $itemCat->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->editColumn('item_id', function ($row) {
                return $row->itemCategory->item_name;
            })
            ->editColumn('transaction_type', function ($row) {
                return $row->getTransactionType();
            })
            ->editColumn('user_id', function ($row) {
                return $row->username->full_name;
            })
            ->editColumn('supplier_id', function ($row) {
                return $row->supplier ? $row->supplier->company_name : '---';
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
