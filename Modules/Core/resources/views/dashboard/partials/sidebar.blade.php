@php
    $profile = \Modules\Auth\Models\Profile::first();
@endphp

<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a href="{{ route('user.dashboard') }}" class="logo">
        <span class="logo-light">
            <span class="logo-lg">
                <img src="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}" alt="logo">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}"
                    alt="small logo">
            </span>
        </span>

        <span class="logo-dark">
           <span class="logo-lg"><img src="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}"
                    alt="dark logo"></span>
            <span class="logo-sm"><img src="{{ asset('upload/' . ($profile->logo ?? 'default.png')) }}"
                    alt="small logo"></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ti ti-circle align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

      <!-- Side Navigation Menu -->
        <ul class="side-nav">
            <li class="sf_nav"><a href="#" title="Booking & Documentation">DOC</a></li>
            <li class="sf_nav"><a href="#" title="Depot & Cargo Status">LOG</a></li>
            <li class="sf_nav"><a href="#" title="Accounting">ACC</a></li>
            <li class="sf_nav"><a href="#" title="Customs House/Brokerage">CHA</a></li>
            <li class="sf_nav"><a href="#" title="HR & User ID">HRM</a></li>
            <li class="sf_nav"><a href="#" title="Passenger Billing">PAX</a></li>
            <li class="sf_nav"><a href="#" title="Airlines & GSA Billing">GSA</a></li>
            <li class="sf_nav"><a href="#" title="Warehouse">WMS</a></li>
            <li class="sf_nav"><a href="#" title="Trucking (Fleet Owner)">TRK</a></li>
            <li class="sf_nav"><a href="#" title="Courier">CMS</a></li>
            <li class="sf_nav"><a href="#" title="Purchase Order Management">POM</a></li>
            <li class="sf_nav"><a href="#" title="Purchase Order Management">NVO</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
