<?php
namespace App\Services;

use App\Models\ItemCategory;
use App\Models\ItemDetails;
use App\Models\JobCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class JobCardService
{
    public function getJobCards(): object
    {
        $model = JobCard::all();
        return $this->getTableData(model: $model);
    }

    public function createJobCard($data): object
    {
        $data['job_card_type'] = json_encode($data['job_card_type']);
        $data['repair_type'] = json_encode($data['repair_type']);

       return $job_card = $this->handleJobCard(null, $data);
    }

    public function updateJobCard(int $id, array $data): bool
    {
        $job_card = JobCard::where('id', $id)->first();

        if (!$job_card) {
            throw new \Exception('Failed to update job card');
        }

        $updatedJobCard = $this->handleJobCard($job_card, $data);
        return $updatedJobCard instanceof JobCard;
    }

    public function updateJobCardStatus(int $id, array $data): bool
    {
        DB::beginTransaction();
        try {
            $job_card = JobCard::findOrFail($id);
            $itemDetails = ItemDetails::where('job_card_id', $job_card->id)->get();

            foreach ($itemDetails as $index => $itemDetail) {

                $item_id = $itemDetail->item_id;
                $quantity = $itemDetail->quantity;

                $item = ItemCategory::where('id', $item_id)->first();

                if (!$item || $item->quantity < $quantity) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Item quantity not enough for part number: ' . $item_id,
                    ]);
                }

                if ($data['status'] == '3') {
                    $item->update(['quantity' => $item->quantity - $quantity]);
                }
            }

            // check status and update quantity
//            if ($data['status'] == '1') {
//                $quantity = $item->quantity - $job_card->quantity;
//                $item->update(['quantity' => $quantity]);
//            }

            DB::commit();
            return $job_card->fill($data)->save();
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteJobCard($id): bool
    {
        $itemCat = JobCard::findOrFail($id);
        return $itemCat->delete();
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->editColumn('vehicle_id', function (JobCard $jobCard) {
                $vehicle = $jobCard->getVehicleDetails($jobCard->vehicle_id);
                return $vehicle['vehicle_type'] . ' -- ' . $vehicle['group_name'] . ' -- ' . $vehicle['category_name'];
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 0)
                    $html = '<label for="" class="text-warning">Pending</label>';
                elseif ($row->status == 1)
                    $html = '<label for="" class="text-success">Completed</label>';
                elseif ($row->status == 2)
                    $html = '<label for="" class="text-danger">Canceled</label>';
                else
                    $html = '<label for="" class="text-info">Parts Received</label>';

                return $html;
            })
            ->addColumn('action', function ($row) {
                $res = '
                    <a href="' . route('admin.job_cards.show', ['job_card' => $row->id]) . '" class="btn btn-info" onclick="return true;">
                        View
                    </a>
                    <a href="' . route('admin.job_cards.edit', ['job_card' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        Edit
                    </a>
                    <a href="' . route('admin.job_cards.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirmMsg();">
                        Delete
                    </a>
                    ';
                return $res;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function totalCost($data)
    {
        $total_cost = $data['parts_cost'] + $data['subcontractor_cost'] + $data['lubrication_cost'];
        return $total_cost;
    }

    private function handleJobCard($model, $data)
    {
        DB::beginTransaction();
        try {
            // $item = ItemCategory::where('part_no', $data['part_number'])->first();

//            if ($item->quantity < $data['quantity']) {
//                throw ValidationException::withMessages([
//                    'quantity' => 'Item quantity not enough.',
//                ]);
//            }

            // calculation price
            $data['total_cost'] = $this->totalCost($data);

            // create the job card
            if (is_null($model)) {
                $model = JobCard::create($data);
            }

            $model->fill($data)->save();

            DB::commit();
            return $model;
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
