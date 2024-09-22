@extends('admin.layout.master')

@section('title')
Employees
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.employees.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Direct Contact Number</label>
                        <input type="text" class="form-control" name="direct_contact_number" value="{{ old('direct_contact_number') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Whatsapp Number</label>
                        <input type="text" class="form-control" name="whatsapp_number" value="{{ old('whatsapp_number') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Link Social Media</label>
                        <input type="text" class="form-control" name="social_url" value="{{ old('social_url') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Country</label>
                        {!! $countries !!}
                    </div>

                    {{--<div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Country</label>
                        <select class="form-control" name="country">
                            <option selected disabled hidden>Choose</option>
                            @foreach($countries as $key => $country)
                                <option value="{{ $department->id }}">{{ $department->name_en }}</option>
                            @endforeach
                        </select>
                    </div>--}}
                    {{--<div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Country Contact Number</label>
                        <input type="text" class="form-control" name="country_contact_number" value="{{ old('country_contact_number') }}"/>
                    </div>--}}

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Contact Number Country</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                      id="countryCodePrefix">+{{ old('country_code') }}</span>
                            </div>
                            <input type="text" name="country_contact_number" class="form-control"
                                   value="{{ old('country_contact_number') }}">
                        </div>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Date Of Birth</label>
                        <input type="text" class="form-control datepicker" name="date_of_birth" value="{{ old('date_of_birth') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Joining Date</label>
                        <input type="text" class="form-control datepicker" name="joining_date" value="{{ old('joining_date') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Department</label>
                        <select class="form-control" name="department_id">
                                <option selected disabled hidden>Choose</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name_en }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Passport Number</label>
                        <input type="text" class="form-control" name="passport_no" value="{{ old('passport_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Civil Number</label>
                        <input type="text" class="form-control" name="civil_no" value="{{ old('civil_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Bank Name</label>
                        <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Bank Account Number</label>
                        <input type="text" class="form-control" name="bank_acc_no" value="{{ old('bank_acc_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Passport Issued Date</label>
                        <input type="text" class="form-control datepicker" name="passport_issued_at" value="{{ old('passport_issued_at') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Passport Expiration Date</label>
                        <input type="text" class="form-control datepicker" name="passport_expires_at" value="{{ old('passport_expires_at') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Driving License Issued Date</label>
                        <input type="text" class="form-control datepicker" name="driving_license_issued_at" value="{{ old('driving_license_issued_at') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Driving License Expiration Date</label>
                        <input type="text" class="form-control datepicker" name="driving_license_expires_at" value="{{ old('driving_license_expires_at') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Profile Image</label>
                        <input type="file" class="form-control" name="attachments[]" accept="image/*,.pdf" multiple
                               value="" required/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Attachments</label>
                        <input type="file" class="form-control" name="attachments[]" accept="image/*,.pdf" multiple
                               value="" required/>
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
            $(document).on('change', '#countryCodeSelect', function () {
                var selectedCountryCode = $(this).val();
                $('#countryCodePrefix').text('+' + selectedCountryCode);
            });

            var initialCountryCode = $('#countryCodeSelect').val();
            if (initialCountryCode) {
                $('#countryCodePrefix').text('+' + initialCountryCode);
            }
        });

        $(document).ready(function () {
            $(".datepicker").datepicker({
                dateFormat: "dd-mm-yy",
                weekStart: 0,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                rtl: true,
                orientation: "auto"
            });
        });
    </script>
@endpush
