@extends('admin.layout.master')

@section('title')
Vehicles
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.vehicles.update', ['vehicle' => $vehicle->id]) }}" method="post">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Vehicle Type</label>
                        <input type="text" class="form-control" name="vehicle_type" value="{{ $vehicle->vehicle_type }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Color</label>
                        <input type="text" class="form-control" name="color" value="{{ $vehicle->color }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Capacity</label>
                        <input type="number" class="form-control" name="capacity" value="{{ $vehicle->capacity }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Chassis Number</label>
                        <input type="text" class="form-control" name="chassis_no" value="{{ $vehicle->chassis_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Machine Number</label>
                        <input type="text" class="form-control" name="machine_no" value="{{ $vehicle->machine_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Gearbox Number</label>
                        <input type="text" class="form-control" name="gearbox_no" value="{{ $vehicle->gearbox_no }}"/>
                    </div>

                     <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Plate Number</label>
                        <input type="text" class="form-control" name="plate_no" value="{{ $vehicle->plate_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">License Number</label>
                        <input type="text" class="form-control" name="license_no" value="{{ $vehicle->license_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Category</label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option
                                    @if($vehicle->category_id === $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Group</label>
                        <select class="form-control" name="group_id">
                            @foreach($groups as $group)
                                <option
                                    @if($vehicle->group_id === $group->id) selected @endif value="{{ $group->id }}">
                                    {{ $group->group_name }}
                                </option>
                            @endforeach
                        </select>
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
