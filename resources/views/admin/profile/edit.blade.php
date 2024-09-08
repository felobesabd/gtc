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
        <form class="form" action="{{ route('admin.update-profile') }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PATCH" />
            <div class="modal-body px-lg-17">
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Phone</label>
                    <input type="text" class="form-control disabled" value="{{ $user->phone_number }}" />
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Email</label>
                    <input type="text" class="form-control disabled" value="{{ $user->email }}" />
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Full Name</label>
                    <input type="text" class="form-control" value="{{ $user->full_name }}" name="full_name" required />
                </div>
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Password</label>
                    <input type="password" class="form-control" name="password" />
                </div>
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" />
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