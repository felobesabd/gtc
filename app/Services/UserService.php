<?php 
namespace App\Services;

use App\Enums\Status;
use App\Models\User;
use Yajra\Datatables\Datatables;

class UserService
{

    public function getUsers($data): object
    {
        $model = User::with('roles')
            ->whereHas("roles", function ($q) use ($data) {
                $q->whereIn("name", [$data['user_role']]);
            })
            ->when(!empty($data['status']), function ($query) use ($data) {
                $query->where('status', $data['status']);
            });
        return $this->getTableData(model: $model);
    }

    public function updateUser(int $id, array $data): bool
    {
        $user = User::findOrFail($id);
        return $user->fill($data)->save();
    }

    public function deleteUser($id): bool
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->editColumn('status', function ($row) {
                $res = Status::tryFrom($row->status)?->probertyName();
                return $res;
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.users.edit', ['user' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.users.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}