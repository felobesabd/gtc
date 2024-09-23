@extends('admin.layout.master')

@section('title')
Employees
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.employees.show', ['employee' => $employee->id]) }}">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="col-md-9">
                <div class="card card-flush py-10">
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" class="form-control disabled" name="name" value="{{ $employee->name }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Email</label>
                            <input type="text" class="form-control disabled" name="email" value="{{ $employee->email }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Direct Contact Number</label>
                            <input type="text" class="form-control disabled" name="direct_contact_number"
                                   value="{{ $employee->direct_contact_number }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Whatsapp Number</label>
                            <input type="text" class="form-control disabled" name="whatsapp_number"
                                   value="{{ $employee->whatsapp_number }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Link Social Media</label>
                            <input type="text" class="form-control disabled" name="social_url"
                                   value="{{ $employee->social_url }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Country</label>
                            {!! $countries !!}
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Contact Number Country</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"
                                      id="countryCodePrefix">+{{ $employee->country_code }}</span>
                                </div>
                                <input type="text" name="country_contact_number" class="form-control disabled"
                                       value="{{ $employee->country_contact_number }}">
                            </div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Date Of Birth</label>
                            <input type="text" class="form-control disabled datepicker" name="date_of_birth"
                                   value="{{ $employee->date_of_birth ? date('d-m-Y', strtotime($employee->date_of_birth)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Joining Date</label>
                            <input type="text" class="form-control disabled datepicker" name="joining_date"
                                   value="{{ $employee->joining_date ? date('d-m-Y', strtotime($employee->joining_date)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Department</label>
                            <select class="form-control disabled" name="department_id">
                                @foreach($departments as $department)
                                    <option
                                        @if($employee->department_id === $department->id) selected
                                        @endif value="{{ $department->id }}">
                                        {{ $department->name_en }}
                                    </option>
                                    {{--<option value="{{ $department->id }}">{{ $department->name_en }}</option>--}}
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Passport Number</label>
                            <input type="text" class="form-control disabled" name="passport_no"
                                   value="{{ $employee->passport_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Civil Number</label>
                            <input type="text" class="form-control disabled" name="civil_no" value="{{ $employee->civil_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Bank Name</label>
                            <input type="text" class="form-control disabled" name="bank_name"
                                   value="{{ $employee->bank_name }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Bank Account Number</label>
                            <input type="text" class="form-control disabled" name="bank_acc_no"
                                   value="{{ $employee->bank_acc_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Passport Issued Date</label>
                            <input type="text" class="form-control disabled datepicker" name="passport_issued_at"
                                   value="{{ $employee->passport_issued_at ? date('d-m-Y', strtotime($employee->passport_issued_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Passport Expiration Date</label>
                            <input type="text" class="form-control disabled datepicker" name="passport_expires_at"
                                   value="{{ $employee->passport_expires_at ? date('d-m-Y', strtotime($employee->passport_expires_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Driving License Issued Date</label>
                            <input type="text" class="form-control disabled datepicker" name="driving_license_issued_at"
                                   value="{{ $employee->driving_license_issued_at ? date('d-m-Y', strtotime($employee->driving_license_issued_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Driving License Expiration Date</label>
                            <input type="text" class="form-control disabled datepicker" name="driving_license_expires_at"
                                   value="{{ $employee->driving_license_expires_at ? date('d-m-Y', strtotime($employee->driving_license_expires_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Medical Insurance Number</label>
                            <input type="text" class="form-control disabled" name="medical_insurance_no"
                                   value="{{ $employee->medical_insurance_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Medical Insurance Issued Date</label>
                            <input type="text" class="form-control disabled datepicker" name="medical_issued_at"
                                   value="{{ $employee->medical_issued_at ? date('d-m-Y', strtotime($employee->medical_issued_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Medical Insurance Expiration Date</label>
                            <input type="text" class="form-control disabled datepicker" name="medical_expires_at"
                                   value="{{ $employee->medical_expires_at ? date('d-m-Y', strtotime($employee->medical_expires_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Life Insurance Number</label>
                            <input type="text" class="form-control disabled" name="life_insurance_no"
                                   value="{{ $employee->life_insurance_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Life Insurance Issued Date</label>
                            <input type="text" class="form-control disabled datepicker" name="life_issued_at"
                                   value="{{ $employee->life_issued_at ? date('d-m-Y', strtotime($employee->life_issued_at)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Life Insurance Expiration Date</label>
                            <input type="text" class="form-control disabled datepicker" name="life_expires_at"
                                   value="{{ $employee->life_expires_at ? date('d-m-Y', strtotime($employee->life_expires_at)) : '' }}"/>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
            </div>

            <!-- right card -->
            <div class="col-md-3">
                <div class="card card-flush py-10">
                    <div class="mb-7 px-lg-17">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                        <label class="fs-6 fw-semibold mb-2">Attachments</label>
                    </div>
                    <div class="modal-body px-lg-17">
                        @foreach(getMultipleAttachments(obj: $employee, attach_col_name: 'attachments_ids') as $key => $attachment)
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Attachment {{$key + 1}}</label>
                                <span class="attachment">
                            <a href="{{url($attachment->path)}}" target="_blank"><i class="fa fa-file"></i></a>
                        </span>
                            </div>
                        @endforeach
                    </div>
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
            var country_code = {{ $employee->country_code }};

            $('select[name="country_code"] option').each(function () {
                var option_value = $(this).val();
                if (option_value == country_code) {
                    $(this).prop('selected', true)
                    $('select[name="country_code"]').prop('disabled', true);
                }
            })
        });
    </script>
@endpush
