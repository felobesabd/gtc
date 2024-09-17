<?php
namespace App\Services;

use App\Models\JobCard;
use Illuminate\Support\Facades\Log;
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
        $data['staff_details'] = json_encode($data['staff_details']);

        $data['total_cost'] = $this->totalCost($data);

//        Log::info('Storing Job Card:', $data);

        $model = JobCard::create($data);
        return $model;
    }

    public function updateJobCard(int $id, array $data): bool
    {
        $itemCat = JobCard::findOrFail($id);

        $data['total_cost'] = $this->totalCost($data);
        return $itemCat->fill($data)->save();
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
            ->rawColumns(['action'])
            ->make(true);
    }

    public function totalCost($data)
    {
        $total_cost = $data['parts_cost'] + $data['subcontractor_cost'] + $data['lubrication_cost'];
        return $total_cost;
    }
}
