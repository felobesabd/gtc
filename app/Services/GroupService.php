<?php
namespace App\Services;

use App\Models\Group;
use Yajra\Datatables\Datatables;

class GroupService
{
    public function getGroups(): object
    {
        $model = Group::all();
        return $this->getTableData(model: $model);
    }

    public function createGroup($data): object
    {
        $model = Group::create($data);
        return $model;
    }

    public function updateGroup(int $id, array $data): bool
    {
        $category = Group::findOrFail($id);
        return $category->fill($data)->save();
    }

    public function deleteGroup($id): bool
    {
        $category = Group::findOrFail($id);
        return $category->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.groups.edit', ['group' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.groups.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
