@extends('admin.layout.master')

@section('title')
Drivers
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.drivers.update', ['driver' => $driver->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $driver->name }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Country</label>
                        <input type="text" class="form-control" name="country" value="{{ $driver->country }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Age</label>
                        <input type="text" class="form-control" name="age" value="{{ $driver->age }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="{{ $driver->phone_number }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Date Of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth"
                               value="{{ $driver->date_of_birth ? date('Y-m-d', strtotime($driver->date_of_birth)) : '' }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Passport Number</label>
                        <input type="text" class="form-control" name="passport_no" value="{{ $driver->passport_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Bus Number</label>
                        <input type="text" class="form-control" name="bus_no" value="{{ $driver->bus_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">License number</label>
                        <input type="text" class="form-control" name="license_no" value="{{ $driver->license_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">License Expired Date</label>
                        <input type="date" class="form-control" name="license_expired"
                               value="{{ $driver->license_expired ? date('Y-m-d', strtotime($driver->license_expired)) : '' }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">images</label>
                        <input type="file" class="form-control" name="attachments[]" multiple="multiple" value="{{ old('images') }}"/>
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
