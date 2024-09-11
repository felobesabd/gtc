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
                            <label class="fs-6 fw-semibold mb-2">Country</label>
                            <input type="text" class="form-control disabled" name="country" value="{{ $employee->country }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Date Of Birth</label>
                            <input type="date" class="form-control disabled" name="date_of_birth"
                                   value="{{ $employee->date_of_birth ? date('Y-m-d', strtotime($employee->date_of_birth)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Joining Date</label>
                            <input type="date" class="form-control disabled" name="joining_date"
                                   value="{{ $employee->joining_date ? date('Y-m-d', strtotime($employee->joining_date)) : '' }}"/>
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
