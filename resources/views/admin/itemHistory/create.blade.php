@extends('admin.layout.master')

@section('title')
Items History
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.item_history.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Item Name</label>
                        <select class="form-control" name="item_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Out Quantity</label>
                        <input type="number" class="form-control" name="quantity_out" value="{{ old('quantity_out') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Comments</label>
                        <textarea class="form-control" name="reason_out" rows="3">{{ old('reason_out') }}</textarea>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Supply Order Number</label>
                        <input type="text" class="form-control" name="supply_order_no" value="{{ old('supply_order_no') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Cost</label>
                        <input type="number" class="form-control" step="0.01" name="cost" value="{{ old('cost') }}"/>
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
