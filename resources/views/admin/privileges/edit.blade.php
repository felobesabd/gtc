@extends('admin.layout.master')

@section('title')
Permission
@endsection

@push('header')
@endpush

@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form class="form" action="{{ route('admin.update.permission') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH" />
        <div class="row">
            <div class="card card-flush py-10">
                <!--begin::Modal body-->
                <div class="modal-body px-lg-17">
                    <input type="hidden" name="role_id" value="{{ $role->id }}">

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
