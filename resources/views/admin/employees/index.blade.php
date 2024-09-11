@extends('admin.layout.master')

@section('title')
Department
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
                <h3 class="page-title">Employees</h3>
            </div>

            <div class="col-sm-4 col">
                <a href="{{route('admin.employees.create')}}" class="btn btnColor float-end mt-2">Add Employee</a>
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
                        <th class="min-w-125px">Date Of Birth</th>
                        <th class="min-w-125px">Joining Date</th>
                        <th class="min-w-125px">Department</th>
                        <th class="min-w-125px">Country</th>
                        <th class="min-w-125px">Passport Number</th>
                        <th class="min-w-125px">Civil Number</th>
                        <th class="min-w-125px">Bank Name</th>
                        <th class="min-w-125px">Bank Acc Number</th>
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
            data: 'name',
            name: 'name',
            className: "text-start",
        },
        {
            data: 'date_of_birth',
            name: 'date_of_birth',
            className: "text-center",
        },
        {
            data: 'joining_date',
            name: 'joining_date',
            className: "text-center",
        },
        {
            data: 'department_id',
            name: 'department_id',
            className: "text-center",
        },
        {
            data: 'country',
            name: 'country',
            className: "text-start",
        },
        {
            data: 'passport_no',
            name: 'passport_no',
            className: "text-start",
        },
        {
            data: 'civil_no',
            name: 'civil_no',
            className: "text-start",
        },
        {
            data: 'bank_name',
            name: 'bank_name',
            className: "text-start",
        },
        {
            data: 'bank_acc_no',
            name: 'bank_acc_no',
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
        {
            data: 'action',
            name: 'action',
            className: "text-center",
            orderable: false,
            searchable: false
        },
    ];

    console.log(columns);

    var ajax_url = "{!! route('admin.employees.data-table') !!}";

    $(function() {
        createDatatable(columns, ajax_url);
    });

    $.fn.dataTable.ext.errMode = 'none';
</script>
{{--<script>--}}
{{--    $(document).on('change', '.status', function() {--}}
{{--        let param = {--}}
{{--            key: 'status',--}}
{{--            val: $(this).val(),--}}
{{--        };--}}
{{--        let new_url = appendParamToCurrentUrl(param);--}}
{{--        location.href = new_url;--}}
{{--    });--}}
{{--</script>--}}
@endpush
