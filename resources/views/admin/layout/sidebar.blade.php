<!--begin::Wrapper-->
<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
    <!--begin::Sidebar-->
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Logo-->
        <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
            <!--begin::Logo image-->
            <a href="{{url(target())}}">
                <!-- <img alt="Logo" src="{{url('design/admin')}}/assets/media/logos/default-dark.svg" class="h-25px app-sidebar-logo-default" /> -->
                <!-- <img alt="Logo" src="{{url('design/admin')}}/assets/media/logos/default-small.svg" class="h-20px app-sidebar-logo-minimize" /> -->
                {{--<h3 class="text-white">{{config('settings.app_name')}}</h3>--}}
                <img alt="Logo" src="{{url('design/admin/assets/media/logos/logo-gulf-transport.jpeg')}}" class="h-55px w-125px app-sidebar-logo-default" />
            </a>
            <!--end::Logo image-->
            <!--begin::Sidebar toggle-->
            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <!--end::Sidebar toggle-->
        </div>
        <!--end::Logo-->
        <!--begin::sidebar menu-->
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <!--begin::Menu wrapper-->
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                <!--begin::Scroll wrapper-->
                <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">


                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin::Logo image-->
                            <a href="{{url(target())}}">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-element-11 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title" style="font-size: 1.5rem">Dashboard</span>
                                    <span class="menu-arrow"></span>
                                </span>
                            </a>
                            <!--end::Logo image-->
                        </div>
                    </div>

                    <!--begin::Menu HRM-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">HRM</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{ route('admin.employees.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Employees</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{ route('admin.departments.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Department</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin.users.index', ['user_role' => 'notary'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Attendance</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin.users.index', ['user_role' => 'chartered_accountant'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Work Hours</span>
                                    </a>

                                    <a class="menu-link active" href="{{route('admin.users.index', ['user_role' => 'chartered_accountant'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Vacations</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu HRM-->

                    <!--begin::Menu Stores-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Stores</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Category</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Unit</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin.users.index', ['user_role' => 'notary'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Item</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin.users.index', ['user_role' => 'chartered_accountant'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Purchase Part</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin.users.index', ['user_role' => 'chartered_accountant'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Suppliers</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="{{route('admin.users.index', ['user_role' => 'chartered_accountant'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Stock</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Stores-->

                    <!--begin::Menu Maintenance-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Maintenance</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Job Card</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Gate Pass</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Maintenance-->

                    <!--begin::Menu Vehicle-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Vehicle</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Vehicle</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Vehicle Type</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Vehicle Brand</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Vehicle-->

                    <!--begin::Menu Setting-->
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">System Setting</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            {{--                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Vehicle</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Vehicle Type</span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Vehicle Brand</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>--}}
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu Vehicle-->

                </div>
                <!--end::Scroll wrapper-->
            </div>
            <!--end::Menu wrapper-->
        </div>
        <!--end::sidebar menu-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
