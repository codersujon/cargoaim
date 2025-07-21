@extends('core::dashboard.layouts.master')
@section('title', "| {{ transText('nvocc_ch') }}")

@section('content')
<div class="row pt-2">
    <div class="col-xl-12">
        <div class="card">
            {{-- card header --}}
            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                <h4 class="header-title">{{ transText('nvocc_ch') }}</h4>
            </div>

            {{-- tabs  start --}}

            <div class="tabs-container">
                <div class="tabs">
                    <div class="tab-links">
                        <button class="tab-link active" data-tab="tab-1">Find</button>
                        <button class="tab-link" data-tab="tab-2">Booking</button>
                        <button class="tab-link" data-tab="tab-3">BL Parties</button>
                        <button class="tab-link" data-tab="tab-4">CGO/CONT</button>
                        <button class="tab-link" data-tab="tab-5">Charges</button>
                        <button class="tab-link" data-tab="tab-6">PSA/AN</button>
                        <button class="tab-link" data-tab="tab-7">HBL View</button>
                        <button class="tab-link" data-tab="tab-8">Notify</button>

                        <div class="tab-indicator"></div>
                    </div>

                    <!-- Tab Contents -->
                    <div class="tab-content active" id="tab-1">
                        <h2>Find Content</h2>
                    </div>
                    <div class="tab-content" id="tab-2">
                        <h2>Booking Content</h2>
                    </div>
                    <div class="tab-content" id="tab-3">
                        <h2>BL Parties Content</h2>
                    </div>
                    <div class="tab-content" id="tab-4">
                        <h2>CGO/CONT Content</h2>
                    </div>
                    <div class="tab-content" id="tab-5">
                        <h2>Charges Content</h2>
                    </div>
                    <div class="tab-content" id="tab-6">
                        <h2>PSA/AN Content</h2>
                    </div>
                    <div class="tab-content" id="tab-7">
                        <h2>HBL View Content</h2>
                    </div>
                    <div class="tab-content" id="tab-8">
                        <h2>Notify Content</h2>
                    </div>
                </div>
            </div>

            {{-- tabs  end --}}

        </div>
    </div> <!-- end col -->
</div>

<style>
    .tabs-container {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 8px 0;
    }

    .tabs {
        width: 98%;
        max-width: 100%;
    }

    .tab-links {
        display: flex;
        justify-content: left;
        position: relative;
        overflow-x: auto;
        scrollbar-width: none;
        gap: 4px;
    }

    .tab-link {
        flex: none;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 500;
        background: none;
        border: 1px solid #ddd;

        cursor: pointer;
        text-transform: uppercase;
        color: #555;
        position: relative;
        transition: color 0.3s ease, 0.4s ease;
        border-radius: 6px 6px 0 0;
    }

    .tab-link.active {
        font-weight: 700;
        color: #3347e4;
        border: 1px solid #3347e4; /* Solid border */
        background: none; /* Remove gradient */
        background-clip: border-box;
    }


    .tab-indicator {
        position: absolute;
        bottom: 0;
        height: 3px;
        width: 0;
        background: linear-gradient(270deg, #7f00ff, #3347e4);
        transition: all 0.4s ease;
        border-radius: 10px 10px 0 0;
        z-index: 2;
    }

    .tab-content {
        display: none;
        padding: 20px;
        background: #f5f5f5;
        border-radius: 0 0 8px 8px;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(10px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tabLinks = document.querySelectorAll(".tab-link");
        const tabContents = document.querySelectorAll(".tab-content");
        const indicator = document.querySelector(".tab-indicator");

        function activateTab(tabBtn) {
            const tabId = tabBtn.dataset.tab;

            // Remove all active classes
            tabLinks.forEach(btn => {
                btn.classList.remove("active");
                // ✅ Remove this line ↓
                // btn.style.background = "none";
            });
            tabContents.forEach(content => content.classList.remove("active"));

            // Add active classes
            tabBtn.classList.add("active");
            document.getElementById(tabId)?.classList.add("active");

            // Move tab indicator
            indicator.style.width = `${tabBtn.offsetWidth}px`;
            indicator.style.left = `${tabBtn.offsetLeft}px`;
        }

        // Attach click events
        tabLinks.forEach(tab => {
            tab.addEventListener("click", () => activateTab(tab));
        });

        // Initial activation
        const initial = document.querySelector(".tab-link.active") || tabLinks[0];
        if (initial) activateTab(initial);
    });
</script>

@endsection
