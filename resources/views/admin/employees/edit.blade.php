@extends('admin.layout.master')

@section('title')
Employees
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.employees.update', ['employee' => $employee->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <input type="hidden" name="id" value="{{ $employee->id }}">

                    <div class="d-flex justify-content-between mb-3">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $employee->name }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Date Of Birth</label>
                            <input type="text" class="form-control datepicker" name="date_of_birth"
                                   value="{{ $employee->date_of_birth ? date('d-m-Y', strtotime($employee->date_of_birth)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Joining Date</label>
                            <input type="text" class="form-control datepicker" name="joining_date"
                                   value="{{ $employee->joining_date ? date('d-m-Y', strtotime($employee->joining_date)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Profile Image</label>
                            <input type="file" class="form-control input-file" name="profile_img" accept="image/*,.pdf"
                                   value=""/>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Passport Number</label>
                            <input type="text" class="form-control" name="passport_no"
                                   value="{{ $employee->passport_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Passport Issued Date</label>
                            <input type="text" class="form-control datepicker" name="passport_issued_at"
                                   value="{{ $employee->passport_issued_at ? date('d-m-Y', strtotime($employee->passport_issued_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Passport Expiration Date</label>
                            <input type="text" class="form-control datepicker" name="passport_expires_at"
                                   value="{{ $employee->passport_expires_at ? date('d-m-Y', strtotime($employee->passport_expires_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Passport Image</label>
                            <input type="file" class="form-control input-file" name="passport_img" accept="image/*,.pdf"
                                   value=""/>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $employee->email }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Direct Contact Number</label>
                            <input type="text" class="form-control" name="direct_contact_number"
                                   value="{{ $employee->direct_contact_number }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Whatsapp Number</label>
                            <input type="text" class="form-control" name="whatsapp_number"
                                   value="{{ $employee->whatsapp_number }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Link Social Media</label>
                            <input type="text" class="form-control" name="social_url" value="{{ $employee->social_url }}"/>
                        </div>
                    </div>
                    <hr>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Department</label>
                        <select class="form-control" name="department_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($departments as $department)
                                <option @if($employee->department_id === $department->id) selected
                                        @endif value="{{ $department->id }}">{{ $department->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Country</label>
                            {!! $countries !!}
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Civil Number</label>
                            <input type="text" class="form-control" name="civil_no" value="{{ $employee->civil_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Contact Number Country</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          id="countryCodePrefix">+{{ $employee->country_code }}</span>
                                </div>
                                <input type="text" name="country_contact_number" class="form-control"
                                       value="{{ $employee->country_contact_number }}">
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name" value="{{ $employee->bank_name }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Bank Account Number</label>
                            <input type="text" class="form-control" name="bank_acc_no"
                                   value="{{ $employee->bank_acc_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Bank Card Image</label>
                            <input type="file" class="form-control input-file" name="bank_img" accept="image/*,.pdf"
                                   value=""/>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Driving License Issued Date</label>
                            <input type="text" class="form-control datepicker" name="driving_license_issued_at"
                                   value="{{ $employee->driving_license_issued_at ? date('d-m-Y', strtotime($employee->driving_license_issued_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Driving License Expiration Date</label>
                            <input type="text" class="form-control datepicker" name="driving_license_expires_at"
                                   value="{{ $employee->driving_license_expires_at ? date('d-m-Y', strtotime($employee->driving_license_expires_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Driving Image</label>
                            <input type="file" class="form-control input-file" name="driving_img" accept="image/*,.pdf"
                                   value=""/>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Medical Insurance Number</label>
                            <input type="text" class="form-control" name="medical_insurance_no"
                                   value="{{ $employee->medical_insurance_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Medical Insurance Issued Date</label>
                            <input type="text" class="form-control datepicker" name="medical_issued_at"
                                   value="{{ $employee->medical_issued_at ? date('d-m-Y', strtotime($employee->medical_issued_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Medical Insurance Expiration Date</label>
                            <input type="text" class="form-control datepicker" name="medical_expires_at"
                                   value="{{ $employee->medical_expires_at ? date('d-m-Y', strtotime($employee->medical_expires_at)) : '' }}"/>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Life Insurance Number</label>
                            <input type="text" class="form-control" name="life_insurance_no"
                                   value="{{ $employee->life_insurance_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Life Insurance Issued Date</label>
                            <input type="text" class="form-control datepicker" name="life_issued_at"
                                   value="{{ $employee->life_issued_at ? date('d-m-Y', strtotime($employee->life_issued_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Life Insurance Expiration Date</label>
                            <input type="text" class="form-control datepicker" name="life_expires_at"
                                   value="{{ $employee->life_expires_at ? date('d-m-Y', strtotime($employee->life_expires_at)) : '' }}"/>
                        </div>
                    </div>
                    <hr>
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

            var country_code = {{ $employee->country_code }};

            $('select[name="country_code"] option').each(function () {
                var option = $(this);
                var option_value = $(this).val();
                if (option_value == country_code) {
                     $(this).prop('selected', true)
                }
            })

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
        });
    </script>
@endpush
