<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobCardRequest;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\ItemCategory;
use App\Models\JobCard;
use App\Models\Vehicle;
use App\Services\JobCardService;
use Illuminate\Http\Request;

class JobCardController
{
    protected $jobCardService;

    public function __construct(JobCardService $jobCardService)
    {
        $this->jobCardService = $jobCardService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->jobCardService->getJobCards();
        }

        return view('admin.jobCards.index');
    }

    public function show($id)
    {
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
        $vehicles = Vehicle::all();
        $employees = Employee::all();
        $drivers = Driver::all();
        $items = ItemCategory::all();
        return view('admin.jobCards.create', compact('vehicles','employees', 'drivers', 'items'));
    }

    public function store(JobCardRequest $request)
    {
        $job_card = $this->jobCardService->createJobCard(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        $job_card = JobCard::findOrFail($id);

        $job_card->staff_details = json_decode($job_card->staff_details, true);
        $selectedJobCardTypes = json_decode($job_card->job_card_type, true);
        $selectedRepairTypes = json_decode($job_card->repair_type, true);

        $vehicles = Vehicle::all();
        $employees = Employee::all();
        $drivers = Driver::all();
        $items = ItemCategory::all();

        return view('admin.jobCards.edit', compact(
            'job_card',
            'vehicles',
            'employees',
            'drivers',
            'selectedJobCardTypes',
            'selectedRepairTypes',
            'items'
        ));
    }

    public function update(JobCardRequest $request, $id)
    {
        $job_card = $this->jobCardService->updateJobCard(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $job_card = $this->jobCardService->deleteJobCard($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
