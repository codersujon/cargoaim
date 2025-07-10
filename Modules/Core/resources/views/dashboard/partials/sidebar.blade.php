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
        <ul class="side-nav mb-2">

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    DOC
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    LOG
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    ACC
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    CHA
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    HRM
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    PAX
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    GSA
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    WMS
                </a>
            </li>
         
            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    TRK
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    CMS
                </a>
            </li>

            <li class="sf_nav">
                <a href="#">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-right-double"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 18v-6a3 3 0 0 1 3 -3h7" /><path d="M10 13l4 -4l-4 -4m5 8l4 -4l-4 -4" /></svg>
                    POM
                </a>
            </li>
            
        </ul>

        <div class="clearfix"></div>
    </div>
</div>
