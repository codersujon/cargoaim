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

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title">Dash</li>

            <li class="side-nav-item">
                <a href="{{ url('language') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-language"></i></span>
                   <span class="menu-text"> {{ transText('language_menu') }} </span> 
                </a>
            </li>
            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-file"></i></span>
                    <span class="menu-text"> {{ transText('eu_ics_2_ens') }} </span> 
                </a>
            </li>

            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <span class="sf_menu">DOC</span>
                    <span class="menu-text"> {{ transText('booking_documentation') }} </span> 
                </a>
            </li>

             <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <span class="sf_menu">LOG</span>
                    <span class="menu-text"> {{ transText('eu_ics_2_ens') }} </span> 
                </a>
            </li>
            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <span class="sf_menu">ACC</span>
                    <span class="menu-text"> {{ transText('eu_ics_2_ens') }} </span> 
                </a>
            </li>
             <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <span class="sf_menu">CHA</span>
                    <span class="menu-text"> {{ transText('eu_ics_2_ens') }} </span> 
                </a>
            </li>

        </ul>

        <div class="clearfix"></div>
    </div>
</div>
