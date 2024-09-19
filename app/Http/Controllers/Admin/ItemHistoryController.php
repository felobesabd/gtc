<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemHistoryRequest;
use App\Models\ItemCategory;
use App\Models\ItemHistory;
use App\Services\ItemHistoryService;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ItemHistoryController
{
    protected $itemHistoryService;

    public function __construct(ItemHistoryService $itemHistoryService)
    {
        $this->itemHistoryService = $itemHistoryService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->itemHistoryService->getItemHistories();
        }

        return view('admin.itemHistory.index');
    }

    public function create()
    {
        $items = ItemCategory::all();
        return view('admin.itemHistory.create', compact('items'));
    }

    public function store(ItemHistoryRequest $request)
    {
        try {
            $itemHistory = $this->itemHistoryService->createItemHistory(data: $request->all());
            return redirect()->back()->with('success', 'Created successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('ex', $e->errors());
        }
    }

    public function edit(Request $request, $id)
    {
        $item_history = ItemHistory::findOrFail($id);
        $items = ItemCategory::all();
        return view('admin.itemHistory.edit', compact('item_history', 'items'));
    }

    public function update(ItemHistoryRequest $request, $id)
    {
        try {
            $itemHistory = $this->itemHistoryService->updateItemHistory(id: $id, data: $request->all());
            return redirect()->back()->with('success', 'Updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('ex', $e->errors());
        }
    }

    public function destroy($id)
    {
        $itemHistory = $this->itemHistoryService->deleteItemHistory($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
