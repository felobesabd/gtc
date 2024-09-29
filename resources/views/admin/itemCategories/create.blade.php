@extends('admin.layout.master')

@section('title')
Items
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.itemCats.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Item Name</label>
                        <input type="text" class="form-control" name="item_name" value="{{ old('item_name') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Select Category</label>
                        <select class="form-control" name="category_id">
                                <option selected disabled hidden>Choose</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Select Group</label>
                        <select class="form-control" name="group_id">
                                <option selected disabled hidden>Choose</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Part Number</label>
                        <input type="text" class="form-control" name="part_no" value="{{ old('part_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Select Unit</label>
                        <select class="form-control" name="unit_id">
                                <option selected disabled hidden>Choose</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Minimum Allowed Value</label>
                        <input type="number" class="form-control" name="min_allowed_value" value="{{ old('min_allowed_value') }}"/>
                    </div>

                    {{--<div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Rate</label>
                        <input type="number" class="form-control" name="rate" value="{{ old('rate') }}"/>
                    </div>--}}

                    {{--                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Rate Per</label>
                        <input type="number" class="form-control" name="rate_per" value="{{ old('rate_per') }}"/>
                    </div>--}}
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
