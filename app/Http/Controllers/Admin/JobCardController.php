<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobCardRequest;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\ItemCategory;
use App\Models\ItemDetails;
use App\Models\ItemTransaction;
use App\Models\JobCard;
use App\Models\Vehicle;
use App\Services\JobCardService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobCardController
{
    protected $jobCardService;

    public function __construct(JobCardService $jobCardService)
    {
        $this->jobCardService = $jobCardService;
    }

    public function index(Request $request)
    {
        checkUserHasRolesOrRedirect('job_card.list');

        if ($request->ajax()) {
            return $this->jobCardService->getJobCards();
        }

        return view('admin.jobCards.index');
    }

    public function show($id)
    {
        checkUserHasRolesOrRedirect('job_card.show');

        $job_card = JobCard::findOrFail($id);
        $job_card->staff_details = json_decode($job_card->staff_details, true);
        $selectedJobCardTypes = json_decode($job_card->job_card_type, true);
        $selectedRepairTypes = json_decode($job_card->repair_type, true);

        $vehicles = Vehicle::all();
        $employees = Employee::all();
        $drivers = Driver::all();
        $items = ItemCategory::all();

        return view('admin.jobCards.view', compact(
            'job_card',
            'vehicles',
            'employees',
            'drivers',
            'selectedJobCardTypes',
            'selectedRepairTypes',
            'items'
        ));
    }

    public function create()
    {
        checkUserHasRolesOrRedirect('job_card.add');

        $vehicles = Vehicle::all();
        $employees = Employee::all();
        $drivers = Driver::all();
        $items = ItemCategory::all();
        $itemCost = ItemTransaction::select('id', 'item_id', 'cost')->where('transaction_type', 1)->get();

        return view('admin.jobCards.create', compact(
            'vehicles',
            'employees',
            'drivers',
            'items',
            'itemCost',
        ));
    }

    public function store(JobCardRequest $request)
    {
        $job_card = $this->jobCardService->createJobCard(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');

    }

    public function edit(Request $request, $id)
    {
        checkUserHasRolesOrRedirect('job_card.edit');

        $job_card = JobCard::findOrFail($id);
        $job_card->staff_details = json_decode($job_card->staff_details, true);
        $selectedJobCardTypes = json_decode($job_card->job_card_type, true);
        $selectedRepairTypes = json_decode($job_card->repair_type, true);

        $vehicles = Vehicle::all();
        $employees = Employee::all();
        $drivers = Driver::all();
        $items = ItemCategory::all();
        $jobCardItems = ItemDetails::where('job_card_id', $id)->get();
        $itemCost = ItemTransaction::select('id', 'item_id', 'cost')->where('transaction_type', 1)->get();

        return view('admin.jobCards.edit', compact(
            'job_card',
            'vehicles',
            'employees',
            'drivers',
            'selectedJobCardTypes',
            'selectedRepairTypes',
            'items',
            'jobCardItems',
            'itemCost'
        ));
    }

    public function update(JobCardRequest $request, $id)
    {
        $job_card = $this->jobCardService->updateJobCard(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function updateStatus(Request $request, $job_card) {
        $job_card = $this->jobCardService->updateJobCardStatus(id: $job_card, data: $request->all());
        return redirect()->back()->with('success', 'Created job card successfully');
    }

    public function destroy($id)
    {
        checkUserHasRolesOrRedirect('job_card.delete');

        $job_card = $this->jobCardService->deleteJobCard($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
