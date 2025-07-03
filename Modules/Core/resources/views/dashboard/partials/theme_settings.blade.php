<!-- Theme Settings -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
    <div class="d-flex align-items-center gap-2 px-3 py-3 offcanvas-header border-bottom border-dashed">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0" data-simplebar>
        <div class="p-3 border-bottom border-dashed d-flex gap-2">
            <a href="{{ url('color')}}" class="btn btn-warning w-50">
                Color setting
               {{-- {{ transText('color_settings_btn') }} --}}
            </a>
            <button type="button" class="btn btn-warning w-50" id="reset-layout">
                color reset
                {{-- {{ transText('color_reset_btn') }} --}}
            </button>
        </div>   

        <div class="p-3 border-bottom border-dashed">
            <h5 class="mb-3 fs-16 fw-bold">
                layout Mode
                {{-- {{ transText('layout_mode') }} --}}
            </h5>

            <div class="row">
                <div class="col-4">
                    <div class="form-check card-radio">
                        <input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-fluid"
                            value="fluid">
                        <label class="form-check-label p-0 avatar-xl w-100" for="layout-mode-fluid">
                            <div>
                                <span class="d-flex h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                            <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column rounded-2">
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </span>
                                </span>
                            </div>

                            <div>
                                <span class="d-flex h-100 flex-column">
                                    <span
                                        class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                        <span class="d-block p-1 bg-dark-subtle rounded me-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                    </span>
                                    <span class="bg-light d-block p-1"></span>
                                </span>
                            </div>
                        </label>
                    </div>
                    <h5 class="fs-14 text-center text-muted mt-2">
                        Fluid
                        {{-- {{ transText('fluid') }} --}}
                    </h5>
                </div>

                <div class="col-4">
                    <div class="form-check sidebar-setting card-radio">
                        <input class="form-check-input" type="radio" name="data-layout-mode" id="data-layout-detached"
                            value="detached">
                        <label class="form-check-label p-0 avatar-xl w-100" for="data-layout-detached">
                            <span class="d-flex h-100 flex-column">
                                <span class="bg-light d-flex p-1 align-items-center border-bottom ">
                                    <span class="d-block p-1 bg-dark-subtle rounded me-1"></span>
                                    <span
                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                    <span
                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                    <span
                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                    <span
                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                </span>
                                <span class="d-flex h-100 p-1 px-2">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column p-1 px-2">
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded w-100"></span>
                                        </span>
                                    </span>
                                </span>
                                <span class="bg-light d-block p-1 mt-auto px-2"></span>
                            </span>

                        </label>
                    </div>
                    <h5 class="fs-14 text-center text-muted mt-2">
                        Detached
                        {{-- {{ transText('detached') }} --}}
                    </h5>
                </div>
            </div>
        </div>

        <div class="p-3 .border-bottom .border-dashed">
            <h5 class="mb-3 fs-16 fw-bold">
                Sidebar Size
                {{-- {{ transText('sidebar_size') }} --}}
            </h5>

            <div class="row">
                <div class="col-4">
                    <div class="form-check sidebar-setting card-radio">
                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                            id="sidenav-size-default" value="default">
                        <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-default">
                            <span class="d-flex h-100">
                                <span class="flex-shrink-0">
                                    <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                        <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                    </span>
                                </span>
                                <span class="flex-grow-1">
                                    <span class="d-flex h-100 flex-column">
                                        <span class="bg-light d-block p-1"></span>
                                    </span>
                                </span>
                            </span>
                        </label>
                    </div>
                    <h5 class="fs-14 text-center text-muted mt-2">
                        default
                        {{-- {{ transText('default') }} --}}
                    </h5>
                </div>

                <div class="col-4">
                    <div class="form-check sidebar-setting card-radio">
                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                            id="sidenav-size-compact" value="compact">
                        <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-compact">
                            <span class="d-flex h-100">
                                <span class="flex-shrink-0">
                                    <span class="bg-light d-flex h-100 border-end  flex-column p-1">
                                        <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                    </span>
                                </span>
                                <span class="flex-grow-1">
                                    <span class="d-flex h-100 flex-column">
                                        <span class="bg-light d-block p-1"></span>
                                    </span>
                                </span>
                            </span>
                        </label>
                    </div>
                    <h5 class="fs-14 text-center text-muted mt-2">
                        compact
                        {{-- {{ transText('compact') }} --}}
                    </h5>
                </div>

                <div class="col-4">
                    <div class="form-check sidebar-setting card-radio">
                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                            id="sidenav-size-small" value="condensed">
                        <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-small">
                            <span class="d-flex h-100">
                                <span class="flex-shrink-0">
                                    <span class="bg-light d-flex h-100 border-end flex-column" style="padding: 2px;">
                                        <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                    </span>
                                </span>
                                <span class="flex-grow-1">
                                    <span class="d-flex h-100 flex-column">
                                        <span class="bg-light d-block p-1"></span>
                                    </span>
                                </span>
                            </span>
                        </label>
                    </div>
                    <h5 class="fs-14 text-center text-muted mt-2">
                        condensed
                        {{-- {{ transText('condensed') }} --}}
                    </h5>
                </div>

                <div class="col-4">
                    <div class="form-check sidebar-setting card-radio">
                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                            id="sidenav-size-small-hover" value="sm-hover">
                        <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-small-hover">
                            <span class="d-flex h-100">
                                <span class="flex-shrink-0">
                                    <span class="bg-light d-flex h-100 border-end flex-column" style="padding: 2px;">
                                        <span class="d-block p-1 bg-dark-subtle rounded mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                        <span
                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                    </span>
                                </span>
                                <span class="flex-grow-1">
                                    <span class="d-flex h-100 flex-column">
                                        <span class="bg-light d-block p-1"></span>
                                    </span>
                                </span>
                            </span>
                        </label>
                    </div>
                    <h5 class="fs-14 text-center text-muted mt-2">
                        hover_view
                        {{-- {{ transText('hover_view') }} --}}
                    </h5>
                </div>

                <div class="col-4">
                    <div class="form-check sidebar-setting card-radio">
                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                            id="sidenav-size-full" value="full">
                        <label class="form-check-label p-0 avatar-xl w-100" for="sidenav-size-full">
                            <span class="d-flex h-100">
                                <span class="flex-shrink-0">
                                    <span class="d-flex h-100 flex-column">
                                        <span class="d-block p-1 bg-dark-subtle mb-1"></span>
                                    </span>
                                </span>
                                <span class="flex-grow-1">
                                    <span class="d-flex h-100 flex-column">
                                        <span class="bg-light d-block p-1"></span>
                                    </span>
                                </span>
                            </span>
                        </label>
                    </div>
                    <h5 class="fs-14 text-center text-muted mt-2">
                        full_layout
                        {{-- {{ transText('full_layout') }} --}}
                    </h5>
                </div>

            </div>
        </div>

        <div class="p-3 border-bottom border-dashed d-none">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fs-16 fw-bold mb-0">Container Width</h5>

                <div class="btn-group radio" role="group">
                    <input type="radio" class="btn-check" name="data-container-position"
                        id="container-width-fixed" value="fixed">
                    <label class="btn btn-sm btn-soft-primary w-sm" for="container-width-fixed">Full</label>

                    <input type="radio" class="btn-check" name="data-container-position"
                        id="container-width-scrollable" value="scrollable">
                    <label class="btn btn-sm btn-soft-primary w-sm ms-0"
                        for="container-width-scrollable">Boxed</label>
                </div>
            </div>
        </div>

        <div class="p-3 border-bottom border-dashed d-none">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fs-16 fw-bold mb-0">Layout Position</h5>

                <div class="btn-group radio" role="group">
                    <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed"
                        value="fixed">
                    <label class="btn btn-sm btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                    <input type="radio" class="btn-check" name="data-layout-position"
                        id="layout-position-scrollable" value="scrollable">
                    <label class="btn btn-sm btn-soft-primary w-sm ms-0"
                        for="layout-position-scrollable">Scrollable</label>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="d-flex align-items-center gap-2 px-3 py-2 offcanvas-header border-top border-dashed">
        <button type="button" class="btn w-50 btn-soft-danger" id="reset-layout">Reset</button>
    </div> --}}

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Blade file-এর <head> এর মধ্যে বা script-এর আগে -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#reset-layout').on('click', function () {
            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                    console.log(xhr.responseText);
                }
            });
        }); 

        

    });
</script>


