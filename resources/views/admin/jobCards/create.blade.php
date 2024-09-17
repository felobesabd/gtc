@extends('admin.layout.master')

@section('title')
Job Card
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.job_cards.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Choose Vehicle</label>
                        <select class="form-control" name="vehicle_id">
                                <option selected disabled hidden>Choose</option>
                            @foreach($vehicles as $vehicle)
                                <option data-group='{{ $vehicle->group_id }}'
                                        data-category='{{ $vehicle->category_id }}'
                                        value="{{ $vehicle->id }}">
                                    {{ $vehicle->id }} -- {{ $vehicle->vehicle_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Delivered by</label>
                        <input type="text" class="form-control" name="delivered_by" value="{{ old('delivered_by') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Received by</label>
                        <input type="text" class="form-control" name="received_by" value="{{ old('received_by') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Ref Number</label>
                        <input type="text" class="form-control" name="ref_number" value="{{ old('ref_number') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Date In</label>
                        <input type="date" class="form-control" name="date_in" value="{{ old('date_in') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Expected Date Out</label>
                        <input type="date" class="form-control" name="expected_date_out" value="{{ old('expected_date_out') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Reg No</label>
                        <input type="text" class="form-control" name="reg_no" value="{{ old('reg_no') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">KM</label>
                        <input type="number" class="form-control" name="km" value="{{ old('km') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Expected Hour Out</label>
                        <input type="number" class="form-control" name="expected_hour_out" value="{{ old('expected_hour_out') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Location</label>
                        <input type="text" class="form-control" name="location" value="{{ old('location') }}">
                    </div>

                    <div class="fv-row mb-7 job-card-checkbox">
                        <label class="fs-6 fw-semibold mb-2">Site</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="site" id="reactive" value="1">
                            <label class="form-check-label" for="reactive">Reactive</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="site" id="proactive" value="2">
                            <label class="form-check-label" for="proactive">Proactive</label>
                        </div>
                    </div>

                    <!-- Job Card Type -->
                    <div class="fv-row mb-7 job-card-checkbox">
                        <label class="fs-6 fw-semibold mb-2">Job Card Type</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="internal" name="job_card_type[]"
                                   value="1">
                            <label class="form-check-label" for="internal">Internal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="breakdown" name="job_card_type[]"
                                   value="2">
                            <label class="form-check-label" for="breakdown">Breakdown</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="dealer_service" name="job_card_type[]"
                                   value="3">
                            <label class="form-check-label" for="dealer_service">Dealer Service</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="insurance" name="job_card_type[]"
                                   value="4">
                            <label class="form-check-label" for="insurance">Insurance</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="outside_garage" name="job_card_type[]"
                                   value="5">
                            <label class="form-check-label" for="outside_garage">Outside Garage</label>
                        </div>
                    </div>

                    <!-- Repair Type -->
                    <div class="fv-row mb-7 job-card-checkbox">
                        <label class="fs-6 fw-semibold mb-2">Repair Type</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="normal" name="repair_type[]"
                                   value="1">
                            <label class="form-check-label" for="normal">Normal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="accident" name="repair_type[]"
                                   value="2">
                            <label class="form-check-label" for="accident">Accident</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="major" name="repair_type[]"
                                   value="3">
                            <label class="form-check-label" for="major">Major</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="pms" name="repair_type[]" value="4">
                            <label class="form-check-label" for="pms">PMS</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="safety" name="repair_type[]"
                                   value="5">
                            <label class="form-check-label" for="safety">Safety</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="warranty" name="repair_type[]"
                                   value="6">
                            <label class="form-check-label" for="warranty">Warranty</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="repetitive" name="repair_type[]"
                                   value="7">
                            <label class="form-check-label" for="repetitive">Repetitive</label>
                        </div>
                    </div>

                    <!-- Work Required -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Work Required</label>
                        <textarea class="form-control" name="work_required" rows="3">{{ old('work_required') }}</textarea>
                    </div>

                    <!-- Estimated Time and Staff Details -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Estimated Time</label>
                        <input type="text" class="form-control" name="estimated_time" value="{{ old('estimated_time') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Staff Details</label>
                        <select class="form-control" name="staff_details[]" multiple>
                            <option selected disabled hidden>Choose</option>
                            @foreach($employees as $employee)
                                <option value={{ $employee->id }}>{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Comments -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Comments</label>
                        <textarea class="form-control" name="comments" rows="3">{{ old('comments') }}</textarea>
                    </div>

                    <!-- Costs -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Lubrication Cost</label>
                        <input type="number" class="form-control" step="0.01" name="lubrication_cost" value="{{ old('lubrication_cost') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Subcontractor Cost</label>
                        <input type="number" class="form-control" step="0.01" name="subcontractor_cost" value="{{ old('subcontractor_cost') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Parts Cost</label>
                        <input type="number" class="form-control" step="0.01" name="parts_cost" value="{{ old('parts_cost') }}">
                    </div>

                    <!--  -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Driver</label>
                        <select class="form-control" name="driver_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Operation Coordinator</label>
                        <input type="text" class="form-control" name="operation_coordinator" value="{{ old('operation_coordinator') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Maintenance Supervisor</label>
                        <input type="text" class="form-control" name="maintenance_supervisor" value="{{ old('maintenance_supervisor') }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Maintenance Manager</label>
                        <input type="text" class="form-control" name="maintenance_manager" value="{{ old('maintenance_manager') }}">
                    </div>

                </div>
                <!--end::Modal body-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
        </div>
    </form>
</div>
<!--end::Content container-->
@endsection

@push('footer')
    <script>
        $(document).ready(function () {
            $('select[name="vehicle_id"] option').each(function () {
                var $option = $(this);
                var groupId = $option.data('group');

                if (groupId) {
                    $.ajax({
                        url: '{{ route('admin.groups.specific', ['id' => '__GROUP_ID__']) }}'.replace('__GROUP_ID__', groupId),
                        type: 'GET',
                        success: function (response) {
                            var groupName = response.group_name;

                            var originalText = $option.text();
                            $option.text(originalText + ' -- ' + groupName);
                        },
                        error: function () {
                            console.log('Error group name for group ID: ' + groupId);
                        }
                    });
                }
            });

            $('select[name="vehicle_id"] option').each(function () {
                var $option = $(this);
                var catId = $option.data('category');

                if (catId) {
                    $.ajax({
                        url: '{{ route('admin.categories.specific', ['id' => '__CAT_ID__']) }}'.replace('__CAT_ID__', catId),
                        type: 'GET',
                        success: function (response) {
                            var catName = response.category_name;

                            var originalText = $option.text();
                            $option.text(originalText + ' -- ' + catName);
                        },
                        error: function () {
                            console.log('Error group name for group ID: ' + catId);
                        }
                    });
                }
            });
        });
    </script>
@endpush
