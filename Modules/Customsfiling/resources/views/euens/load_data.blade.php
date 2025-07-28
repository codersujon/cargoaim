<div class="row">
    <div class="ics_ens_display">
        <div class="card ics2_ens_card">
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
                    <table class="table table-striped" style="display: none;">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 10px;">-</th>
                                <th class="p-3 m-3" style="width: 10px;">{{ transText('sn_th') }}</th>
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
                                <th style="width: 20px;">-</th>
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





