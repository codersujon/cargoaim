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
        <ul class="side-nav mt-2">
            <li class="sf_nav"><a href="#">DOC</a></li>
            <li class="sf_nav"><a href="#">LOG</a></li>
            <li class="sf_nav"><a href="#">ACC</a></li>
            <li class="sf_nav"><a href="#">CHA</a></li>
            <li class="sf_nav"><a href="#">HRM</a></li>
            <li class="sf_nav"><a href="#">PAX</a></li>
            <li class="sf_nav"><a href="#">GSA</a></li>
            <li class="sf_nav"><a href="#">WMS</a></li>
            <li class="sf_nav"><a href="#">TRK</a></li>
            <li class="sf_nav"><a href="#">CMS</a></li>
            <li class="sf_nav"><a href="#">POM</a></li>
        </ul>

        <div class="clearfix"></div>
    </div>
</div>
