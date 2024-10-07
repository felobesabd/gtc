<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobCardRequest;
use App\Models\ItemCategory;
use App\Models\ItemDetails;
use App\Models\JobCard;
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

            $partNumbers = $request->input('part_number');
            $quantities = $request->input('quantity');
            $descriptions = $request->input('description');
            $costs = $request->input('cost');

            foreach ($partNumbers as $index => $partNumber) {
                $item = ItemCategory::where('part_no', $partNumber)->first();

                if (!$item || $item->quantity < $quantities[$index]) {
                    return response()->json([
                        'message' => 'Item quantity not enough for part number: ' . $partNumber,
                        'errors' => [
                            'quantity' => ['Item quantity not enough for part number: ' . $partNumber],
                        ]
                    ], 422);
                }

                ItemDetails::create([
                    'job_card_id' => $job_card->id,
                    'part_number' => $partNumber,
                    'quantity' => $quantities[$index],
                    'description' => $descriptions[$index],
                    'cost' => $costs[$index],
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

            $jobCardItemIds= $request->input('jobCardItemIds');

            $partNumbers = $request->input('part_number');
            $quantities = $request->input('quantity');
            $descriptions = $request->input('description');
            $costs = $request->input('cost');
            $deletedItemsIds = $request->input('deleted_items_indexes');
            $deletedItemsIds = json_decode($deletedItemsIds, true);
            $deletedItemsIds = array_values($deletedItemsIds);

            foreach ($partNumbers as $index => $partNumber) {
                $item = ItemCategory::where('part_no', $partNumber)->first();

                if (!$item || $item->quantity < $quantities[$index]) {
                    return response()->json([
                        'message' => 'Item quantity not enough for part number: ' . $partNumber,
                        'errors' => [
                            'quantity' => ['Item quantity not enough for part number: ' . $partNumber],
                        ]
                    ], 422);
                }


                // dd($jobCardItemIds[$index]);

                if ($jobCardItemIds[$index]) {
                    $itemDetailsObj = ItemDetails::where('id', $jobCardItemIds[$index])->first();

                    if (in_array($itemDetailsObj->id, $deletedItemsIds)) {
                        continue;
                    }

                    $itemDetailsObj->job_card_id = $jobCard->id;
                    $itemDetailsObj->part_number = $partNumbers[$index];
                    $itemDetailsObj->quantity = $quantities[$index];
                    $itemDetailsObj->description = $descriptions[$index];
                    $itemDetailsObj->cost = $costs[$index];
                    $itemDetailsObj->save();
                } else {
                    ItemDetails::create([
                        'job_card_id' => $jobCard->id,
                        'part_number' => $partNumbers[$index],
                        'quantity' => $quantities[$index],
                        'description' => $descriptions[$index],
                        'cost' => $costs[$index],
                    ]);
                }
            }

            ItemDetails::whereIn('id', $deletedItemsIds)->delete();

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
