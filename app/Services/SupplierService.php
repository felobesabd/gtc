<?php
namespace App\Services;

use App\Models\Supplier;
use App\Models\SupplierContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class SupplierService
{
    public function getSuppliers(): object
    {
        $model = Supplier::all();
        return $this->getTableData(model: $model);
    }

    public function createSupplier($data): object
    {
        DB::beginTransaction();
        try {
            $model = Supplier::create($data);

            $suppliers = $data['supplier_name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $whats_app = $data['whats_app'];
            $department = $data['department'];

            // dd($suppliers);
            foreach ($suppliers as $index => $supplier) {
                SupplierContact::create([
                    'supplier_id' => $model->id,
                    'supplier_name' => $supplier,
                    'email' => $email[$index],
                    'phone' => $phone[$index],
                    'whats_app' => $whats_app[$index],
                    'department' => $department[$index],
                ]);
            }

            DB::commit();
            return $model;
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function updateSupplier(int $id, array $data): bool
    {
        $model = Supplier::findOrFail($id);
        DB::beginTransaction();
        try {
            $supplierContactsIds = $data['supplierContactIds'];

            $suppliers = $data['supplier_name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $whats_app = $data['whats_app'];
            $department = $data['department'];

            $suppliers_add = array_filter($data['supplier_name_add']);
            $email_add = array_filter($data['email_add']);
            $phone_add = array_filter($data['phone_add']);
            $whats_app_add = array_filter($data['whats_app_add']);
            $department_add = array_filter($data['department_add']);

            $deletedContactIds = $data['deleted_supplier_contact_indexes'];
            $deletedContactIds = json_decode($deletedContactIds, true);
            $deletedContactIds = array_values($deletedContactIds);


            if (!empty($suppliers_add)) {
                foreach ($suppliers_add as $index => $supplier) {
                    SupplierContact::create([
                        'supplier_id' => $model->id,
                        'supplier_name' => $supplier,
                        'email' => $email_add[$index],
                        'phone' => $phone_add[$index],
                        'whats_app' => $whats_app_add[$index] ?? null,
                        'department' => $department_add[$index] ?? null,
                    ]);
                }
            }

            foreach ($suppliers as $index => $supplier) {
                $supplierContactObj = SupplierContact::where('id', $supplierContactsIds[$index])->first();

                if (in_array($supplierContactObj->id, $deletedContactIds)) {
                    continue;
                }
                $supplierContactObj->supplier_id = $model->id;
                $supplierContactObj->supplier_name = $supplier;
                $supplierContactObj->email = $email[$index];
                $supplierContactObj->phone = $phone[$index];
                $supplierContactObj->whats_app = $whats_app[$index];
                $supplierContactObj->department = $department[$index];
                $supplierContactObj->save();
            }

            SupplierContact::whereIn('id', $deletedContactIds)->delete();

            DB::commit();
            return $model->fill($data)->save();

        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteSupplier($id): bool
    {
        $driver = Supplier::findOrFail($id);
        return $driver->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.suppliers.show', ['supplier' => $row->id]) . '" class="btn btn-info" onclick="return true;">
                        View
                    </a>
                    <a href="' . route('admin.suppliers.edit', ['supplier' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.suppliers.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
