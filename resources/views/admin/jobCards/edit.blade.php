@extends('admin.layout.master')

@section('title')
Job Card
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">

    @if(auth()->user()->hasRole(['deputy warehouse manager', 'warehouse manager']))
        <form class="form" action="{{ route('admin.job_card.status', ['job_card' => $job_card->id]) }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PATCH"/>
            <div class="row">
                <div class="card card-flush py-10">
                    <div class="card-header border-0 pt-6 pb-6">
                        <label class="fs-6 fw-semibold mb-2">Status</label>
                        <select class="form-control" name="status" required>
                            <option disabled selected>...</option>
                            @foreach(StatusEnum::jobCardCases() as $status)
                                <option @if($job_card->status === $status->value) selected
                                        @endif value="{{$status->value}}">{{$status->probertyName()}}</option>
                            @endforeach
                        </select>
                    </div>
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
    @endif

    <form class="form" id="form" action="{{ route('admin.job_cards.update', ['job_card' => $job_card->id]) }}" method="post">
        @csrf
        {{--<input name="_method" type="hidden" value="PATCH" />--}}
        <input name="role" type="hidden" value="{{auth()->user()->getRoleNames()}}" />
        <input type="hidden" name="job_card_id" id="job_card_id" value="{{ $job_card->id ?? '' }}">
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    {{--@if(auth()->user()->hasRole(['deputy warehouse manager', 'warehouse manager']))
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Status</label>
                            <select class="form-control" id="select-status" name="status">
                                <option disabled selected>...</option>
                                @foreach(StatusEnum::jobCardCases() as $status)
                                    <option @if($job_card->status === $status->value) selected @endif value="{{$status->value}}">{{$status->probertyName()}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif--}}

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Choose Vehicle</label>
                        <select class="form-control" name="vehicle_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($vehicles as $vehicle)
                                <option
                                    @if($job_card->vehicle_id === $vehicle->id) selected @endif
                                data-group='{{ $vehicle->group_id }}'
                                    data-category='{{ $vehicle->category_id }}'
                                    value="{{ $vehicle->id }}">
                                    {{ $vehicle->id }} -- {{ $vehicle->vehicle_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Delivered by</label>
                        <input type="text" class="form-control" name="delivered_by" value="{{ $job_card->delivered_by }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Received by</label>
                        <input type="text" class="form-control" name="received_by" value="{{ $job_card->received_by }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Ref Number</label>
                        <input type="text" class="form-control" name="ref_number" value="{{ $job_card->ref_number }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Date In</label>
                        <input type="date" class="form-control" name="date_in" value="{{ $job_card->date_in }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Expected Date Out</label>
                        <input type="date" class="form-control" name="expected_date_out" value="{{ $job_card->expected_date_out }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Reg No</label>
                        <input type="text" class="form-control" name="reg_no" value="{{ $job_card->reg_no }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">KM</label>
                        <input type="number" class="form-control" name="km" value="{{ $job_card->km }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Expected Hour Out</label>
                        <input type="number" class="form-control" name="expected_hour_out" value="{{ $job_card->expected_hour_out }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Location</label>
                        <input type="text" class="form-control" name="location" value="{{ $job_card->location }}">
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
                        <textarea class="form-control" name="work_required" rows="3">{{ $job_card->work_required }}</textarea>
                    </div>

                    <!-- Estimated Time and Staff Details -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Estimated Time</label>
                        <input type="text" class="form-control" name="estimated_time" value="{{ $job_card->estimated_time }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Staff Details</label>
                        <select class="form-control" name="staff_details[]" multiple>
                            <option disabled hidden>Choose</option>
                            @foreach($employees as $employee)
                                <option
                                    @if(is_array($job_card->staff_details) && in_array($employee->id, $job_card->staff_details)) selected
                                    @endif
                                    value="{{ $employee->id }}">
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Comments -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Comments</label>
                        <textarea class="form-control" name="comments" rows="3">{{ $job_card->comments }}</textarea>
                    </div>

                    <!-- Costs -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Lubrication Cost</label>
                        <input type="number" class="form-control" step="0.01" name="lubrication_cost" value="{{ $job_card->lubrication_cost }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Subcontractor Cost</label>
                        <input type="number" class="form-control" step="0.01" name="subcontractor_cost" value="{{ $job_card->subcontractor_cost }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Parts Cost</label>
                        <input type="number" class="form-control" step="0.01" name="parts_cost" value="{{ $job_card->parts_cost }}">
                    </div>

                    <!--  -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Driver</label>
                        <select class="form-control" name="driver_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($drivers as $driver)
                                <option @if($job_card->driver_id === $driver->id) selected @endif value="{{ $driver->id }}">
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Operation Coordinator</label>
                        <input type="text" class="form-control" name="operation_coordinator" value="{{ $job_card->operation_coordinator }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Maintenance Supervisor</label>
                        <input type="text" class="form-control" name="maintenance_supervisor" value="{{ $job_card->maintenance_supervisor }}">
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Maintenance Manager</label>
                        <input type="text" class="form-control" name="maintenance_manager" value="{{ $job_card->maintenance_manager }}">
                    </div>

                    @foreach($jobCardItems as $key=>$jobCardItem)
                        <div class="item-details d-flex justify-content-between align-items-center mb-3"
                             id="item-details">

                            <input type="hidden" name="jobCardItemIds[{{$key}}]" value="{{$jobCardItem->id}}">

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Part Number</label>
                                <select class="form-control" name="part_number[{{$key}}]" id="item-selected">
                                    <option selected disabled hidden>Choose</option>
                                    @foreach($items as $item)
                                        <option @if($item->part_no == $jobCardItem->part_number) selected
                                                @endif value="{{ $item->part_no }}"
                                                data-item_quantity="{{ $item->quantity }}">
                                            {{ $item->part_no }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="fv-row mb-7 mx-1">
                                <label class="fs-6 fw-semibold mb-2">Item Quantity Available</label>
                                <input type="number" class="form-control disabled item-quantity" id=""/>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Quantity</label>
                                <input type="number" class="form-control" name="quantity[{{$key}}]"
                                       value="{{ $jobCardItem->quantity }}">
                            </div>

                            <div class="fv-row mb-7 mx-1">
                                <label class="fs-6 fw-semibold mb-2">Description</label>
                                <textarea class="form-control" name="description[{{$key}}]"
                                          rows="1">{{ $jobCardItem->description }}</textarea>
                            </div>

                            <div class="fv-row mb-7 me-1">
                                <label class="fs-6 fw-semibold mb-2">Cost</label>
                                <input type="number" class="form-control" step="0.01" name="cost[{{$key}}]"
                                       value="{{ $jobCardItem->cost }}">
                            </div>

                            <div>
                                <button type="button" class="delete-item-details" data-index="{{$key}}" data-id="{{$jobCardItem->id}}">X</button>
                            </div>
                        </div>
                    @endforeach


                    <input type="hidden" class="deleted-items-indexes" name="deleted_items_indexes" value="{}">
                    <button type="button" class="add-item-details" id="add-item-details">Add</button>

                </div>
                <!--end::Modal body-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-primary" id="submit-item-details">
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
                        url: '{{ route(target() . '.groups.specific', ['id' => '__GROUP_ID__']) }}'.replace('__GROUP_ID__', groupId),
                        type: 'GET',
                        success: function (response) {
                            console.log(response);
                            var groupName = response.group_name;

                            var originalText = $option.text();
                            $option.text(originalText + ' -- ' + groupName);
                        },
                        error: function () {
                            console.log('Error retrieving group name for group ID: ' + groupId);
                        }
                    });
                }
            });

            $('select[name="vehicle_id"] option').each(function () {
                var $option = $(this);
                var catId = $option.data('category');

                if (catId) {
                    $.ajax({
                        url: '{{ route(target() . '.categories.specific', ['id' => '__CAT_ID__']) }}'.replace('__CAT_ID__', catId),
                        type: 'GET',
                        success: function (response) {
                            var catName = response.category_name;

                            var originalText = $option.text();
                            $option.text(originalText + ' -- ' + catName);
                        },
                        error: function () {
                            console.log('Error retrieving group name for group ID: ' + catId);
                        }
                    });
                }
            });

            var selectedJobCardTypes = @json($selectedJobCardTypes);

            $('input[name="job_card_type[]"]').each(function () {
                var checkboxValue = $(this).val();
                if (selectedJobCardTypes.includes(checkboxValue)) {
                    $(this).prop('checked', true);
                }
            });

            var selectedRepairTypes = @json($selectedRepairTypes);

            $('input[name="repair_type[]"]').each(function () {
                var checkboxValue = $(this).val();
                if (selectedRepairTypes.includes(checkboxValue)) {
                    $(this).prop('checked', true);
                }
            });

            var site_val = {{ $job_card->site }};

            $(document).ready(function () {
                $('input[name="site"][value="' + site_val + '"]').prop('checked', true);
            });

            $(document).on('change', '#item-selected', function () {
                var selectedItems = $(this).find('option:selected');
                var quantity = selectedItems.data('item_quantity');

                $(this).closest('.item-details').find('.item-quantity').val(quantity);
            });

            $('#add-item-details').on('click', function () {
                var clonedItem = $('#item-details').clone();

                clonedItem.find('input, textarea, select').each(function () {
                    $(this).val('');
                });

                clonedItem.insertBefore('#add-item-details');
            });

            var roleValue = $('input[name="role"]').val();
            if (roleValue.includes('deputy warehouse manager') || roleValue.includes('warehouse manager')) {
                $('#form').find('input, textarea, select, button').attr('disabled', true);
                $('#form').find('button[type="submit"]').attr('disabled', true);
            }

            $('#submit-item-details').on('click', function (e) {
                e.preventDefault();

                var form = $('#form');
                var formData = new FormData(form[0]);

                console.log(formData);

                $.ajax({
                    url: '{{ route('admin.item_details.update') }}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function (response) {
                        alert(response.message);
                        form[0].reset();
                        window.location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errorMessages = xhr.responseJSON.errors;
                            let messages = '';

                            $.each(errorMessages, function (key, value) {
                                messages += value.join(', ') + '\n';
                            });

                            alert('Error(s):\n' + messages);
                        } else {
                            alert('An unexpected error occurred. Please try again.');
                        }
                    }
                });
            });

            $(document).on('click', '.delete-item-details', function () {
                const index = $(this).data('index');
                const id = $(this).data('id');

                let deletedItemsIndexes =  $('.deleted-items-indexes').val();
                deletedItemsIndexes = JSON.parse(deletedItemsIndexes);
                deletedItemsIndexes[index] = id;

                $('.deleted-items-indexes').val(JSON.stringify(deletedItemsIndexes));

                // Remove only the closest .item-details div
                $(this).closest('.item-details').remove();
            });

        });
    </script>
@endpush
