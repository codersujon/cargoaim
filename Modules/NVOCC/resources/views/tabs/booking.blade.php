 <!-- Tab Contents -->
 <div class="tab-content" id="tab-2">
     <div class="tab-content-wrapper">
         {{-- tab content header --}}
         <div class="tab-content-header">
             <h4>Shipment Booking Form</h4>
         </div>

         {{-- tab content body --}}
         <div class="tab-content-body">

             <form id="form" name="form" class="form-horizontal" method="POST" action="{{ url('ics_ens') }}"
                 enctype="multipart/form-data">
                 @csrf()
                 <div class="row">
                     <input type="hidden" name="row_id" id="row_id">

                     <div class="table-responsive table-spacing">
                         <table class="table table-borderless">
                             <tbody>

                                <tr class="text-center border-bottom border-dashed">
                                    {{-- bkg --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>BKG</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <input type="text" name="bkg" id="bkg" class="form-control uppercase-only"
                                            autocomplete="off" required style="margin-top: 2px; margin-bottom: 1px;">
                                    </td>
                                    <td style="width: 20px"></td>

                                    {{-- mbl --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>{{ transText('mbl_lable') }}</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td>
                                        <input type="text" name="mbl_no" id="mbl_no" class="form-control"
                                            autocomplete="off" required style="margin-top: 1px; margin-bottom: 1px;">
                                    </td>
                                    <td style="width: 20px"></td>
                                    {{-- ref --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>REF</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <input type="text" name="ref" id="ref" class="form-control uppercase-only"
                                            autocomplete="off" required style="margin-top: 2px; margin-bottom: 1px;">
                                    </td>
                                    <td style="width: 20px"></td>

                                </tr>

                                <tr class="text-center border-bottom border-dashed">

                                    {{-- IMP/EXP --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>IMP/EXP</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="imp_exp" id="imp_exp" autocomplete="off"
                                            style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">Loading...</option>
                                        </select>
                                    </td>
                                    <td style="width: 20px"></td>

                                    {{-- Load Type --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>LOAD.T</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="load_type" id="load_type" autocomplete="off"
                                            style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">Loading...</option>
                                        </select>
                                    </td>
                                    <td style="width: 20px"></td>
                                    {{-- Business Owner --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>BO</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="bus_own" id="bus_own" autocomplete="off"
                                            style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">--Business Owner--</option>
                                            <option value="">Loading...</option>
                                        </select>
                                    </td>
                                    <td style="width: 20px"></td>

                                    {{-- INCOTERM --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>INCOTERM</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="incoterm" id="incoterm" autocomplete="off"
                                            style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">Loading...</option>
                                        </select>
                                    </td>
                                    <td style="width: 20px"></td>

                                    {{-- BUSINESS UNIT --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>B.UNIT</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="bus_unit" id="bus_unit" autocomplete="off"
                                            style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">Loading...</option>
                                        </select>
                                    </td>
                                    <td style="width: 20px"></td>
                                </tr>

                                <tr class="text-center border-bottom border-dashed">
                                    <!-- POR -->
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>POR</span>
                                            <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="position: relative;">
                                        <input type="text" name="port_of_receipt" id="port_of_receipt"
                                            class="form-control uppercase-only" autocomplete="off"
                                            placeholder="Port of Receipt" required
                                            style="margin-top: 2px; margin-bottom: 1px;">

                                        <div id="pod_suggestions_box" class="suggestions-box"
                                            style="width: 540px!important;max-height: 210px!important;"></div>
                                        <div id="pod_loader" class="circle-dot-loader" style="display: none;">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </td>
                                    <td style="width: 20px"></td>

                                    {{-- pic --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>PIC</span>
                                            <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="bus_unit" id="bus_unit" disabled
                                            autocomplete="off" style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">PIC</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr class="text-center border-bottom border-dashed">
                                    <!-- POL -->
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>POL</span>
                                            <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="position: relative;">
                                        <input type="text" name="port_of_loading" id="port_of_loading"
                                            class="form-control uppercase-only" autocomplete="off"
                                            placeholder="Port of Loading" required
                                            style="margin-top: 2px; margin-bottom: 1px;">

                                        <div id="pod_suggestions_box" class="suggestions-box"
                                            style="width: 540px!important;max-height: 210px!important;"></div>
                                        <div id="pod_loader" class="circle-dot-loader" style="display: none;">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </td>
                                    <td style="width: 20px"></td>

                                    {{-- pic --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>PIC</span>
                                            <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="bus_unit" id="bus_unit" disabled
                                            autocomplete="off" style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">PIC</option>
                                        </select>
                                    </td>

                                </tr>

                                <tr class="text-center border-bottom border-dashed">
                                    <!-- POD -->
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>{{ transText('pod_lable') }}</span>
                                            <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="position: relative;">
                                        <input type="text" name="to_location" id="to_location"
                                            class="form-control uppercase-only" autocomplete="off"
                                            placeholder="Port of Discharge" required
                                            style="margin-top: 2px; margin-bottom: 1px;">

                                        <div id="pod_suggestions_box" class="suggestions-box"
                                            style="width: 540px!important;max-height: 210px!important;"></div>
                                        <div id="pod_loader" class="circle-dot-loader" style="display: none;">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </td>
                                    <td style="width: 20px"></td>

                                    {{-- pic --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>PIC</span>
                                            <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="bus_unit" id="bus_unit" disabled
                                            autocomplete="off" style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">PIC</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr class="text-center border-bottom border-dashed">
                                    <!-- DEL -->
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>DEL</span>
                                            <span style="margin: 0 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="position: relative;">
                                        <input type="text" name="delivery_location" id="delivery_location"
                                            class="form-control uppercase-only" autocomplete="off"
                                            placeholder="Delivery Location" required
                                            style="margin-top: 2px; margin-bottom: 1px;">

                                        <div id="pod_suggestions_box" class="suggestions-box"
                                            style="width: 540px!important;max-height: 210px!important;"></div>
                                        <div id="pod_loader" class="circle-dot-loader" style="display: none;">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </td>
                                    <td style="width: 20px"></td>

                                    {{-- pic --}}
                                    <th>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <span>PIC</span>
                                            <span style="margin-left: 2px; margin-right: 2px;">:</span>
                                        </div>
                                    </th>
                                    <td style="width: 130px;">
                                        <select class="form-select" name="bus_unit" id="bus_unit" disabled
                                            autocomplete="off" style="margin-top: 2px; margin-bottom: 1px;" required>
                                            <option value="">PIC</option>
                                        </select>
                                    </td>
                                </tr>

                             </tbody>
                         </table>
                     </div>
                 </div>
             </form>

         </div>

         {{-- tab content bottom --}}
         <div class="tab-content-bottom">

             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:cancel" class="fs-22 align-middle"></iconify-icon>
                 Cancel
             </button>

             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:pause-circle" class="fs-22 align-middle"></iconify-icon>
                 Hold
             </button>

             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:check-circle" class="fs-22 align-middle"></iconify-icon>
                 Complete
             </button>

             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:broom" class="fs-22 align-middle"></iconify-icon>
                 Clear Form
             </button>

             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:clipboard-check" class="fs-22 align-middle"></iconify-icon>
                 Confirm BKG
             </button>

             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:send" class="fs-22 align-middle"></iconify-icon>
                 Send
             </button>

             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:content-save" class="fs-22 align-middle"></iconify-icon>
                 Save
             </button>

         </div>
     </div>
 </div>
