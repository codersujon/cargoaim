@php
    $profile = \Modules\Auth\Models\Profile::first();
@endphp


<footer class="footer">
    <div class="page-container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <script>
                    document.write(new Date().getFullYear())
                </script> © {{ $profile->name }}. <span
                    class="text-reset fs-12">{{ $profile->copyright }}</span>
            </div>
            <div class="col-md-6">
                <div class="text-md-end footer-links d-none d-md-block">
                    <a href="javascript: void(0);">About</a>
                    <a href="javascript: void(0);">Support</a>
                    <a href="javascript: void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>

