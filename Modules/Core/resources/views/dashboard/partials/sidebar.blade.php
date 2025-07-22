@php
    $profile = \Modules\Auth\Models\Profile::first();
@endphp

<div class="sidenav-menu">

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
            @foreach($sidemenus as $item)
                @php
                    $itemUrl = $item->url ?? ($item->route ? route($item->route) : '#');
                    $isActive = request()->is(ltrim(parse_url($itemUrl, PHP_URL_PATH), '/'));
                @endphp
                <li class="sf_nav">
                    <a href="{{ $itemUrl }}" data-title="{{ transText($item->tooltip_title) }}" class="{{ $isActive ? 'active' : '' }}">{{ transText($item->title) }}</a>
                </li>
            @endforeach
        </ul>
        <!-- Side Navigation Menu -->
        <div class="clearfix"></div>
    </div>
</div>
