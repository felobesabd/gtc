@extends('admin.layout.master')

@section('title')
Vehicles
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.vehicles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Vehicle Type</label>
                        <input type="text" class="form-control" name="vehicle_type" value="{{ old('vehicle_type') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Color</label>
                        <input type="text" class="form-control" name="color" value="{{ old('color') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Capacity</label>
                        <input type="number" class="form-control" name="capacity" value="{{ old('capacity') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Chassis Number</label>
                        <input type="text" class="form-control" name="chassis_no" value="{{ old('chassis_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Machine Number</label>
                        <input type="text" class="form-control" name="machine_no" value="{{ old('machine_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Gearbox Number</label>
                        <input type="text" class="form-control" name="gearbox_no" value="{{ old('gearbox_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Plate Number</label>
                        <input type="text" class="form-control" name="plate_no" value="{{ old('plate_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">License Number</label>
                        <input type="text" class="form-control" name="license_no" value="{{ old('license_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Select Category</label>
                        <select class="form-control" name="category_id">
                                <option selected disabled hidden>Choose</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Select Group</label>
                        <select class="form-control" name="group_id">
                                <option selected disabled hidden>Choose</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
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
