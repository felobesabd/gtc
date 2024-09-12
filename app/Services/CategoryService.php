<?php
namespace App\Services;

use App\Models\Category;
use Yajra\Datatables\Datatables;

class CategoryService
{
    public function getCategories(): object
    {
        $model = Category::all();
        return $this->getTableData(model: $model);
    }

    public function createCategory($data): object
    {
        $model = Category::create($data);
        return $model;
    }

    public function updateCategory(int $id, array $data): bool
    {
        $category = Category::findOrFail($id);
        return $category->fill($data)->save();
    }

    public function deleteCategory($id): bool
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.categories.edit', ['category' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.categories.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
