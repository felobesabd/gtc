<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemTransactionRequest;
use App\Models\ItemCategory;
use App\Models\ItemTransaction;
use App\Models\Supplier;
use App\Models\User;
use App\Services\ItemTransactionService;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ItemTransactionController
{
    protected $itemTransactionService;

    public function __construct(ItemTransactionService $itemTransactionService)
    {
        $this->itemTransactionService = $itemTransactionService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->itemTransactionService->getItemTransactions();
        }

        return view('admin.itemTransaction.index');
    }

    public function create()
    {
        $items = ItemCategory::all();
        $suppliers = Supplier::all();
        $users = User::select('id', 'full_name')->get();
        return view('admin.itemTransaction.create', compact('items', 'suppliers', 'users'));
    }

    public function store(ItemTransactionRequest $request)
    {
        try {
            $ItemTransaction = $this->itemTransactionService->createItemTransaction(data: $request->all());
            return redirect()->back()->with('success', 'Created successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('ex', $e->errors());
        }
    }

    public function edit(Request $request, $id)
    {
        $item_history = ItemTransaction::findOrFail($id);
        $items = ItemCategory::all();
        $suppliers = Supplier::all();
        $users = User::select('id', 'full_name')->get();
        return view('admin.itemTransaction.edit', compact('item_history', 'items', 'suppliers', 'users'));
    }

    public function update(ItemTransactionRequest $request, $id)
    {
        try {
            // $ItemTransaction = $this->itemTransactionService->updateItemTransaction(id: $id, data: $request->all());
            return redirect()->back()->with('success', 'Updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('ex', $e->errors());
        }
    }

    public function destroy($id)
    {
        $ItemTransaction = $this->itemTransactionService->deleteItemTransaction($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
