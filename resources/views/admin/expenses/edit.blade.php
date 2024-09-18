@extends('admin.layout.master')

@section('title')
Incidental Expenses
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.expenses.update', ['expense' => $expense->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7 text-center">
                        @if(isset($expense->attachment->path) && is_string($expense->attachment->path))
                            <a href="{{ url($expense->attachment->path) }}" target="_blank">
                                <img src="{{ url($expense->attachment->path) }}"
                                     style="max-width:90%; width: 250px; border-radius:10px">
                            </a>
                        @else
                            <p>No attachment available.</p>
                        @endif
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Operation Type</label>
                        <select class="form-control" name="operation_type">
                            <option selected disabled hidden>Choose</option>
                            <option value="0" {{ $expense->operation_type == 0 ? 'selected' : '' }}>In</option>
                            <option value="1" {{ $expense->operation_type == 1 ? 'selected' : '' }}>Out</option>
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Comments</label>
                        <textarea class="form-control" name="comments" rows="3">{{ $expense->comments }}</textarea>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Amount</label>
                        <input type="number" class="form-control" step="0.01" name="amount" value="{{ $expense->amount }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2 required">Image</label>
                        <input type="file" class="form-control" name="attachment" accept="image/*" />
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
