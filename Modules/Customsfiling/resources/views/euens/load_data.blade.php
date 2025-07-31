
<style>
    .listTable {
        overflow-x: auto !important;
        overflow-y: auto !important;
        position: relative;
        height: auto !important;
        max-width: 100%;
    }

    .list_table {
        border-collapse: collapse;
        width: max-content;
        min-width: 100%;
        table-layout: fixed;
    }

    .list_table th,
    .list_table td {
        white-space: nowrap;
        text-align: center;
        vertical-align: middle;
        border: 1px dashed #eac9f9;
        font-size: 14px;
    }

    .list_table th {
        padding: 5px 0px !important;
    }

    /* Sticky top row */
    .list_table thead th {
        position: sticky;
        top: 0;
    }
    .list_table thead th.sticky-col-0,
    .list_table thead th.sticky-col-1,
    .list_table thead th.sticky-col-2,
    .list_table thead th.sticky-col-3,
    .list_table thead th.sticky-col-4,
    .list_table thead th.sticky-col-5,
    .list_table thead th.sticky-col-last-2,
    .list_table thead th.sticky-col-last-1 {
        z-index: 50;
        background: #f0d4f8 !important;
        color: #1b1c1c !important;
    }

    .list_table tbody td.sticky-col-0,
    .list_table tbody td.sticky-col-1,
    .list_table tbody td.sticky-col-2,
    .list_table tbody td.sticky-col-3,
    .list_table tbody td.sticky-col-4,
    .list_table tbody td.sticky-col-5,
    .list_table tbody td.sticky-col-last-2,
    .list_table tbody td.sticky-col-last-1 {
        z-index: 50;
        background: #fff !important;
        color: #1b1c1c !important;
    }



    /* ✅ Sticky First 6 Columns */
    .sticky-col-0 { position: sticky; left: 0px; z-index: 21; }
    .sticky-col-1 { position: sticky; left: 42px; z-index: 20; }
    .sticky-col-2 { position: sticky; left: 85px; z-index: 19; }
    .sticky-col-3 { position: sticky; left: 221px; z-index: 18; }
    .sticky-col-4 { position: sticky; left: 359px; z-index: 17; }
    .sticky-col-5 { position: sticky; left: 400px; z-index: 16; }

    /* ✅ Sticky Last 2 Columns (right side) */
    .sticky-col-last-2 { position: sticky; right: 40px; z-index: 21; }
    .sticky-col-last-1 { position: sticky; right: 0px; z-index: 20; }

    /* Scrollbar styles */
    .listTable::-webkit-scrollbar {
        height: 10px;
    }
    .listTable::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .listTable::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
    }
    .listTable::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>




<div class="global_container_settings">
    <div class="card global_settings">
        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0" style="font-weight: 550;">{{ transText('ens_ch') }}</h4>
            <button type="button" class="btn btn-primary ms-1" id="createNew1">
                {{ transText('new_hbl_file_btn') }}
            </button>
        </div>

        <div class="card-body">
            <form id="loadform" name="form" class="form-horizontal" method="POST" action="{{ url('filing_fetch') }}" enctype="multipart/form-data">
                @csrf()
                <div class="row pt-1">
                    <div class="col-sm-12 col-md-12 col-lg-4 mb-1">
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4 mb-1 pe-0">
                                <label for="example-select" class="form-label">{{ transText('filter_by_lable') }}:</label>
                                <select class="form-select" name="date_type" id="date_type">
                                    <option value="entry_date" selected>Entry Date</option>
                                </select>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 mb-1 pe-0">
                                <label for="example-select" class="form-label">{{ transText('from_date_lable') }}:</label>
                                <div class="input-group">
                                    <input type="text" name="date_range_from" id="date_range_from" class="form-control" placeholder="" autocomplete="off">
                                    <span class="input-group-text" style="width: auto!important;"><i class="ti ti-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 mb-1 pe-0">
                                <label for="example-select" class="form-label">{{ transText('to_date_lable') }}:</label>
                                <div class="input-group">
                                    <input type="text" name="date_range_to" id="date_range_to" class="form-control" placeholder="" autocomplete="off">
                                    <span class="input-group-text" style="width: auto!important;"><i class="ti ti-calendar"></i> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-3 mb-1">
                        <div class="row">
                            <div class="col-sm-5 col-md-5 col-lg-5 mb-1 pe-0">
                                <label for="example-select" class="form-label">{{ transText('liner_lable') }}:</label>
                                <select class="form-select" name="stock_filter_carrier_name" id="stock_filter_carrier_name" autocomplete="off">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7 mb-1 pe-0">
                                <label for="example-fileinput" class="form-label"> {{ transText('keyword_lable') }}:</label>
                                <input type="text" name="hbl_mbl" id="hbl_mbl" class="form-control uppercase-only" placeholder="HBL/MBL/PORT/VSL/VOY" autocomplete="off">
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-12 col-lg-5 mb-1">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-1 pe-0">
                                <label for="example-select" class="form-label">{{ transText('company_lable') }}:</label>
                                <select class="form-select" name="stock_filter_b_unit" id="stock_filter_b_unit">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-1 pe-0">
                                <label for="example-select" class="form-label">{{ transText('status_lable') }}:</label>
                                <select class="form-select" name="stock_status" id="stock_status">
                                    <option value="A">Active</option>
                                    <option value="D">Deleted</option>
                                    <option value="N">Canceled</option>
                                    <option value="All" selected="selected">All</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-1 d-flex align-items-center" style="padding-top: 15px;">
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

            <div class="mb-0" id="hbl_content_div">
                <div class="p-4 shadow rounded text-left" style="background: #FCFCFC; border: 1.5px solid #d9d9d9; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
                    <h5 class="text-muted mb-0">📄 {{ transText('data_load_msg') }}...!</h5>
                </div>
            </div>

            
            <div class="table-responsive listTable">
                <table class="table table-striped list_table" style="display: none;">
                    <thead class="text-center">
                        <tr>
                            <th class="sticky sticky-col-0" style="width: 42px;">-</th>
                            <th class="sticky sticky-col-1 p-3 m-3" style="width: 43px;">{{ transText('sn_th') }}</th>
                            <th class="sticky sticky-col-2" style="width: 136px;">MBL</th>
                            <th class="sticky sticky-col-3" style="width: 138px;">HBL/ENS BL</th>
                            <th class="sticky sticky-col-4" style="width: 41px;">-</th>
                            <th class="sticky sticky-col-5" style="width: 42px;">-</th>
                            <th style="width: 120px;" title='EU MRN NO.'>EU MRN NO.</th>
                            <th style="width: 90px;">STATUS</th>
                            <th style="width: 90px;">DISPOSE</th>
                            <th style="width: 40px;">EQ</th>
                            <th style="width: 40px;">PKG</th>
                            <th style="width: 40px;">KG</th>
                            <th style="width: 50px;">CBM</th>
                            <th style="width: 90px;">TO</th>
                            <th style="width: 400px;">SHIPPER</th>
                            <th style="width: 400px;">CONSIGNEE</th>
                            <th class="sticky-col-last-2" style="width: 40px;">-</th>
                            <th class="sticky-col-last-1" style="width: 40px;">-</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody">
                        <!-- Ajax data will be inserted here -->
                    </tbody>
                </table>
            </div>
        
        </div><!-- end card-body -->
    </div><!-- end card -->
    <!-- end col -->
</div>
<!-- end row -->





