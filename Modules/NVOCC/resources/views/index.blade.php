@extends('core::dashboard.layouts.master')
@section('title', "| {{ transText('nvocc_ch') }}")

@section('content')

    <div class="row pt-3">
        <div class="col-lg-12">
            <div class="card">

               <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0" style="font-weight: 750;">{{ transText('nvocc_ch') }}</h4>
                    <button type="button" class="btn btn-primary ms-1" id="createNew1">
                        {{ transText('new_hbl_file_btn') }}
                    </button>
                </div>

                <div class="card-body">
                        test
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

