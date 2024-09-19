@extends('admin.layout.master')

@section('title')
Items History
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.item_history.update', ['item_history' => $item_history->id]) }}" method="post">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Item Name</label>
                        <select class="form-control disabled" name="item_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($items as $item)
                                <option @if($item_history->item_id === $item->id) selected @endif value="{{ $item->id }}">
                                    {{ $item->item_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Out Quantity</label>
                        <input type="number" class="form-control" name="quantity_out" value="{{ $item_history->quantity_out }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Reason</label>
                        <textarea class="form-control" name="reason_out" rows="3">{{ $item_history->reason_out }}</textarea>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Supply Order Number</label>
                        <input type="text" class="form-control" name="supply_order_no" value="{{ $item_history->supply_order_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Cost</label>
                        <input type="number" class="form-control" step="0.01" name="cost" value="{{ $item_history->cost }}"/>
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
