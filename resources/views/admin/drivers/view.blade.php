@extends('admin.layout.master')

@section('title')
Drivers
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.drivers.show', ['driver' => $driver->id]) }}">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="col-md-9">
                <div class="card card-flush py-10">
                    <!--begin::Modal body-->
                    <div class="modal-body px-lg-17">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" class="form-control disabled" name="name" value="{{ $driver->name }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Country</label>
                            <input type="text" class="form-control disabled" name="country" value="{{ $driver->country }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Age</label>
                            <input type="text" class="form-control disabled" name="age" value="{{ $driver->age }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Phone Number</label>
                            <input type="text" class="form-control disabled" name="phone_number" value="{{ $driver->phone_number }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Date Of Birth</label>
                            <input type="date" class="form-control disabled" name="date_of_birth"
                                   value="{{ $driver->date_of_birth ? date('Y-m-d', strtotime($driver->date_of_birth)) : '' }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Passport Number</label>
                            <input type="text" class="form-control disabled" name="passport_no" value="{{ $driver->passport_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Bus Number</label>
                            <input type="text" class="form-control disabled" name="bus_no" value="{{ $driver->bus_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">License number</label>
                            <input type="text" class="form-control disabled" name="license_no" value="{{ $driver->license_no }}"/>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">License Expired Date</label>
                            <input type="date" class="form-control disabled" name="joining_date"
                                   value="{{ $driver->license_expired ? date('Y-m-d', strtotime($driver->license_expired)) : '' }}"/>
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
                        @php
                            $attachments = getMultipleAttachments(obj: $driver, attach_col_name: 'images');
                        @endphp

                        @if($attachments->isEmpty())
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">No attachments available.</label>
                            </div>
                        @else
                            @foreach($attachments as $key => $attachment)
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Attachment {{$key + 1}}</label>
                                    <span class="attachment">
                            <a href="{{ url($attachment->path) }}" target="_blank" rel="noopener noreferrer">
                                <i class="fa fa-file"></i>
                            </a>
                        </span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
<!--end::Content container-->
@endsection
