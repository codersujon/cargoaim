<!DOCTYPE html>

{{-- <html lang="en"> --}}
<html lang="en" data-sidenav-size="condensed" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light" data-layout-mode="fluid">

<!-- Mirrored from coderthemes.com/osen/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Apr 2025 04:49:51 GMT -->

<head>
    <meta charset="utf-8" />

    
    {{--  $basicInfo = \App\Models\BasicInformation::where('id', 1)->first(); --}}

    <title> Dashboard </title>
    {{-- <title> {{ $basicInfo? $basicInfo->name : '' }} @yield('titleHeader') </title> --}}

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- App favicon -->
     {{-- <link rel="shortcut icon" href="{{ asset('upload/' . $basicInfo->favIcon) }}"> --}}

    {{-- <!---- font-awesome ------>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!---- font-awesome ------> --}}

    <!-- Theme Config Js -->
    <script src="{{ asset('backend') }}/assets/js/config.js"></script>

    <!-- Vendor css -->
    <link href="{{ asset('backend') }}/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('backend') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/dataTables.css" />

    <!-- flatpickr -->
    <link href="{{ asset('backend') }}/flatpickr.css" rel="stylesheet" type="text/css" />
    <!-- flatpickr -->

   
    
</head>



<body>

    @php
        $color = Modules\Core\Models\ColorManage::where('user_info', 'SuperAdmin')->where('active_color', 1)->first();
    @endphp

    @if($color)
       
        <style>
            :root {
                --osen-menu-bg-first: {{ $color->sidebar_left_color }} !important;
                --osen-menu-bg-secondary: {{ $color->sidebar_right_color }};
                --osen-menu-item-color: {{ $color->sidebar_text_color }} !important;
                --osen-menu-bg: {{ $color->sidebar_left_color }} !important;


                --osen-topbar-bg: {{ $color->layout_left_color }} !important;
                --osen-topbar-bg-secondary: {{ $color->layout_right_color }} !important;
                --osen-topbar-user-border: {{ $color->sidebar_text_color }} !important;
                --osen-topbar-user-bg: {{ $color->layout_left_color }} !important;
                
                --osen-secondary-bg: {{ $color->card_body_color }} !important;
                --osen-body-color-new: {{ $color->card_text_color }} !important;

                --osen-card-header-color: {{ $color->card_header_color }} !important;
                --osen-card-header-text-color: {{ $color->card_border_color }} !important;
                --osen-card-title-color: {{ $color->card_border_color }} !important;
                --osen-btn-bg-primary: {{ $color->btn_primary_color }};
                --osen-btn-bg-success: {{ $color->btn_success_color }};
                --osen-btn-bg-danger: {{ $color->btn_danger_color }};
                --osen-btn-bg-info: {{ $color->btn_info_color }};
                --osen-btn-bg-warning: {{ $color->btn_warning_color }};
                --osen-btn-bg-secondary: {{ $color->btn_secondary_color }};
                --osen-btn-bg-dark: {{ $color->btn_dark_color }};
                --osen-table-header-bg-color: {{ $color->table_header_bg_color }};
                --osen-table-header-text-color: {{ $color->table_header_text_color }};
                --osen-body-color: {{ $color->table_text_color }} !important;
                --osen-light: {{ $color->table_header_border_color }} !important;
                --osen-topbar-item-color: {{ $color->sidebar_text_color }} !important;
                --osen-topbar-item-hover-color: {{ $color->sidebar_text_hover_color }} !important;
                --osen-side-bar-hover-color: {{ $color->sidebar_menu_hover_color }} !important;
                --osen-menu-item-active-bg: {{ $color->sidebar_menu_hover_color }} !important;
                --osen-menu-item-hover-bg: {{ $color->sidebar_menu_hover_color }} !important;
                --osen-input-border-color: {{ $color->input_border_color }} !important;
                --osen-background-color: {{ $color->body_bg_color }} !important;
                --osen-border-color: {{ $color->border_dashed }} !important;
                --osen-inp-select-bg-color: {{ $color->inp_select_bg }} !important;
                --osen-inp-select-fcus-color: {{ $color->inp_focus_bg }} !important;
                --osen-border-inp-select-color: {{ $color->inp_focus_border }} !important;
                --osen-border-inp-select-active-color: {{ $color->inp_selected_border }} !important;
                --osen-inp-suggestions-box-bg-color: {{ $color->inp_suggest_bg }} !important;
                --osen-inp-search-spinner-color: {{ $color->inp_search_spinner }} !important;

                /* --osen-menu-item-color: {{ $color->sidebar_text_color }} !important; */
            }
        </style>
    @endif



    <!-- Begin page -->
    <div class="wrapper">

        
        <!-- Sidenav Menu Start -->
            @include('core::dashboard.partials.sidebar')
        <!-- Sidenav Menu End -->
        

        <!-- Topbar Start -->
            @include('core::dashboard.partials.topbar')
        <!-- Topbar End -->

        <!-- Search Modal -->
        {{-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-transparent">
                    <div class="card mb-1">
                        <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                            <i class="ti ti-search fs-22"></i>
                            <input type="search" class="form-control border-0" id="search-modal-input" placeholder="Search for actions, people,">
                            <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            <div class="page-container">

                @yield('content')
                
            </div> <!-- container -->

            <!-- Footer Start -->
                @include('core::dashboard.partials.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    @include('core::dashboard.partials.theme_settings')






    <!-- Vendor js -->
    <script src="{{ asset('backend') }}/assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('backend') }}/assets/js/app.js"></script>

    <script src="{{ asset('backend') }}/assets/js/dataTables.js"></script>


    <script src="{{ asset('backend') }}/flatpickr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    
    <script src="{{ asset('backend') }}/assets/js/custom.js"></script>
<script>
        const sweetAlertConfirmation = {
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        };

        const toastConfiguration = {
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true
        };

        

        $(document).ready( function () {
            $('#myTable').DataTable();
            
        } );


        // ✅ Loader Hide on Page Load
        // window.addEventListener("load", function () {
        //     // ✅ Just hide the spinner
        //     setTimeout(() => {
        //         document.getElementById("loader").style.display = "none";
        //     }, 400);
        // });

        // window.addEventListener("beforeunload", function () {
        //     // ✅ Just show the spinner only
        //     document.getElementById("loader").style.display = "block";
        // });


    </script>
    
    @if (session('success'))
        <script>
            const Toast = Swal.mixin(toastConfiguration);
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        </script>
    @endif
    
    @yield('script')


   



</body>


<!-- Mirrored from coderthemes.com/osen/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Apr 2025 04:49:51 GMT -->
</html>