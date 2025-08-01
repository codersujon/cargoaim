@extends('core::dashboard.layouts.master')

@section('title', "Dashboard")

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                </div>
                <div class="mt-3 mt-sm-0">
                    <form action="javascript:void(0);">
                        <div class="row g-2 mb-0 align-items-center">
                            <div class="col-auto">
                                <a href="javascript: void(0);" class="btn btn-light">
                                    <i class="ti ti-sort-ascending me-1"></i> Sort By
                                </a>
                            </div>
                            <!--end col-->
                            <div class="col-sm-auto">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 shadow" data-provider="flatpickr" data-deafult-date="01 May to 31 May" data-date-format="d M" data-range-date="true">
                                    <span class="input-group-text bg-primary border-primary text-white">
                                        <i class="ti ti-calendar fs-15"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div><!-- end card header -->
        </div>
        <!--end col-->
    </div> <!-- end row-->

    <div class="row">
        <div class="col">
            <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1 text-center">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Orders</h5>
                            <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                <div class="user-img fs-42 flex-shrink-0">
                                    <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                        <iconify-icon icon="solar:case-round-minimalistic-bold-duotone"></iconify-icon>
                                    </span>
                                </div>
                                <h3 class="mb-0 fw-bold">687.3k</h3>
                            </div>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2"><i class="ti ti-caret-down-filled"></i> 9.19%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Returns</h5>
                            <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                <div class="user-img fs-42 flex-shrink-0">
                                    <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                        <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                                    </span>
                                </div>
                                <h3 class="mb-0 fw-bold">9.62k</h3>
                            </div>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="ti ti-caret-up-filled"></i> 26.87%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Avg. Sales Earnings</h5>
                            <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                <div class="user-img fs-42 flex-shrink-0">
                                    <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                        <iconify-icon icon="solar:wallet-money-bold-duotone"></iconify-icon>
                                    </span>
                                </div>
                                <h3 class="mb-0 fw-bold">$98.24 <small class="text-muted">USD</small></h3>
                            </div>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="ti ti-caret-up-filled"></i> 3.51%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Number of Visits</h5>
                            <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                <div class="user-img fs-42 flex-shrink-0">
                                    <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                        <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                    </span>
                                </div>
                                <h3 class="mb-0 fw-bold">87.94M</h3>
                            </div>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2"><i class="ti ti-caret-down-filled"></i> 1.05%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div> <!-- end col-->
    </div> <!-- end row-->
@endsection

               

                
