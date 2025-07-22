@extends('core::dashboard.layouts.master')

@section('title', "| {{ transText('ens_ch') }}")

@section('content')
    <style>
        .table > :not(caption) > * > * {
            padding: 0!important;
        }

        tr > td, tr > th {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #customerModal.modal.show {
            z-index: 1060 !important;
        }

        .modal-backdrop.show:nth-of-type(2) {
            z-index: 1055 !important;
        }
        
        /* input[required],
        select[required],
        textarea[required] {
            border: 1px solid rgb(255, 101, 101) !important;
        } */

    </style>

    <div class="row pt-3">
        <div class="col-lg-12">
            <div class="card">

               <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0" style="font-weight: 750;">{{ transText('ens_ch') }}</h4>
                    <button type="button" class="btn btn-primary ms-1" id="createNew1">
                        {{ transText('new_hbl_file_btn') }}
                    </button>
                </div>

                <div class="card-body">
                    <form id="loadform" name="form" class="form-horizontal" method="POST" action="{{ url('filing_fetch') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row pt-1">
                            <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-2 pe-0">
                                        <label for="example-select" class="form-label">{{ transText('filter_by_lable') }}:</label>
                                        <select class="form-select" name="date_type" id="date_type">
                                            <option value="entry_date" selected>Entry Date</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-2 pe-0">
                                        <label for="example-select" class="form-label">{{ transText('from_date_lable') }}:</label>
                                        <div class="input-group">
                                            <input type="text" name="date_range_from" id="date_range_from" class="form-control" placeholder="" autocomplete="off">
                                            <span class="input-group-text" style="width: auto!important;"><i class="ti ti-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-2 pe-0">
                                        <label for="example-select" class="form-label">{{ transText('to_date_lable') }}:</label>
                                        <div class="input-group">
                                            <input type="text" name="date_range_to" id="date_range_to" class="form-control" placeholder="" autocomplete="off">
                                            <span class="input-group-text" style="width: auto!important;"><i class="ti ti-calendar"></i> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-5 col-md-5 col-lg-5 mb-2 pe-0">
                                        <label for="example-select" class="form-label">{{ transText('liner_lable') }}:</label>
                                        <select class="form-select" name="stock_filter_carrier_name" id="stock_filter_carrier_name" autocomplete="off">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-7 col-md-7 col-lg-7 mb-2 pe-0">
                                        <label for="example-fileinput" class="form-label"> {{ transText('keyword_lable') }}:</label>
                                        <input type="text" name="hbl_mbl" id="hbl_mbl" class="form-control uppercase-only" placeholder="HBL/MBL/PORT/VSL/VOY" autocomplete="off">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-5 mb-2">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-4 mb-2 pe-0">
                                        <label for="example-select" class="form-label">{{ transText('company_lable') }}:</label>
                                        <select class="form-select" name="stock_filter_b_unit" id="stock_filter_b_unit">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-4 mb-2 pe-0">
                                        <label for="example-select" class="form-label">{{ transText('status_lable') }}:</label>
                                        <select class="form-select" name="stock_status" id="stock_status">
                                            <option value="A">Active</option>
                                            <option value="D">Deleted</option>
                                            <option value="N">Canceled</option>
                                            <option value="All" selected="selected">All</option>
                                        </select>
                                    </div>
                                    
                                   <div class="col-sm-6 col-md-4 col-lg-4 mb-2 d-flex align-items-center" style="padding-top: 15px;">
                                        <button type="button" class="btn btn-success p-1 m-0 flex-fill me-1"> 
                                            <i class="fa-solid fa-file-excel" style="font-size: 14px;" title="Excel"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger p-1 ms-1 flex-fill me-1"> 
                                            <i class="fa-solid fa-file-pdf" style="font-size: 14px;" title="PDF"></i>
                                        </button>
                                        <button type="submit" class="btn btn-primary p-1 ms-1 flex-fill" id="loadDataBtn">
                                            {{ transText('load_btn') }}
                                        </button>
                                    </div>
                                </div>
                            </div>              
                        </div>
                    </form>

                    <div class="mb-2" id="hbl_content_div">
                        <div class="p-4 shadow rounded text-left" style="background: #FCFCFC; border: 1.5px solid var(--osen-topbar-bg, #ddd);">
                            <h5 class="text-muted mb-0">📄 {{ transText('data_load_msg') }}...!</h5>
                        </div>
                    </div>

                    <div class="table-responsive listTable">
                        <table class="table table-striped" style="display: none;">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10px;">-</th>
                                    <th style="width: 10px;">{{ transText('sn_th') }}</th>
                                    <th style="width: 100px;">MBL</th>
                                    <th style="width: 100px;">HBL/ENS BL</th>
                                    <th style="width: 40px;">-</th>
                                    <th style="width: 40px;">-</th>
                                    <th style="width: 120px;" title='EU MRN NO.'>EU MRN NO.</th>
                                    <th style="width: 50px;">STATUS</th>
                                    <th style="width: 50px;">DISPOSE</th>
                                    <th style="width: 20px;">EQ</th>
                                    <th style="width: 30px;">PKG</th>
                                    <th style="width: 40px;">KG</th>
                                    <th style="width: 50px;">CBM</th>
                                    <th style="width: 30px;">TO</th>
                                    <th style="width: 150px;">SHIPPER</th>
                                    <th style="width: 150px;">CONSIGNEE</th>
                                    <th style="width: 20px;">-</th>
                                    <th style="width: 20px;">{{ transText('action_th') }}</th>
                                </tr>
                            </thead>
                            <tbody id="dataBody">
                                <!-- Ajax data will be inserted here -->
                            </tbody>
                        </table>
                    </div>
             
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->



   
    <!-- The Modal -->
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel" style="font-weight: 750;"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form" name="form" class="form-horizontal" method="POST"
                        action="{{ url('ics_ens') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <input type="hidden" name="row_id" id="row_id">

                            <div class="table-responsive table-spacing">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="text-center border-bottom border-dashed">
                                            <td></td>
                                            <td></td>
                                            <td style="width: 20px"></td>
                                            <td></td>
                                            <td style="width: 78px;"></td>
                                            <td></td>
                                            <td style="width: 95px"></td>

                                            <th style="position: relative; text-align: center;">
                                                <span>{{ transText('shipper_buyer_title') }}</span>
                                            </th>

                                            <td style="width: 20px"></td>
                                            <th style="position: relative; text-align: center;">
                                                <span>{{ transText('consignee_seller_title') }}</span>
                                            </th>

                                            <td style="width: 20px"></td>
                                            <th style="position: relative; text-align: center;">
                                                <span>{{ transText('ultimate_notify_party_title') }}</span>
                                            </th>

                                        </tr>
                                        <tr class="text-center border-bottom border-dashed">
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('bill_label') }}</span>
                                                    <span style="margin: 0 2px;">:</span>
                                                </div>
                                            </th>
                                            <td style="width: 130px;">
                                                <select class="form-select" name="billing_id" id="billing_id" autocomplete="off"  style="margin-top: 2px; margin-bottom: 1px;" required>
                                                    <option value="">Loading...</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('pol_label') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>
                                            <!-- POL -->
                                            <td style="position: relative;">
                                                <input type="text" name="from_location" id="from_location" class="form-control uppercase-only" autocomplete="off" required style="margin-top: 2px; margin-bottom: 1px;">

                                                <div id="pol_suggestions_box" class="suggestions-box" style="width: 540px!important;    max-height: 210px!important;"></div>
                                                <div id="pol_loader" class="circle-dot-loader" style="display: none;">
                                                    <div></div><div></div><div></div><div></div>
                                                    <div></div><div></div><div></div><div></div>
                                                </div>                                                
                                            </td>

                                            <td style="width: 20px"></td>
                                            <th class="text-end">
                                                <span style="margin-right: 2px;">{{ transText('name_lable') }} :</span> 
                                            </th>
                                            <!-- SHIPPER -->
                                            <td>
                                                <div style="display: flex; align-items: center; position: relative;">
                                                    <div style="flex: 1; position: relative;">
                                                        <input type="text" name="shipper_name" id="shipper_name" class="form-control uppercase-only" placeholder="{{ transText('pno_placeholder') }}" required autocomplete="off">
                                                        
                                                        <div id="shipper_loader" class="circle-dot-loader" style="display: none;">
                                                            <div></div><div></div><div></div><div></div>
                                                            <div></div><div></div><div></div><div></div>
                                                        </div>
                                                        
                                                        <div id="shipper_suggestions_box" class="suggestions-box" style="display: none;"></div>
                                                    </div>

                                                    <button type="button" class="btn btn-primary open-second-modal" data-bs-target="#customerModal" style="margin-left: 4px;">
                                                        <i class="fa-solid fa-plus" style="font-size: 15px;"></i>
                                                    </button>
                                                </div>

                                                <small id="shipper_message" style="color: red;"></small>
                                            </td>

                                            <td style="width: 20px"></td>
                                            <!-- CONSIGNEE -->
                                            <td>
                                                <div style="display: flex; align-items: center; position: relative;">
                                                    <div style="flex: 1; position: relative;">
                                                        <input type="text" name="consignee_name" id="consignee_name" class="form-control uppercase-only" placeholder="{{ transText('pno_placeholder') }}" required autocomplete="off">
                                                        
                                                        <div id="consignee_loader" class="circle-dot-loader" style="display: none;">
                                                            <div></div><div></div><div></div><div></div>
                                                            <div></div><div></div><div></div><div></div>
                                                        </div>
                                                        
                                                        <div id="consignee_suggestions_box" class="suggestions-box" style="display: none;"></div>
                                                    </div>

                                                    <button type="button" class="btn btn-primary open-second-modal" data-bs-target="#customerModal" style="margin-left: 4px;">
                                                        <i class="fa-solid fa-plus" style="font-size: 15px;"></i>
                                                    </button>
                                                </div>

                                                <small id="consignee_message" style="color: red;"></small>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <!-- NOTIFY -->
                                            <td>
                                                <div style="display: flex; align-items: center; position: relative;">
                                                    <div style="flex: 1; position: relative;">
                                                        <input type="text" name="notify_name" id="notify_name" class="form-control uppercase-only" placeholder="{{ transText('pno_placeholder') }}" required autocomplete="off">
                                                        
                                                        <div id="notify_loader" class="circle-dot-loader" style="display: none;">
                                                            <div></div><div></div><div></div><div></div>
                                                            <div></div><div></div><div></div><div></div>
                                                        </div>
                                                        
                                                        <div id="notify_suggestions_box" class="suggestions-box" style="display: none;"></div>
                                                    </div>

                                                    <button type="button" class="btn btn-primary open-second-modal" data-bs-target="#customerModal" style="margin-left: 4px;">
                                                        <i class="fa-solid fa-plus" style="font-size: 15px;"></i>
                                                    </button>
                                                </div>

                                                <small id="notify_message" style="color: red;"></small>
                                            </td>
                                        </tr>
                                        <tr class="text-center border-bottom border-dashed">
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('hbl_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>
                                            <td>
                                                <input type="text" name="hbl_no" id="hbl_no" class="form-control" required autocomplete="off"  style="margin-top: 1px; margin-bottom: 1px;">
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('pod_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                 
                                            </th>

                                            <!-- POD -->
                                            <td style="position: relative;">
                                                <input type="text" name="to_location" id="to_location" class="form-control uppercase-only" autocomplete="off" required style="margin-top: 2px; margin-bottom: 1px;">

                                                <div id="pod_suggestions_box" class="suggestions-box" style="width: 540px!important;max-height: 210px!important;"></div>
                                                <div id="pod_loader" class="circle-dot-loader" style="display: none;">
                                                    <div></div><div></div><div></div><div></div>
                                                    <div></div><div></div><div></div><div></div>
                                                </div>                                                
                                            </td>


                                            <td style="width: 20px"></td>
                                            <th class="text-end">
                                                <span style="margin-right: 2px;">{{ transText('address_lable') }} :</span> 
                                            </th>
                                            <td>
                                                <input type="text" name="shipper_address" id="shipper_address" class="form-control"  autocomplete="off" required readonly>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                <input type="text" name="consignee_address" id="consignee_address" class="form-control"  autocomplete="off" required readonly>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                <input type="text" name="notify_address" id="notify_address" class="form-control"  autocomplete="off" required readonly>
                                            </td>
                                        </tr>
                                        <tr class="text-center border-bottom border-dashed">
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('eori_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>
                                            <td>
                                                <select class="form-select" name="nvocc_scac" id="nvocc_scac" autocomplete="off" required style="margin-top: 1px; margin-bottom: 1px;">
                                                    <option value="">Loading...</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('ts1_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>
                                            <td>
                                                <select class="form-select ts_one" name="ts_one" id="ts_one" autocomplete="off" style="margin-top: 1px; margin-bottom: 1px;">
                                                    <option value="">Loading...</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th class="text-end">
                                                <span style="margin-right: 2px;">{{ transText('country_city_lable') }} :</span> 
                                            </th>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <input type="text" name="shipper_country" id="shipper_country" class="form-control" placeholder="{{ transText('country_placeholder') }}" required autocomplete="off" readonly>
                                                    <input type="text" name="shipper_location" id="shipper_location" class="form-control" placeholder="{{ transText('city_placeholder') }}" required autocomplete="off" readonly>
                                                </div>
                                            </td>
                                            <td style="width: 20px"></td>  
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <input type="text" name="consignee_country" id="consignee_country" class="form-control" placeholder="{{ transText('country_placeholder') }}" required autocomplete="off" readonly>
                                                    <input type="text" name="consignee_location" id="consignee_location" class="form-control" placeholder="{{ transText('city_placeholder') }}" required autocomplete="off" readonly>
                                                </div>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <input type="text" name="notify_country" id="notify_country" class="form-control" placeholder="{{ transText('country_placeholder') }}" required autocomplete="off" readonly>
                                                    <input type="text" name="notify_location" id="notify_location" class="form-control" placeholder="{{ transText('city_placeholder') }}" required autocomplete="off" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="text-center border-bottom border-dashed">
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('mbl_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                <input type="text" name="mbl_no" id="mbl_no" class="form-control" autocomplete="off" required  style="margin-top: 1px; margin-bottom: 1px;">
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('ts2_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>
                                            
                                            <td>
                                                <select class="form-select ts_two" name="ts_two" id="ts_two" autocomplete="off">
                                                    <option value="">Loading...</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th class="text-end">
                                                <span style="margin-right: 2px;">{{ transText('phone_postal_lable') }} :</span> 
                                            </th>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <input type="text" name="shipper_phone" id="shipper_phone" class="form-control" placeholder="{{ transText('phone_placeholder') }}" required autocomplete="off" readonly>
                                                    <input type="text" name="shipper_zip_code" id="shipper_zip_code" class="form-control" placeholder="{{ transText('postal_zip_placeholder') }}" required autocomplete="off" readonly>
                                                </div>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <input type="text" name="consignee_phone" id="consignee_phone" class="form-control" placeholder="{{ transText('phone_placeholder') }}" required autocomplete="off" readonly>
                                                    <input type="text" name="consignee_zip_code" id="consignee_zip_code" class="form-control" placeholder="{{ transText('postal_zip_placeholder') }}" required autocomplete="off" readonly>
                                                </div>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <input type="text" name="notify_phone" id="notify_phone" class="form-control" placeholder="{{ transText('phone_placeholder') }}" required autocomplete="off" readonly>
                                                    <input type="text" name="notify_zip_code" id="notify_zip_code" class="form-control" placeholder="{{ transText('postal_zip_placeholder') }}" required autocomplete="off" readonly>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="text-center border-bottom border-dashed">
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('eori_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>
                                            <td>
                                                <select class="form-select" name="carrier_scac" id="carrier_scac" autocomplete="off" required style="margin-top: 1px; margin-bottom: 1px;">
                                                    <option value="">Loading...</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('ts3_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>
                                            <td>
                                                <select class="form-select ts_three" name="ts_three" id="ts_three" autocomplete="off">
                                                    <option value="">Loading...</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th class="text-end">
                                                <span style="margin-right: 2px;">{{ transText('email_lable') }} :</span> 
                                            </th>
                                            <td>
                                                 <input type="text" name="shipper_email" id="shipper_email" class="form-control" placeholder="{{ transText('email_placeholder') }}" autocomplete="off">
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                <input type="text" name="consignee_email" id="consignee_email" class="form-control" placeholder="{{ transText('email_placeholder') }}" autocomplete="off">
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                <input type="text" name="notify_email" id="notify_email" class="form-control" placeholder="{{ transText('email_placeholder') }}" autocomplete="off">
                                            </td>
                                        </tr>
                                        <tr class="text-center border-bottom border-dashed">
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                                    <span>{{ transText('i_ex_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>
                                            <td>
                                                <select class="form-select" name="import_export" id="import_export" autocomplete="off" required style="margin-top: 1px; margin-bottom: 2px;">
                                                    <option value='' selected></option>
                                                    <option value='IMPORT'>IMP to EU/N.IRELAND/NORWAY/SWITZERLAND</option>
                                                    <option value='EXPORT'>EXP from EU/N.IRELAND/NORWAY/SWITZERLAND</option>
                                                    <option value='FROB'>FROB To EU/N.IRELAND/NORWAY/SWITZERLAND</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th>
                                                <div style="display: flex; justify-content: space-between; align-items: center; height: 100%; white-space: nowrap;">
                                                    <span>{{ transText('pp_c_lable') }}</span>
                                                    <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                                </div>                                                
                                            </th>

                                            <td>
                                                <select class="form-select" name="incoterm" id="incoterm" autocomplete="off" required style="margin-top: 1px; margin-bottom: 2px;">
                                                    <option value=""></option>
                                                    <option value="A">Prepaid</option>
                                                    <option value="Z">Collect</option>
                                                </select>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <th class="text-end">
                                                <span style="margin-right: 2px;">{{ transText('lic_bin_eori_lable') }} :</span> 
                                            </th>
                                            <td>
                                                 <input type="text" name="shipper_registration" id="shipper_registration" class="form-control" placeholder="{{ transText('license_placeholder') }}" autocomplete="off" style="margin-top: 1px; margin-bottom: 2px;">
                                                        
                                                <input type="hidden" name="shipper_code" id="shipper_code"  autocomplete="off">
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                 <input type="text" name="consignee_registration" id="consignee_registration" class="form-control" placeholder="{{ transText('license_placeholder') }}" autocomplete="off" style="margin-top: 1px; margin-bottom: 2px;">
                                                        
                                                <input type="hidden" name="consignee_code" id="consignee_code"  autocomplete="off">
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td>
                                                <input type="text" name="notify_registration" id="notify_registration" class="form-control" placeholder="{{ transText('license_placeholder') }}" autocomplete="off" style="margin-top: 1px; margin-bottom: 2px;">
                                                
                                                <input type="hidden" name="notify_code" id="notify_code"  autocomplete="off">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Container Table --}}
                        <div class="row">
                            <div class="table-container mt-1">
                                <table class="table table-bordered table-striped" id="containerTable">
                                    <thead class="table-header">
                                        <tr class="text-center align-middle">
                                            <th style="width: 20px;">{{ transText('sn_th') }}</th>
                                            <th style="width: 100px;">{{ transText('container_th') }}</th>
                                            <th style="width: 55px;">{{ transText('size_th') }}</th>
                                            <th style="width: 108px;">{{ transText('seal_th') }}</th>
                                            <th style="width: 57px;">{{ transText('qty_th') }}</th>
                                            <th style="width: 82px;">{{ transText('pkg_th') }}</th>
                                            <th style="width: 60px;">{{ transText('kg_th') }}</th>
                                            <th style="width: 57px;">{{ transText('cbm_th') }}</th>
                                            <th style="width: 65px;">{{ transText('hs_code_th') }}</th>
                                            <th style="width: 50px;">{{ transText('un_dg_th') }}</th>
                                            <th style="width: 130px;">{{ transText('marks_th') }}</th>
                                            <th>{{ transText('clear_description_th') }}</th>
                                            <th style="width: 25px;" title="{{ transText('save_title') }}">-</th>
                                            <th style="width: 25px;" title="{{ transText('copy_title') }}">-</th>
                                            <th style="width: 30px;">
                                                <button type="button" id="addRowBtn" class="btn btn-primary p-0" style="border-radius: 0; margin: 2px;">
                                                    <i class="fa-solid fa-plus" title="{{ transText('add_title') }}" style="font-size: 12px; margin: 5px;"></i>
                                                </button>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="table-body-scroll">
                                    <table class="table table-bordered table-striped" id="containerTableBody">
                                        <tbody id="containerTbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-end col-sm-offset-2 col-sm-12 mt-2">
                                <button type="button" class="btn btn-success ins_modal_close" id="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    {{ transText('close_btn') }}
                                </button>
                                <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- The Modal End-->





    <!-- Customer Modal Start -->
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog"> <!-- এখানে modal-sm দিয়ে ছোট মডাল -->
            <div class="modal-content custom-modal-content">
                <div class="modal-body">
                    <!-- আপনার মডালের কন্টেন্ট এখানে দিবেন -->
                    <form id="customer_form" name="form" class="form-horizontal" method="POST"
                        action="{{ url('customer_address') }}" enctype="multipart/form-data">
                        @csrf()

                            <div class="table-responsive border border-2 rounded">
                                <table class="table table-borderless mt-1">
                                    <tbody class="mx-2">
                                        <tr class="border-bottom border-dashed">
                                            <th>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="margin-left: 10px;">{{ transText('name_lable') }}</span>
                                                    <span style="margin-right: 10px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                <input type="text" name="customer_full_name" id="customer_full_name" class="form-control" placeholder="{{ transText('pno_placeholder') }}" required autocomplete="off" style="margin-bottom: 4px;">
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>
                                        <tr class="border-bottom border-dashed">
                                            <th>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="margin-left: 10px;">{{ transText('country_placeholder') }}</span>
                                                    <span style="margin-right: 10px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                <select class="form-select" name="customerAddressCountry" id="customerAddressCountry" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                                    <option value="">Loading...</option>
                                                </select>
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>

                                        <tr class="border-bottom border-dashed">
                                            <th>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="margin-left: 10px;">{{ transText('city_placeholder') }}</span>
                                                    <span style="margin-right: 10px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                <select class="form-select" name="address_city" id="address_city" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                                    <option value=""></option>
                                                </select>
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>

                                        <tr class="border-bottom border-dashed">
                                            <th>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="margin-left: 10px;">{{ transText('postal_zip_placeholder') }}</span>
                                                    <span style="margin-right: 10px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                 <input type="text" name="address_zip" id="address_zip" class="form-control" placeholder="{{ transText('postal_zip_placeholder') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>

                                        <tr class="border-bottom border-dashed">
                                            <th>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="margin-left: 10px;">{{ transText('address_lable') }}</span>
                                                    <span style="margin-right: 10px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                <input type="text" name="customerAddress" id="customerAddress" class="form-control" placeholder="{{ transText('address_lable') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>

                                        <tr class="border-bottom border-dashed">
                                            <th>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="margin-left: 10px;">{{ transText('lic_bin_eori_lable') }}</span>
                                                    <span style="margin-right: 10px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                <input type="text" name="customer_address_bin_number" id="customer_address_bin_number" class="form-control" placeholder="{{ transText('license_placeholder') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>

                                        <tr class="border-bottom border-dashed">
                                            <th>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="margin-left: 10px;">{{ transText('phone_placeholder') }}</span>
                                                    <span style="margin-right: 10px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                 <input type="text" name="customerAddressPhone" id="customerAddressPhone" class="form-control" placeholder="{{ transText('phone_placeholder') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>

                                        <tr class="border-bottom border-dashed">
                                            <th>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="margin-left: 10px;">{{ transText('email_lable') }}</span>
                                                    <span style="margin-right: 10px;">:</span>
                                                </div>
                                            </th>
                                            <td>
                                                <input type="email" name="customerAddressEmail" id="customerAddressEmail" class="form-control" placeholder="{{ transText('email_placeholder') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="text-end col-sm-offset-2 col-sm-12 my-1 px-1">
                                    <button type="button" class="btn btn-success" id="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        {{ transText('close_btn') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="saveBtn">SAVE</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer Modal Start -->
@endsection

@section('script')
    <script>
        const urls = @json($urlData);

        $(document).ready(function () {
            $('#customer_form').on('submit', function (e) {
                e.preventDefault();

                $('.is-invalid').removeClass('is-invalid'); // পুরানো error class clear

                let formData = new FormData(this); // 'this' মানে form DOM

                $.ajax({
                    type: "POST",
                    url: "{{ url('customer_address') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        
                        if (response.status === 'success') {
                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                timer: 1000,
                                showConfirmButton: true
                            });

                            $('#customerModal').modal('hide'); // মডাল বন্ধ
                            $('#customer_form')[0].reset(); // ফর্ম রিসেট

                            // যদি কোনো টেবিল বা ডেটা রিফ্রেশ করতে চান
                            // loadCustomerList();
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMsg = "Please correct the following errors:\n\n";
                            $.each(errors, function (key, value) {
                                errorMsg += `- ${value[0]}\n`;
                                $(`#${key}`).addClass('is-invalid');
                            });
                            alert(errorMsg);
                        } else {
                            alert("An unexpected error occurred.");
                        }
                    }
                });
            });
        });
    </script>

   <script>
        $(document).ready(function () {
            // Initialize Bootstrap Modal
            const customerModal = new bootstrap.Modal(document.getElementById('customerModal'), {
                backdrop: 'static',
                keyboard: false
            });

            // Open modal when button clicked
            $(document).on('click', '.open-second-modal', function (e) {
                e.preventDefault();
                customerModal.show();

                // Optional: Adjust z-index if multiple modals used
                setTimeout(() => {
                    const $backdrops = $('.modal-backdrop');
                    if ($backdrops.length > 1) {
                        $backdrops.eq(1).css('z-index', '1055');
                    }
                }, 200);
            });

            // Reset form on modal close (by close button or clicking backdrop)
            $('#customerModal').on('hidden.bs.modal', function () {
                $('#customer_form')[0].reset(); // Reset all inputs
                $('#customerAddressCountry').val('').change(); // Reset select
                $('#address_city').val('').change();
            });

            // Optional: Also reset when "Close" button clicked
            $('#close').click(function () {
                $('#customer_form')[0].reset();
                $('#customerAddressCountry').val('').change();
                $('#address_city').val('').change();
            });
        });
    </script>

@endsection
