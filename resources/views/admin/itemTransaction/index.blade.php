@extends('admin.layout.master')

@section('title')
Item Transaction
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
                <h3 class="page-title">Item Transaction</h3>
            </div>

            <div class="col-sm-4 col">
                <a href="{{route('admin.item_history.create')}}" class="btn btnColor float-end mt-2">Transaction</a>
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
                        <th class="min-w-125px">Item Name</th>
                        <th class="min-w-125px">Transaction</th>
                        <th class="min-w-125px">Quantity</th>
                        <th class="min-w-125px">Reason</th>
                        <th class="min-w-125px">Supplier</th>
                        <th class="min-w-125px">User</th>
                        <th class="min-w-125px">Cost</th>
                        <th class="min-w-125px">Price</th>
                        <th class="min-w-125px">Created Date</th>
                    </tr>
                </thead>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
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
            data: 'item_id',
            name: 'item_id',
            className: "text-start",
        },
        {
            data: 'transaction_type',
            name: 'transaction_type',
            className: "text-start",
        },
        {
            data: 'quantity',
            name: 'quantity',
            className: "text-start",
        },
        {
            data: 'reason',
            name: 'reason',
            className: "text-start",
        },
        {
            data: 'supplier_id',
            name: 'supplier_id',
            className: "text-start",
        },
        {
            data: 'user_id',
            name: 'user_id',
            className: "text-start",
        },
        {
            data: 'cost',
            name: 'cost',
            className: "text-start",
        },
        {
            data: 'price',
            name: 'price',
            className: "text-start",
        },
        {
            data: 'created_at',
            name: 'created_at',
            className: "text-center",
            render: function(data, type, row) {
                return data ? data.slice(0, 10) : '';
            }
        },
    ];

    var ajax_url = "{!! route('admin.item_history.data-table') !!}";

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
