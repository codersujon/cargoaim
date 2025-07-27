 <!-- Tab Contents -->
 <div class="tab-content" id="tab-2">
     <div class="tab-content-wrapper">
         {{-- tab content header --}}
         <div class="tab-content-header">
             <h4>@yield('title') Shipment Booking Form</h4>
         </div>

         {{-- tab content body --}}
         <div class="tab-content-body">

             <form id="form" name="form" class="form-horizontal" method="POST" action="{{ url('ics_ens') }}"
                 enctype="multipart/form-data">
                 @csrf()
                 <div class="row">
                     <input type="hidden" name="row_id" id="row_id">

                     <div class="table-responsive table-spacing">
                         <table class="table">
                             <tbody>
                                 <tr class="tabs_form_row">
                                     {{-- bkg --}}
                                     <th>
                                         <div class="tabs_form_label">
                                             <span>BKG</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="bkg" id="bkg" class="form-control uppercase"
                                             autocomplete="off" required>
                                     </td>

                                     {{-- mbl --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>{{ transText('mbl_lable') }}</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="mbl_no" id="mbl_no" class="form-control"
                                             autocomplete="off" required>
                                     </td>
                                     {{-- ref --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>REF</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="ref" id="ref" class="form-control uppercase-only"
                                             autocomplete="off" required>
                                     </td>
                                 </tr>

                                 <tr class="tabs_form_row">

                                     {{-- IMP/EXP --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>IMP/EXP</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="imp_exp" id="imp_exp" autocomplete="off"
                                             required>
                                             <option value="">Loading...</option>
                                         </select>
                                     </td>

                                     {{-- Load Type --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>LOAD.T</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="load_type" id="load_type" autocomplete="off"
                                             required>
                                             <option value="">Loading...</option>
                                         </select>
                                     </td>

                                     {{-- Business Owner --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>BO</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="bus_own" id="bus_own" autocomplete="off"
                                             required>
                                             <option value="">--Business Owner--</option>
                                             <option value="">Loading...</option>
                                         </select>
                                     </td>


                                     {{-- INCOTERM --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>INCOTERM</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="incoterm" id="incoterm" autocomplete="off"
                                             required>
                                             <option value="">Loading...</option>
                                         </select>
                                     </td>


                                     {{-- BUSINESS UNIT --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>B.UNIT</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="bus_unit" id="bus_unit" autocomplete="off"
                                             required>
                                             <option value="">Loading...</option>
                                         </select>
                                     </td>


                                 </tr>

                                 <tr class="tabs_form_row">
                                     <!-- POR -->
                                     <th>
                                         <div class="tabs_label">
                                             <span>POR</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td style="position: relative;">
                                         <input type="text" name="port_of_receipt" id="port_of_receipt"
                                             class="form-control uppercase-only" autocomplete="off"
                                             placeholder="Port of Receipt" required>
                                     </td>

                                     {{-- pic --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>PIC</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="bus_unit" id="bus_unit" disabled
                                             autocomplete="off" required>
                                             <option value="">PIC</option>
                                         </select>
                                     </td>
                                 </tr>

                                 <tr class="tabs_form_row">
                                     <!-- POL -->
                                     <th>
                                         <div class="tabs_label">
                                             <span>POL</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td style="position: relative;">
                                         <input type="text" name="port_of_loading" id="port_of_loading"
                                             class="form-control uppercase-only" autocomplete="off"
                                             placeholder="Port of Loading" required>
                                     </td>

                                     {{-- pic --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>PIC</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="bus_unit" id="bus_unit" disabled
                                             autocomplete="off" required>
                                             <option value="">PIC</option>
                                         </select>
                                     </td>

                                 </tr>

                                 <tr class="tabs_form_row">
                                     <!-- POD -->
                                     <th>
                                         <div class="tabs_label">
                                             <span>{{ transText('pod_lable') }}</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td style="position: relative;">
                                         <input type="text" name="to_location" id="to_location"
                                             class="form-control uppercase-only" autocomplete="off"
                                             placeholder="Port of Discharge" required>
                                     </td>

                                     {{-- pic --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>PIC</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="bus_unit" id="bus_unit" disabled
                                             autocomplete="off" required>
                                             <option value="">PIC</option>
                                         </select>
                                     </td>
                                 </tr>

                                 <tr class="tabs_form_row">
                                     <!-- DEL -->
                                     <th>
                                         <div class="tabs_label">
                                             <span>DEL</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td style="position: relative;">
                                         <input type="text" name="delivery_location" id="delivery_location"
                                             class="form-control uppercase-only" autocomplete="off"
                                             placeholder="Delivery Location" required>
                                     </td>


                                     {{-- pic --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>PIC</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="bus_unit" id="bus_unit" disabled
                                             autocomplete="off" required>
                                             <option value="">PIC</option>
                                         </select>
                                     </td>
                                 </tr>

                                 <tr class="tabs_form_row">
                                     {{-- carr-1 --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>Carr-1</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td style="position: relative;">
                                         <select class="form-select" name="voc_carr_1" id="voc_carr_1"
                                             autocomplete="off" required>
                                             <option value="">Loading...</option>
                                         </select>
                                     </td>

                                     {{-- carr-2 --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>Carr-2</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td style="position: relative;">
                                         <select class="form-select" name="voc_carr_2" id="voc_carr_2"
                                             autocomplete="off" required>
                                             <option value="">Loading...</option>
                                         </select>
                                     </td>

                                     {{-- carr-3 --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>Carr-3</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td style="position: relative;">
                                         <select class="form-select" name="voc_carr_3" id="voc_carr_3"
                                             autocomplete="off" required>
                                             <option value="">Loading...</option>
                                         </select>
                                     </td>

                                 </tr>

                                 <tr class="tabs_form_row">
                                     {{-- Contact Customer --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>Contact Cust</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="contact_cust" id="contact_cust"
                                             class="form-control uppercase-only" autocomplete="off" required
                                             placeholder="Contact Customer">
                                     </td>
                                     <td>
                                         <select class="form-select" name="voc_carr_3" id="voc_carr_3"
                                             autocomplete="off" required>
                                             <option value="">PIC LIST</option>
                                         </select>
                                     </td>

                                 </tr>

                                 <tr class="tabs_form_row">
                                     {{-- Shipper --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>Shipper</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="contact_cust" id="contact_cust"
                                             class="form-control uppercase-only" autocomplete="off" required
                                             placeholder="Shipper">
                                     </td>
                                 </tr>

                                 <tr class="tabs_form_row">
                                     {{-- consignee --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>Consignee</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="contact_cust" id="contact_cust"
                                             class="form-control uppercase-only" autocomplete="off" required
                                             placeholder="Consignee">
                                     </td>
                                 </tr>

                                 <tr class="tabs_form_row">
                                     {{-- 3rd Party Pay --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>3rd Party Pay</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="3rd_party_pay" id="3rd_party_pay"
                                             class="form-control uppercase-only" autocomplete="off" required
                                             placeholder="3rd Party Pay">
                                     </td>
                                 </tr>

                                 <tr class="tabs_form_row">
                                     {{-- More Party Pay --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>More Party Pay</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="More_party_pay" id="More_party_pay"
                                             class="form-control uppercase-only" autocomplete="off" required
                                             placeholder="More Party Pay">
                                     </td>
                                 </tr>

                                 <tr>
                                     {{-- Off Dock --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>OFF-DOCK</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <input type="text" name="off_dock" id="off_dock"
                                             class="form-control uppercase-only" autocomplete="off" required
                                             placeholder="Off-Dock">
                                     </td>

                                     {{-- SALES PIC --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>SALES</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="sales_pic" id="sales_pic" autocomplete="off"
                                             required>
                                             <option value="">PIC LIST</option>
                                         </select>
                                     </td>

                                     {{-- SALES PIC --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>CS</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="cs_pic" id="cs_pic" autocomplete="off"
                                             required>
                                             <option value="">PIC LIST</option>
                                         </select>
                                     </td>

                                     {{-- REF PIC --}}
                                     <th>
                                         <div class="tabs_label">
                                             <span>REF</span>
                                             <span>:</span>
                                         </div>
                                     </th>
                                     <td>
                                         <select class="form-select" name="ref_pic" id="ref_pic" autocomplete="off"
                                             required>
                                             <option value="">PIC LIST</option>
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

             <!-- Group -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:account-group" class="fs-20 align-middle"></iconify-icon>
             </button>

             <!-- Fire -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:fire" class="fs-20 align-middle"></iconify-icon>
             </button>

             <!-- Share -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:share-variant" class="fs-20 align-middle"></iconify-icon>
             </button>

             <!-- Calendar -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:calendar-month" class="fs-20 align-middle"></iconify-icon>
             </button>

             <!-- Cancel -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:cancel" class="align-middle"></iconify-icon>
                 Cancel
             </button>

             <!-- Hold -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:pause-circle" class="align-middle"></iconify-icon>
                 Hold
             </button>

             <!-- Complete -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:check-circle" class="align-middle"></iconify-icon>
                 Complete
             </button>

             <!-- Clear Form -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:broom" class="align-middle"></iconify-icon>
                 Clear Form
             </button>

             <!-- Confirm BKG -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:clipboard-check" class="align-middle"></iconify-icon>
                 Confirm BKG
             </button>

             <!-- Send -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:send" class="align-middle"></iconify-icon>
                 Send
             </button>

             <!-- Save -->
             <button type="submit" class="btn btn-primary bg-gradient d-flex align-items-center gap-1">
                 <iconify-icon icon="mdi:content-save" class="align-middle"></iconify-icon>
                 Save
             </button>


         </div>
     </div>
 </div>
