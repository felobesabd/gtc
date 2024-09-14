@extends('admin.layout.master')

@section('title')
Item Categories
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.itemCats.update', ['itemCat' => $itemCat->id]) }}" method="post">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Item Name</label>
                        <input type="text" class="form-control" name="item_name" value="{{ $itemCat->item_name }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Category</label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option
                                    @if($itemCat->category_id === $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Group</label>
                        <select class="form-control" name="group_id">
                            @foreach($groups as $group)
                                <option
                                    @if($itemCat->group_id === $group->id) selected @endif value="{{ $group->id }}">
                                    {{ $group->group_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Part Number</label>
                        <input type="text" class="form-control" name="part_no" value="{{ $itemCat->part_no }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Unit</label>
                        <select class="form-control" name="unit_id">
                            @foreach($units as $unit)
                                <option
                                    @if($itemCat->unit_id === $unit->id) selected @endif value="{{ $unit->id }}">
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="{{ $itemCat->quantity }}"/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Minimum Allowed Value</label>
                        <input type="number" class="form-control" name="min_allowed_value" value="{{ $itemCat->min_allowed_value }}"/>
                    </div>

                    {{--<div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Rate</label>
                        <input type="number" class="form-control" name="rate" value="{{ $itemCat->rate }}"/>
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
