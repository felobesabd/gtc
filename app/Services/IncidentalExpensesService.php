<?php
namespace App\Services;

use App\Models\IncidentalExpenses;
use Yajra\Datatables\Datatables;

class IncidentalExpensesService
{
    public function getExpenses(): object
    {
        $model = IncidentalExpenses::all();
        return $this->getTableData(model: $model);
    }

    public function createExpense($data): object
    {
        $model = IncidentalExpenses::create($data);

        $folder = 'incidental_expenses-attachment';
        editOrCreateFile(
            folder: $folder,
            obj: $model,
            attachment: $data['attachment'] ?? null,
            relation: 'attachment',
            attach_col_name: 'attachment_id'
        );

        return $model;
    }

    public function updateExpense(int $id, array $data): bool
    {
        $expense = IncidentalExpenses::findOrFail($id);

        $folder = 'incidental_expenses-attachment';
        editOrCreateFile(
            folder: $folder,
            obj: $expense,
            attachment: isset($data['attachment']) && $data['attachment'] instanceof \Illuminate\Http\UploadedFile ? $data['attachment'] : null,
            relation: 'attachment',
            attach_col_name: 'attachment_id'
        );
        return $expense->fill($data)->save();
    }

    public function deleteExpense($id): bool
    {
        $expense = IncidentalExpenses::findOrFail($id);
        return $expense->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('image', function ($row) {
                if (isset($row->attachment->path) && is_string($row->attachment->path)) {
                    $url = url($row->attachment->path);
                    return '<a href="' . $url . '" target="_blank"><img style="width:50px" src="' . $url . '"></a>';
                }

                return '<p>No image available</p>';
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.expenses.edit', ['expense' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.expenses.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
}
