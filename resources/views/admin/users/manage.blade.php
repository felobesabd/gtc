@extends('admin.layout.master')

@section('title')
Profile
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <!--begin::Modal body-->
    <div class="card card-flush py-10">
        <form class="form" action="{{ route('admin.users.manage.store') }}" method="post">
            @csrf
            <div class="modal-body px-lg-17">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Employee</label>
                    <select class="form-control" name="employee_id" id="employee-select">
                        <option selected disabled hidden>Choose</option>
                        @foreach($employees as $employee)
                            <option
                                value="{{ $employee->id }}"
                                data-phone="{{ $employee->direct_contact_number }}"
                                data-email="{{ $employee->email }}"
                                data-name="{{ $employee->name }}">
                                {{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Phone</label>
                    <input type="text" class="form-control" id="phone-input" value="{{ old('phone_number') }}" name="phone_number"/>
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Email</label>
                    <input type="text" class="form-control" id="email-input" value="{{ old('email') }}" name="email" />
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Full Name</label>
                    <input type="text" class="form-control" id="name-input" value="{{ old('full_name') }}" name="full_name" />
                </div>
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Password</label>
                    <input type="password" class="form-control" name="password" />
                </div>

                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Add Role</label>
                    <select class="form-control" name="role">
                        <option selected disabled hidden>Choose</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--end::Modal body-->
            <div class="modal-footer flex-center pt-8">
                <!--begin::Button-->
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Submit</span>
                </button>
                <!--end::Button-->
            </div>
        </form>
    </div>
</div>
<!--end::Content container-->
@endsection

@push('footer')
    <script>
        $(document).ready(function () {
            $('#employee-select').on('change', function () {
                var selectedEmployee = $(this).find('option:selected');

                var phone = selectedEmployee.data('phone');
                var email = selectedEmployee.data('email');
                var fullName = selectedEmployee.data('name');

                $('#phone-input').val(phone);
                $('#email-input').val(email);
                $('#name-input').val(fullName);
            });
        });
    </script>
@endpush
