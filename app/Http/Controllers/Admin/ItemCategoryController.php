<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemCategoryRequest;
use App\Models\ItemCategory;
use App\Services\ItemCategoryService;
use Illuminate\Http\Request;

class ItemCategoryController
{
    protected $itemCatService;

    public function __construct(ItemCategoryService $itemCatService)
    {
        $this->itemCatService = $itemCatService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->itemCatService->getItemCats();
        }

        return view('admin.itemCategories.index');
    }

    public function create()
    {
        return view('admin.itemCategories.create');
    }

    public function store(ItemCategoryRequest $request)
    {
        $itemCat = $this->itemCatService->createItemCat(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        $itemCat = ItemCategory::findOrFail($id);
        return view('admin.itemCategories.edit', compact('itemCat'));
    }

    public function update(ItemCategoryRequest $request, $id)
    {
        $itemCat = $this->itemCatService->updateItemCat(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $itemCat = $this->itemCatService->deleteItemCat($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
