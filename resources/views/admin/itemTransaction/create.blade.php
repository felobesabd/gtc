@extends('admin.layout.master')

@section('title')
Item Transaction
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
                        <label class="fs-6 fw-semibold mb-2">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Transaction Type</label>
                        <select class="form-control" name="transaction_type">
                            <option selected disabled hidden>Choose</option>
                            <option value="1">In</option>
                            <option value="2">Out</option>
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Reason</label>
                        <textarea class="form-control" name="reason" rows="3">{{ old('reason') }}</textarea>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Cost</label>
                        <input type="number" class="form-control" step="0.01" name="cost" value="{{ old('cost') }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Supplier</label>
                        <select class="form-control" name="supplier_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">User</label>
                        <select class="form-control" name="user_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
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
