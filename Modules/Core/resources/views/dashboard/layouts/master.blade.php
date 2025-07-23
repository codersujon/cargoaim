<!DOCTYPE html>

{{-- <html lang="en"> --}}
<html lang="en" data-sidenav-size="condensed" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light" data-layout-mode="detached">

<head>
    <meta charset="utf-8" />

    @php
        $profile = \Modules\Auth\Models\Profile::first();
    @endphp

    <title> {{ $profile? $profile->name : '' }} | @yield('title') </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CargoAIM is an ERP (Enterprise Resource Planning) software specifically designed for freight forwarders" name="description" />
    <meta content="Cargoaim" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('upload/' . $profile->fav_icon) }}">

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

    @vite([
        // Default Laravel assets
        'resources/css/app.css',
        'resources/js/app.js',

        // Module: Core
        'Modules/Core/resources/assets/css/custom-icon.css',

        // Module: Customsfiling
        'Modules/Customsfiling/resources/assets/js/ics2_ens.js',

        // Module: NVOCC
        'Modules/NVOCC/resources/assets/css/nvocc.css',
        'Modules/NVOCC/resources/assets/js/app.js',
    ])


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

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            <div class="page-container">

                @yield('content')
                
            </div> <!-- container -->

            <!-- Footer Start -->
                {{-- @include('core::dashboard.partials.footer') --}}
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
      
    <script src="{{ asset('backend') }}/assets/js/custom.js"></script>
    
    <script>
        
        window.transText = {
            err_ttl_msg: @json(transText('err_ttl_msg')),
            err_msg: @json(transText('err_msg')),
            conf_ttl_msg: @json(transText('conf_ttl_msg')),
            conf_msg: @json(transText('conf_msg')),
            conf_yd_btn: @json(transText('conf_yd_btn')),
            cancel_btn: @json(transText('cancel_btn')),
            err_val_ttl_msg: @json(transText('err_val_ttl_msg')),
            actv_msg: @json(transText('actv_msg')),
            dact_msg: @json(transText('dact_msg')),
            data_empty_msg: @json(transText('data_empty_msg')),
            try_msg: @json(transText('try_msg')),
            save_btn: @json(transText('save_btn')),
            ics2_hbl_ens_create_new: @json(transText('ics2_hbl_ens_create_new')),
            f_upd_msg: @json(transText('f_upd_msg')),
        };        

        $(document).ready( function () {
            $('#myTable').DataTable();
            
        } );
    </script>

    @yield('script')

</body>


<!-- Mirrored from coderthemes.com/osen/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Apr 2025 04:49:51 GMT -->
</html>