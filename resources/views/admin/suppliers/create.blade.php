@extends('admin.layout.master')

@section('title')
Suppliers
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.suppliers.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Company Name</label>
                        <input type="text" class="form-control" name="company_name" value="{{ old('company_name') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Commercial Register Number</label>
                        <input type="text" class="form-control" name="commercial_register_no" value="{{ old('commercial_register_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Number Of Tax</label>
                        <input type="text" class="form-control" name="tax_value_added" value="{{ old('tax_value_added') }}"/>
                    </div>

                    <div class="supplier-details d-flex justify-content-between mb-3" id="supplier-details">
                        <div class="col-sm-2 fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Supplier Name</label>
                            <input type="text" class="form-control" name="supplier_name[]"/>
                        </div>

                        <div class="col-sm-2 fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Email</label>
                            <input type="text" class="form-control" name="email[]"/>
                        </div>

                        <div class="col-sm-2 fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Phone</label>
                            <input type="text" class="form-control" name="phone[]"/>
                        </div>

                        <div class="col-sm-2 fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Whats App</label>
                            <input type="text" class="form-control" name="whats_app[]"/>
                        </div>

                        <div class="col-sm-2 fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Department</label>
                            <input type="text" class="form-control" name="department[]"/>
                        </div>
                    </div>

                    <div>
                        <button type="button" class="add-supplier-details" id="add-supplier-details">Add</button>
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
