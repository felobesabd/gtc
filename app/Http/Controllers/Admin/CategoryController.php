<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController
{
    protected $catService;

    public function __construct(CategoryService $catService)
    {
        $this->catService = $catService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->catService->getCategories();
        }

        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->catService->createCategory(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->catService->updateCategory(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $category = $this->catService->deleteCategory($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
