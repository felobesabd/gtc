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
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $employee->name }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Country</label>
                        <input type="text" class="form-control" name="country" value="{{ $employee->country }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Date Of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth"
                               value="{{ $employee->date_of_birth ? date('Y-m-d', strtotime($employee->date_of_birth)) : '' }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Joining Date</label>
                        <input type="date" class="form-control" name="joining_date"
                               value="{{ $employee->joining_date ? date('Y-m-d', strtotime($employee->joining_date)) : '' }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Department</label>
                        <select class="form-control" name="department_id">
                            @foreach($departments as $department)
                                <option
                                    @if($employee->department_id === $department->id) selected @endif value="{{ $department->id }}">
                                    {{ $department->name_en }}
                                </option>
                                {{--<option value="{{ $department->id }}">{{ $department->name_en }}</option>--}}
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Passport Number</label>
                        <input type="text" class="form-control" name="passport_no" value="{{ $employee->passport_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Civil Number</label>
                        <input type="text" class="form-control" name="civil_no" value="{{ $employee->civil_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Bank Name</label>
                        <input type="text" class="form-control" name="bank_name" value="{{ $employee->bank_name }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Bank Account Number</label>
                        <input type="text" class="form-control" name="bank_acc_no" value="{{ $employee->bank_acc_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Attachments</label>
                        <input type="file" class="form-control" name="attachments[]" accept="image/*,.pdf" multiple
                               value=""/>
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
