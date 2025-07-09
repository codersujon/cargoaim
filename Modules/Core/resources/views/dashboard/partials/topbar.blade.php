@php
    $profile = \Modules\Auth\Models\Profile::first();
@endphp


<header class="app-topbar">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-2">

            <!-- Brand Logo -->
            <a href="{{ route('user.dashboard') }}" class="logo">
                <span class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}" alt="small logo">
                    </span>
                </span>

                <span class="logo-dark">
                    <span class="logo-lg"><img src="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}"
                            alt="dark logo"></span>
                    <span class="logo-sm"><img src="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}"
                            alt="small logo"></span>
                </span>
            </a>

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button px-2">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-deep"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6h16" /><path d="M7 12h13" /><path d="M10 18h10" /></svg>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-deep"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6h16" /><path d="M7 12h13" /><path d="M10 18h10" /></svg>
            </button>

            

            <!-- Mega Menu Dropdown -->
            {{-- <div class="topbar-item d-none d-md-flex">
                <div class="dropdown">
                    <a href="#" class="topbar-link btn btn-link px-2 dropdown-toggle drop-arrow-none fw-medium"
                         data-bs-trigger="hover" data-bs-offset="0,17" aria-haspopup="false"
                        aria-expanded="false">
                        Pages <i class="ti ti-chevron-down ms-1"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-xxl p-0">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="p-3">
                                    <h5 class="mb-2 fw-semibold">UI Components</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="#!">Widgets</a>
                                        </li>
                                        <li>
                                            <a href="#">Dragula</a>
                                        </li>
                                        <li>
                                            <a href="#">Dropdowns</a>
                                        </li>
                                        <li>
                                            <a href="#">Ratings</a>
                                        </li>
                                        <li>
                                            <a href="#">Sweet Alerts</a>
                                        </li>
                                        <li>
                                            <a href="#">Scrollbar</a>
                                        </li>
                                        <li>
                                            <a href="#">Range Slider</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="p-3">
                                    <h5 class="mb-2 fw-semibold">Applications</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="#">eCommerce Pages</a>
                                        </li>
                                        <li>
                                            <a href="#">Hospital</a>
                                        </li>
                                        <li>
                                            <a href="#">Email</a>
                                        </li>
                                        <li>
                                            <a href="#">Calendar</a>
                                        </li>
                                        <li>
                                            <a href="#">Kanban Board</a>
                                        </li>
                                        <li>
                                            <a href="#">Invoice Management</a>
                                        </li>
                                        <li>
                                            <a href="#">Pricing</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-4 bg-light bg-opacity-50">
                                <div class="p-3">
                                    <h5 class="mb-2 fw-semibold">Extra Pages</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);">Left Sidebar with User</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Menu Collapsed</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Small Left Sidebar</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">New Header Style</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">My Account</a>
                                        </li>
                                        <li>
                                            <a href="#">Maintenance & Coming Soon</a>
                                        </li>
                                    </ul>
                                </div> <!-- end .bg-light-->
                            </div> <!-- end col-->
                        </div> <!-- end row-->
                    </div> <!-- .dropdown-menu-->
                </div> <!-- .dropdown-->
            </div>  --}}
            <!-- end topbar-item -->

            <!-- Mega Menu Dropdown -->
            {{-- <div class="topbar-item d-none d-md-flex">
                <div class="dropdown">
                    <a href="#" class="topbar-link btn btn-link px-2 dropdown-toggle drop-arrow-none fw-medium" data-bs-trigger="hover" data-bs-offset="0,17" aria-haspopup="false"
                        aria-expanded="false">
                        Test <i class="ti ti-chevron-down ms-1"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-xxl p-0">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="p-3">
                                    <h5 class="mb-2 fw-semibold">UI Components</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="#!">Widgets</a>
                                        </li>
                                        <li>
                                            <a href="#">Dragula</a>
                                        </li>
                                        <li>
                                            <a href="#">Dropdowns</a>
                                        </li>
                                        <li>
                                            <a href="#">Ratings</a>
                                        </li>
                                        <li>
                                            <a href="#">Sweet Alerts</a>
                                        </li>
                                        <li>
                                            <a href="#">Scrollbar</a>
                                        </li>
                                        <li>
                                            <a href="#">Range Slider</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="p-3">
                                    <h5 class="mb-2 fw-semibold">Applications</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="#">eCommerce Pages</a>
                                        </li>
                                        <li>
                                            <a href="#">Hospital</a>
                                        </li>
                                        <li>
                                            <a href="#">Email</a>
                                        </li>
                                        <li>
                                            <a href="#">Calendar</a>
                                        </li>
                                        <li>
                                            <a href="#">Kanban Board</a>
                                        </li>
                                        <li>
                                            <a href="#">Invoice Management</a>
                                        </li>
                                        <li>
                                            <a href="#">Pricing</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- end col-->
                        </div> <!-- end row-->
                    </div> <!-- .dropdown-menu-->
                </div> <!-- .dropdown-->
            </div>  --}}
            <!-- end topbar-item -->

            {{-- Mega Menu Dropdown --}}
            <div class="topbar_menu">
                <ul>
                    <li>
                        <a href="#"><i class="fa-solid fa-briefcase"></i> NMS <i class="fa-solid fa-angles-down"></i></a>
                        <ul class="submenu">
                            <li><a href=""><i class="fas fa-briefcase"></i> Business Management</a></li>
                            <li><a href=""><i class="fas fa-pen-nib"></i> User Interface Design</a></li>
                            <li><a href=""><i class="fas fa-database"></i> Database Management</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa-solid fa-briefcase"></i> Schedule <i class="fa-solid fa-angles-down"></i></a>
                        <ul class="submenu">
                            <li><a href=""><i class="fas fa-briefcase"></i> Feeder Schedule</a></li>
                            <li><a href=""><i class="fas fa-pen-nib"></i> Mother Schedule</a></li>
                            <li><a href=""><i class="fas fa-database"></i> PRE /ONC Entry</a></li>
                            <li><a href=""><i class="fas fa-database"></i> Career's Mother Lane</a></li>
                            <li><a href=""><i class="fas fa-database"></i> Port 2 Port Routing</a></li>
                            <li><a href=""><i class="fas fa-database"></i> VSL to VSL Link</a></li>
                            <li><a href=""><i class="fas fa-database"></i> Port to Port Check</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa-solid fa-tags"></i> Tariff</a></li>
                    <li><a href="#"><i class="fa-solid fa-dollar-sign"></i> Sales</a></li>
                    <li><a href="#"><i class="fa-solid fa-headset"></i> CS & DOC</a></li>
                    <li><a href="#"><i class="fa-solid fa-chart-line"></i> Reports</a></li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-cog"></i> Settings
                            <i class="fa-solid fa-angles-down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href=""><i class="fas fa-briefcase"></i> Business Management</a></li>
                            <li><a href=""><i class="fas fa-pen-nib"></i> User Interface Design</a></li>
                            <li><a href=""><i class="fas fa-database"></i> Database Management</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">

            <!-- Search for small devices -->
            <div class="topbar-item d-flex d-xl-none">
                <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                    <i class="ti ti-search fs-22"></i>
                </button>
            </div>

        

            <!-- Language Dropdown -->
            <div class="topbar-item">
                <div class="dropdown">
                    @php
                        use Illuminate\Support\Facades\DB;
                        use Illuminate\Support\Facades\Auth;

                        $excludedColumns = ['row_id', 'apply_on_type', 'message_id_to_call', 'remarks', 'created_at', 'updated_at'];
                        $table = 'language';
                        $database = DB::getDatabaseName();

                        $columns = DB::select("
                            SELECT COLUMN_NAME, COLUMN_COMMENT
                            FROM information_schema.COLUMNS
                            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?
                            ORDER BY ORDINAL_POSITION
                        ", [$database, $table]);

                        $user = Auth::guard('web')->user();

                        // ইউজারের ভাষা থেকে ফ্ল্যাগ ফাইল খোঁজা
                        $userLang = $user->user_language ?? 'en';  // ডিফল্ট en
                        
                        $flag = 'default.png';
                        $extensions = ['svg', 'png', 'jpg'];

                        foreach ($extensions as $ext) {
                            $relativePath = "backend/assets/images/flags/{$userLang}.{$ext}";
                            if (file_exists(public_path($relativePath))) {
                                $flag = "{$userLang}.{$ext}";
                                break;
                            }
                        }

                        $flagUrl = asset("backend/assets/images/flags/" . $flag);
                        
                    @endphp

                    <!-- সিলেক্টেড ভাষার ফ্ল্যাগ -->
                    <button class="topbar-link" data-bs-offset="0,25" type="button"
                        aria-haspopup="false" aria-expanded="false">
                        <img src="{{ $flagUrl }}" alt="user-language-flag"
                            class="w-100 rounded" height="18" id="selected-language-image">
                    </button>

                    <!-- ড্রপডাউন ভাষার তালিকা -->
                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach ($columns as $column)
                            @if (!in_array($column->COLUMN_NAME, $excludedColumns))
                                @php
                                    $firstWord = explode(' ', trim($column->COLUMN_COMMENT))[0];
                                    $flag = 'default.png';
                                    $columnName = $column->COLUMN_NAME;

                                    foreach ($extensions as $ext) {
                                        $relativePath = "backend/assets/images/flags/{$columnName}.{$ext}";
                                        if (file_exists(public_path($relativePath))) {
                                            $flag = "{$columnName}.{$ext}";
                                            break;
                                        }
                                    }

                                    $flagUrl = asset("backend/assets/images/flags/" . $flag);
                                @endphp

                                <a href="{{ route('lang.switch', $column->COLUMN_NAME) }}" class="dropdown-item" data-translator-lang="{{ $column->COLUMN_NAME }}">
                                    <img src="{{ $flagUrl }}" alt="{{ $column->COLUMN_NAME }} flag" class="me-1 rounded" height="18" data-translator-image>
                                    <span class="align-middle">{{ $firstWord }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>

            <!-- Notification Dropdown -->
            <div class="topbar-item">
                <div class="dropdown">
                    <button class="topbar-link dropdown-toggle drop-arrow-none" 
                        data-bs-offset="0,25" type="button" data-bs-auto-close="outside" aria-haspopup="false"
                        aria-expanded="false">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bell animate-ring"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                        <span class="noti-icon-badge"></span>
                    </button>

                    <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="min-height: 300px;">
                        <div class="p-3 border-bottom border-dashed">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                                </div>
                                {{-- <div class="col-auto">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none link-dark"
                                             data-bs-offset="0,15" aria-expanded="false">
                                            <i class="ti ti-settings fs-22 align-middle"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Mark as
                                                Read</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Delete
                                                All</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Do not
                                                Disturb</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Other
                                                Settings</a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="position-relative z-2 card shadow-none rounded-0" style="max-height: 300px;"
                            data-simplebar>
                            <!-- item-->
                            <div class="dropdown-item notification-item py-2 text-wrap active" id="notification-1">
                                <span class="d-flex align-items-center">
                                    <span class="me-3 position-relative flex-shrink-0">
                                        <img src="{{ asset('public/dashboard') }}/assets/images/users/avatar-2.jpg"
                                            class="avatar-md rounded-circle" alt="" />
                                        <span class="position-absolute rounded-pill bg-danger notification-badge">
                                            <i class="ti ti-message-circle"></i>
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1 text-muted">
                                        <span class="fw-medium text-body">Glady Haid</span> commented on <span
                                            class="fw-medium text-body">paces admin status</span>
                                        <br />
                                        <span class="fs-12">25m ago</span>
                                    </span>
                                    <span class="notification-item-close">
                                        <button type="button"
                                            class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                            data-dismissible="#notification-1">
                                            <i class="ti ti-x fs-16"></i>
                                        </button>
                                    </span>
                                </span>
                            </div>

                            <!-- item-->
                            <div class="dropdown-item notification-item py-2 text-wrap" id="notification-2">
                                <span class="d-flex align-items-center">
                                    <span class="me-3 position-relative flex-shrink-0">
                                        <img src="{{ asset('public/dashboard') }}/assets/images/users/avatar-4.jpg"
                                            class="avatar-md rounded-circle" alt="" />
                                        <span class="position-absolute rounded-pill bg-info notification-badge">
                                            <i class="ti ti-currency-dollar"></i>
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1 text-muted">
                                        <span class="fw-medium text-body">Tommy Berry</span> donated <span
                                            class="text-success">$100.00</span> for <span
                                            class="fw-medium text-body">Carbon removal program</span>
                                        <br />
                                        <span class="fs-12">58m ago</span>
                                    </span>
                                    <span class="notification-item-close">
                                        <button type="button"
                                            class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                            data-dismissible="#notification-2">
                                            <i class="ti ti-x fs-16"></i>
                                        </button>
                                    </span>
                                </span>
                            </div>

                            <!-- item-->
                            <div class="dropdown-item notification-item py-2 text-wrap" id="notification-3">
                                <span class="d-flex align-items-center">
                                    <div class="avatar-md flex-shrink-0 me-3">
                                        <span class="avatar-title bg-success-subtle text-success rounded-circle fs-22">
                                            <iconify-icon icon="solar:wallet-money-bold-duotone"></iconify-icon>
                                        </span>
                                    </div>
                                    <span class="flex-grow-1 text-muted">
                                        You withdraw a <span class="fw-medium text-body">$500</span> by <span
                                            class="fw-medium text-body">New York ATM</span>
                                        <br />
                                        <span class="fs-12">2h ago</span>
                                    </span>
                                    <span class="notification-item-close">
                                        <button type="button"
                                            class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                            data-dismissible="#notification-3">
                                            <i class="ti ti-x fs-16"></i>
                                        </button>
                                    </span>
                                </span>
                            </div>

                            <!-- item-->
                            <div class="dropdown-item notification-item py-2 text-wrap" id="notification-4">
                                <span class="d-flex align-items-center">
                                    <span class="me-3 position-relative flex-shrink-0">
                                        <img src="{{ asset('public/dashboard') }}/assets/images/users/avatar-7.jpg"
                                            class="avatar-md rounded-circle" alt="" />
                                        <span class="position-absolute rounded-pill bg-secondary notification-badge">
                                            <i class="ti ti-plus"></i>
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1 text-muted">
                                        <span class="fw-medium text-body">Richard Allen</span> followed you in
                                        <span class="fw-medium text-body">Facebook</span>
                                        <br />
                                        <span class="fs-12">3h ago</span>
                                    </span>
                                    <span class="notification-item-close">
                                        <button type="button"
                                            class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                            data-dismissible="#notification-4">
                                            <i class="ti ti-x fs-16"></i>
                                        </button>
                                    </span>
                                </span>
                            </div>

                            <!-- item-->
                            <div class="dropdown-item notification-item py-2 text-wrap" id="notification-5">
                                <span class="d-flex align-items-center">
                                    <span class="me-3 position-relative flex-shrink-0">
                                        <img src="{{ asset('public/dashboard') }}/assets/images/users/avatar-10.jpg"
                                            class="avatar-md rounded-circle" alt="" />
                                        <span class="position-absolute rounded-pill bg-danger notification-badge">
                                            <i class="ti ti-heart-filled"></i>
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1 text-muted">
                                        <span class="fw-medium text-body">Victor Collier</span> liked you
                                        recent photo in <span class="fw-medium text-body">Instagram</span>
                                        <br />
                                        <span class="fs-12">10h ago</span>
                                    </span>
                                    <span class="notification-item-close">
                                        <button type="button"
                                            class="btn btn-ghost-danger rounded-circle btn-sm btn-icon"
                                            data-dismissible="#notification-5">
                                            <i class="ti ti-x fs-16"></i>
                                        </button>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div style="height: 300px;"
                            class="d-flex align-items-center justify-content-center text-center position-absolute top-0 bottom-0 start-0 end-0 z-1">
                            <div>
                                <iconify-icon icon="line-md:bell-twotone-alert-loop"
                                    class="fs-80 text-secondary mt-2"></iconify-icon>
                                <h4 class="fw-semibold mb-0 fst-italic lh-base mt-3">Hey! 👋 <br />You have no
                                    any notifications</h4>
                            </div>
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);"
                            class="dropdown-item notification-item position-fixed z-2 bottom-0 text-center text-reset text-decoration-underline link-offset-2 fw-bold notify-item border-top border-light py-2">
                            View All
                        </a>
                    </div>
                </div>
            </div>
  
            <!-- Button Trigger Customizer Offcanvas -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
                    type="button">
                   <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                </button>
            </div>

            <!-- Light/Dark Mode Button -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link" id="light-dark-mode" type="button">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-moon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                </button>
            </div>

            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2"
                        data-bs-offset="0,19" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('backend') }}/assets/images/users/avatar-1.jpg" width="32"
                            class="rounded-circle me-lg-2 d-flex" alt="user-image">
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            <h5 class="my-0">Dhanoo K.</h5>
                            <h6 class="my-0 fw-normal">Premium</h6>
                        </span>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6" /></svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="{{ url('profile') }}" class="dropdown-item">
                            <i class="ti ti-user-hexagon me-1 fs-17 align-middle"></i>
                            <span class="align-middle">My Profile</span>
                        </a>


                        <!-- item-->
                        <a href="{{ url('color_settings')}}" class="dropdown-item">
                            <i class="ti ti-settings me-1 fs-17 align-middle"></i>
                            <span class="align-middle">Settings</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ti ti-lifebuoy me-1 fs-17 align-middle"></i>
                            <span class="align-middle">Support</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="#" class="dropdown-item fw-semibold text-danger"
                        onclick="event.preventDefault(); manualLogout = true; document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout me-1 fs-17 align-middle"></i>
                            <span class="align-middle">Sign Out</span>
                        </a>

                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // হোভার ইভেন্ট দিয়ে ড্রপডাউন শো/হাইড
        $('.topbar-item .dropdown').hover(
            function () {
                $(this).addClass('show');
                $(this).find('.dropdown-menu').addClass('show');
            },
            function () {
                $(this).removeClass('show');
                $(this).find('.dropdown-menu').removeClass('show');
            }
        );
    });

</script>
