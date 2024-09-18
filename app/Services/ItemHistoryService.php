<?php
namespace App\Services;

use App\Models\ItemHistory;
use Illuminate\Support\Facades\Log;
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
        // Log::info('Storing Job Card:', $data);
        $model = ItemHistory::create($data);
        return $model;
    }

    public function updateItemHistory(int $id, array $data): bool
    {
        $itemCat = ItemHistory::findOrFail($id);
        return $itemCat->fill($data)->save();
    }

    public function deleteItemHistory($id): bool
    {
        $itemCat = ItemHistory::findOrFail($id);
        return $itemCat->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
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
