<?php

namespace App\Http\Controllers\Admin;

use App\Models\ItemHistory;
use App\Services\ItemHistoryService;
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

        return view('admin.jobCards.index');
    }

    public function show($id)
    {
        $job_card = ItemHistory::findOrFail($id);
        return view('admin.jobCards.view', compact('job_card',));
    }

    public function create()
    {
        return view('admin.jobCards.create', compact(''));
    }

    public function store(Request $request)
    {
        $job_card = $this->itemHistoryService->createItemHistory(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        $job_card = ItemHistory::findOrFail($id);
        return view('admin.jobCards.edit', compact(''));
    }

    public function update(Request $request, $id)
    {
        $job_card = $this->itemHistoryService->updateItemHistory(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $job_card = $this->itemHistoryService->deleteItemHistory($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
