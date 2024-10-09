<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemCategoryRequest;
use App\Imports\ItemsImport;
use App\Models\Category;
use App\Models\Group;
use App\Models\ItemCategory;
use App\Models\Unit;
use App\Services\ItemCategoryService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class ItemCategoryController
{
    protected $itemCatService;

    public function __construct(ItemCategoryService $itemCatService)
    {
        $this->itemCatService = $itemCatService;
    }

    public function index(Request $request)
    {
        checkUserHasRolesOrRedirect('items.list');

        if ($request->ajax()) {
            return $this->itemCatService->getItemCats();
        }

        return view('admin.itemCategories.index');
    }

    public function create()
    {
        checkUserHasRolesOrRedirect('items.add');

        $categories = Category::all();
        $groups = Group::all();
        $units = Unit::all();
        return view('admin.itemCategories.create', compact('categories', 'groups', 'units'));
    }

    public function store(ItemCategoryRequest $request)
    {
        $itemCat = $this->itemCatService->createItemCat(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function employeeSearch(Request $request) {
        return $this->itemCatService->searchItems($request);
    }

    public function edit(Request $request, $id)
    {
        checkUserHasRolesOrRedirect('items.edit');

        $itemCat = ItemCategory::findOrFail($id);
        $categories = Category::all();
        $groups = Group::all();
        $units = Unit::all();

        return view('admin.itemCategories.edit', compact(
            'itemCat',
            'categories',
            'groups',
            'units'
        ));
    }

    public function update(ItemCategoryRequest $request, $id)
    {
        $itemCat = $this->itemCatService->updateItemCat(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        checkUserHasRolesOrRedirect('items.delete');

        $itemCat = $this->itemCatService->deleteItemCat($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function import(Request $request)
    {
        checkUserHasRolesOrRedirect('items.add');

        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls'
            ]);

            $categories = Category::all();
            $groups = Group::all();
            $units = Unit::all();

            Excel::import(new ItemsImport($categories, $groups, $units), $request->file('file'));

            return redirect()->back()->with('success', 'Items imported successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->with('ex', $e->errors());
        }
    }
}
