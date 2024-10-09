<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobCardRequest;
use App\Models\ItemCategory;
use App\Models\ItemDetails;
use App\Models\JobCard;
use App\Models\JobCardEmployees;
use App\Services\JobCardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ItemDetailsController
{
    protected $jobCardService;

    public function __construct(JobCardService $jobCardService)
    {
        $this->jobCardService = $jobCardService;
    }

    public function createItemDetails(JobCardRequest $request) {
        DB::beginTransaction();
        try {
            $job_card = $this->jobCardService->createJobCard(data: $request->all());

            // item details
            $partNumbers = $request->input('item_id');
            $quantities = $request->input('quantity');
            $descriptions = $request->input('description');
            $costs = $request->input('cost');

            // employees
            $employees = $request->input('employee_id');
            $employee_time = $request->input('estimated_time_employee');

            foreach ($partNumbers as $index => $partNumber) {
                /*$item = ItemCategory::where('part_no', $partNumber)->first();

                if (!$item || $item->quantity < $quantities[$index]) {
                    return response()->json([
                        'message' => 'Item quantity not enough for part number: ' . $partNumber,
                        'errors' => [
                            'quantity' => ['Item quantity not enough for part number: ' . $partNumber],
                        ]
                    ], 422);
                }*/

                ItemDetails::create([
                    'job_card_id' => $job_card->id,
                    'item_id' => $partNumber,
                    'quantity' => $quantities[$index],
                    'description' => $descriptions[$index],
                    'cost' => $costs[$index],
                ]);
            }

            foreach ($employees as $index => $employee) {
                JobCardEmployees::create([
                    'job_card_id' => $job_card->id,
                    'employee_id' => $employee,
                    'estimated_time_employee' => $employee_time[$index],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Job card and item details created successfully',
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateItemDetails(JobCardRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $jobCard = JobCard::findOrFail($request->job_card_id);
            $jobCard->fill($data)->save();

            $jobCardItemIds = $request->input('jobCardItemIds');
            $jobCardEmployeeIds = $request->input('jobCardEmployeeIds');

            $partNumbers = $request->input('item_id');
            $quantities = $request->input('quantity');
            $descriptions = $request->input('description');
            $costs = $request->input('cost');
            $deletedItemsIds = $request->input('deleted_items_indexes');
            $deletedItemsIds = json_decode($deletedItemsIds, true);
            $deletedItemsIds = array_values($deletedItemsIds);

            $deletedEmployeeIds = $request->input('deleted_employees_indexes');
            $deletedEmployeeIds = json_decode($deletedEmployeeIds, true);
            $deletedEmployeeIds = array_values($deletedEmployeeIds);

            foreach ($partNumbers as $index => $partNumber) {
                // check quantity
                /*$item = ItemCategory::where('part_no', $partNumber)->first();

                if (!$item || $item->quantity < $quantities[$index]) {
                    return response()->json([
                        'message' => 'Item quantity not enough for part number: ' . $partNumber,
                        'errors' => [
                            'quantity' => ['Item quantity not enough for part number: ' . $partNumber],
                        ]
                    ], 422);
                }*/

                if ($jobCardItemIds[$index]) {
                    $itemDetailsObj = ItemDetails::where('id', $jobCardItemIds[$index])->first();

                    if (in_array($itemDetailsObj->id, $deletedItemsIds)) {
                        continue;
                    }
                    $itemDetailsObj->job_card_id = $jobCard->id;
                    $itemDetailsObj->item_id = $partNumbers[$index];
                    $itemDetailsObj->quantity = $quantities[$index];
                    $itemDetailsObj->description = $descriptions[$index];
                    $itemDetailsObj->cost = $costs[$index];
                    $itemDetailsObj->save();
                } else {
                    // add => clone another names from form and create
                    ItemDetails::create([
                        'job_card_id' => $jobCard->id,
                        'item_id' => $partNumbers[$index],
                        'quantity' => $quantities[$index],
                        'description' => $descriptions[$index],
                        'cost' => $costs[$index],
                    ]);
                }
            }

            ItemDetails::whereIn('id', $deletedItemsIds)->delete();

            // employees
            $employees = $request->input('employee_id');
            $employee_time = $request->input('estimated_time_employee');

            $employees_hide = $request->input('employee_id_2');
            $employee_time_hide = $request->input('estimated_time_employee_2');

            if ($employees_hide) {
                foreach ($employees_hide as $index => $employee_hide) {
                    JobCardEmployees::create([
                        'job_card_id' => $jobCard->id,
                        'employee_id' => $employee_hide,
                        'estimated_time_employee' => $employee_time_hide[$index],
                    ]);
                }
            }

//            $jobCardEmployee = JobCardEmployees::where('job_card_id', $jobCard->id)->get();
            foreach ($employees as $index => $employee) {
                $jobCardEmployeeObj = JobCardEmployees::where('id', $jobCardEmployeeIds[$index])->first();
                //dd($jobCardEmployeeObj);

                if (in_array($jobCardEmployeeObj->id, $deletedEmployeeIds)) {
                    continue;
                }


                $jobCardEmployeeObj->job_card_id = $jobCard->id;
                $jobCardEmployeeObj->employee_id = $employee;
                $jobCardEmployeeObj->estimated_time_employee = $employee_time[$index];
                $jobCardEmployeeObj->save();
            }

            JobCardEmployees::whereIn('id', $deletedEmployeeIds)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Job card and item details updated successfully',
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occurred while updating job card and item details',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
