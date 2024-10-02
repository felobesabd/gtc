@extends('admin.layout.master')

@section('title')
Permission
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.permission.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    {{--<div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">User</label>
                        <select class="form-control" name="vehicle_id">
                            <option selected disabled hidden>Choose</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>--}}

                    {{--<div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Permission</label>
                        <select class="form-control select-model" name="page_name">
                            <option selected disabled hidden>Choose</option>
                            @foreach($all_models as $key => $all_model)
                                <option value="{{ $key }}">{{ $all_model }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7 job-card-checkbox">
                        <label class="fs-6 fw-semibold mb-2">Permission Actions</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="list">
                            <label class="form-check-label" for="internal">Show Action</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="add">
                            <label class="form-check-label" for="breakdown">Add Action</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="edit">
                            <label class="form-check-label" for="dealer_service">Edit Action</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="delete">
                            <label class="form-check-label" for="insurance">Delete Action</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="show">
                            <label class="form-check-label" for="insurance">Show Specific Action</label>
                        </div>
                    </div>--}}

                    {{--<div class="fv-row mb-7 job-card-checkbox">
                        <label class="fs-6 fw-semibold mb-2">Another Permissions</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="additional_permissions[]" value="show_specific">
                            <label class="form-check-label" for="internal">Show Specific</label>
                        </div>
                    </div>--}}

                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Models</th>
                            <th class="min-w-125px">List</th>
                            <th class="min-w-125px">Show</th>
                            <th class="min-w-125px">Add</th>
                            <th class="min-w-125px">Edit</th>
                            <th class="min-w-125px">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_models as $key => $all_model)
                            <!-- Each model gets its own row -->
                            <tr>
                                <td>{{ $all_model }}</td>
                                <td>
                                    <input type="checkbox" class="form-check-input" value="{{ $key . '.list'}}"
                                           name="permission[]">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" value="{{ $key . '.show'}}"
                                           name="permission[]">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" value="{{ $key . '.add'}}"
                                           name="permission[]">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" value="{{ $key . '.edit'}}"
                                           name="permission[]">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" value="{{ $key . '.delete'}}"
                                           name="permission[]">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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

@push('footer')
    <script>
        var selectedPermissionTypes = @json($permission_names);
        // console.log(selectedPermissionTypes);

        $('input[name="permission[]"]').each(function () {
            var checkboxValue = $(this).val();
            if (selectedPermissionTypes.includes(checkboxValue)) {
                $(this).prop('checked', true);
            }
        });
    </script>
@endpush
