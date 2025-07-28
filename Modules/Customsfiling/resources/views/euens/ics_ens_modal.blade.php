    <!-- The Modal -->
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel" style="font-weight: 500;"></h4>
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

                                                <div id="pol_suggestions_box" class="suggestions-box" style="width:540px; max-height: 210px; left: 37.29%; display: none;"></div>
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
                                                        
                                                        <div id="consignee_suggestions_box" class="suggestions-box" style="left: 61%;display: none;"></div>
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
                                                        
                                                        <div id="notify_suggestions_box" class="suggestions-box" style="left: 62.45%;display: none;"></div>
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

                                                <div id="pod_suggestions_box" class="suggestions-box" style="width:540px; max-height: 210px; left: 37.29%; top: 190px; display: none;"></div>
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
