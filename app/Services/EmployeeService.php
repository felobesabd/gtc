<?php
namespace App\Services;

use App\Models\Department;
use App\Models\Employee;
use App\Traits\DateFormatterTrait;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class EmployeeService
{
    use DateFormatterTrait;

    public function getEmployees(): object
    {
        $model = Employee::all();
        return $this->getTableData(model: $model);
    }

    public function createEmployee($data): object
    {
        $data = $this->formatDates($data);
        $model = Employee::create($data);

        $this->handleAttachmentOnly($model, $data);
        // $this->handleAttachments($model, $data['attachments'] ?? null);
        return $model;
    }

    public function updateEmployee($id, array $data): bool
    {
        $employee = Employee::findOrFail($id);

        DB::beginTransaction();

        try {
            $data = $this->formatDates($data);

            foreach ($data as $inputName => $inputValue) {
                if ($inputValue instanceof \Illuminate\Http\UploadedFile) {
                    $folder = "{$inputName}-attachment";

                    $attachmentId = editOrCreateFileReturnId(
                        folder: $folder,
                        obj: $employee,
                        attachment: $inputValue,
                        relation: $inputName . 'Attachment',
                        attach_col_name: "{$inputName}"
                    );

                    $data["{$inputName}"] = $attachmentId;
                }
            }

            $employee->fill($data)->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteEmployee($id): bool
    {
        $employee = Employee::findOrFail($id);
        return $employee->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->editColumn('department_id', function (Employee $employee) {
                return $employee->getDepartmentName($employee->department_id);
            })
            ->editColumn('date_of_birth', function ($employee) {
                return date('d-M-y', strtotime($employee->date_of_birth));
            })
            ->editColumn('joining_date', function ($employee) {
                return date('d-M-y', strtotime($employee->joining_date));
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.employees.show', ['employee' => $row->id]) . '" class="btn btn-info" onclick="return true;">
                        View
                    </a>
                    <a href="' . route('admin.employees.edit', ['employee' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.employees.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function formatDates(array $data): array
    {
        $dateFields = [
            'date_of_birth',
            'joining_date',
            'driving_license_expires_at',
            'driving_license_issued_at',
            'passport_expires_at',
            'passport_issued_at',
            'medical_issued_at',
            'medical_expires_at',
            'life_issued_at',
            'life_expires_at',
        ];

        foreach ($dateFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = $this->formatDate($data[$field]);
            }
        }
        return $data;
    }

    private function handleAttachments($model, $attachments = null): void
    {
        if (!is_array($attachments)) {
            $attachments = [];
        }

        $folder = 'employees-attachment';
        editOrCreateMultipleFiles(
            folder: $folder,
            obj: $model,
            attachments: $attachments,
            attach_col_name: 'attachments_ids'
        );
    }
    private function handleAttachmentOnly($model, $data = null): void
    {
        // check if file input
        // loop on files input. value of $folder = '{name file input}-attachment'
        // editOrCreateFile to every input specific column

        foreach ($data as $inputName => $inputValue) {
            if ($inputValue instanceof \Illuminate\Http\UploadedFile) {
                $folder = "{$inputName}-attachment";

                editOrCreateFile(
                    folder: $folder,
                    obj: $model,
                    attachment: $inputValue,
                    relation: $inputName . 'Attachment',
                    attach_col_name: "{$inputName}"
                );
            }
        }
    }
}
