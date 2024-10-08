@extends('admin.layout.master')

@section('title')
Items
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-8 col-auto">
                <h3 class="page-title">Items</h3>
            </div>

            <div class="col-sm-4 col">
                <a href="{{route('admin.itemCats.create')}}" class="btn btnColor float-end mt-2">Add Item</a>
            </div>
        </div>
    </div>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="search" id="searchbox" class="form-control form-control-solid w-250px ps-12" placeholder="Search" />
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5 ajax-data-table">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">id</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Group Name</th>
                        <th class="min-w-125px">Part No</th>
                        <th class="min-w-125px">Category</th>
                        <th class="min-w-125px">Unit</th>
                        <th class="min-w-125px">Quantity</th>
                        <th class="min-w-125px">Rate</th>
                        <th class="min-w-125px">Rate Per</th>
                        <th class="min-w-125px">Min Allowed Value</th>
                        <th class="min-w-125px">Created Date</th>
                        <th class="min-w-125px">Actions</th>
                    </tr>
                </thead>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

    <div class="card mt-10">
        <form class="form" action="{{ route('admin.itemCats.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="card-flush py-10">
                    <div class="modal-body px-lg-17">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Add Excel File</label>
                            <input type="file" class="form-control" name="file"/>
                        </div>
                    </div>

                    <div class="modal-footer flex-center">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 15px">
                            <span class="indicator-label" style="font-size: 13px">Import</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>



{{--    <form action="{{ route('admin.itemCats.import') }}" method="POST" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        <input type="file" name="file">--}}
{{--        <button type="submit">Import</button>--}}
{{--    </form>--}}
</div>
<!--end::Content container-->
@endsection

@push('footer')
<script src="{{ url('design/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    /*let user_role = "{{request('user_role')}}";*/
    var columns = [{
            data: 'id',
            name: 'id',
            className: "text-center",
        },
        {
            data: 'item_name',
            name: 'item_name',
            className: "text-start",
        },
        {
            data: 'group_id',
            name: 'group_id',
            className: "text-start",
        },
        {
            data: 'part_no',
            name: 'part_no',
            className: "text-start",
        },
        {
            data: 'category_id',
            name: 'category_id',
            className: "text-start",
        },
        {
            data: 'unit_id',
            name: 'unit_id',
            className: "text-start",
        },
        {
            data: 'quantity',
            name: 'quantity',
            className: "text-start",
        },
        {
            data: 'rate',
            name: 'rate',
            className: "text-start",
        },
        {
            data: 'rate_per',
            name: 'rate_per',
            className: "text-start",
        },
        {
            data: 'min_allowed_value',
            name: 'min_allowed_value',
            className: "text-center",
        },
        {
            data: 'created_at',
            name: 'created_at',
            className: "text-center",
            render: function(data, type, row) {
                return data ? data.slice(0, 10) : '';
            }
        },
        {
            data: 'action',
            name: 'action',
            className: "text-center",
            orderable: false,
            searchable: false
        },
    ];

    console.log(columns);

    var ajax_url = "{!! route('admin.itemCats.data-table') !!}";

    $(function() {
        createDatatable(columns, ajax_url);
    });

    $.fn.dataTable.ext.errMode = 'none';
</script>
{{--<script>
    $(document).on('change', '.status', function() {
        let param = {
            key: 'status',
            val: $(this).val(),
        };
        let new_url = appendParamToCurrentUrl(param);
        location.href = new_url;
    });
</script>--}}
@endpush
