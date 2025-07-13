<?php

namespace Modules\Customsfiling\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customsfiling\Models\CustomsFiling;
use Modules\Customsfiling\Models\CustomsFilingEqDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;

class IcsEnsController extends Controller
{
    public function index()
    {
         return view('customsfiling::euens.ics2_ens');
    }

    
    public function create(){}

    public function filingFetch(Request $request)
    {
        $data = $request->all();
        $date_from = Carbon::createFromFormat('d-m-Y', $data['date_range_from'])->format('Y-m-d');
        $date_to = Carbon::createFromFormat('d-m-Y', $data['date_range_to'])->format('Y-m-d');

        $filingFetchData = DB::table('customs_filing')
            ->select(
                'row_id',
                'hbl_no',
                'mbl_no',
                'ultimate_hbl_no as filing_t_ultimate_hbl_no',
                'ens_disposition_code',
                'status',
                'shipper_name',
                'consignee_name',
                'entry_date'
            )
            ->where(function($query) use ($date_from, $date_to) {
                $query->whereBetween(DB::raw("STR_TO_DATE(entry_date, '%Y-%m-%d')"), [$date_from, $date_to])
                    ->orWhereBetween(DB::raw("STR_TO_DATE(entry_date, '%d-%m-%Y')"), [$date_from, $date_to]);
            })
            ->orderBy('customs_filing.row_id','desc')
            ->get();

        return response()->json($filingFetchData);
    }

    public function store(Request $request)
    {
        $customMessages = [
            'billing_id.required' => 'The Company field is required.',
            'hbl_no.required' => 'The Ultimate HBL field is required.',
            'nvocc_scac.required' => 'The HBL Filler EORI field is required.',
            'mbl_no.required' => 'The Carrier MBL field is required.',
            'carrier_scac.required' => 'The Carrier EORI field is required.',
            'import_export.required' => 'The IM/EX/FROB field is required.',
            'from_location.required' => 'The Port of Loading field is required.',
            'to_location.required' => 'The Port of Discharge field is required.',
            'incoterm.required' => 'The HBL Prepaid/Collect field is required.',

            'shipper_name.required' => 'The Shipper Name field is required.',
            'shipper_address.required' => 'The Shipper Address field is required.',
            'shipper_country.required' => 'The Shipper Country field is required.',
            'shipper_location.required' => 'The Shipper Location field is required.',
            'shipper_phone.required' => 'The Shipper Phone field is required.',
            'shipper_zip_code.required' => 'The Shipper Postal/Zip field is required.',
            'shipper_code.required' => 'The Shipper Code field is required.',

            'consignee_name.required' => 'The Consignee Name field is required.',
            'consignee_address.required' => 'The Consignee Address field is required.',
            'consignee_country.required' => 'The Consignee Country field is required.',
            'consignee_location.required' => 'The Consignee Location field is required.',
            'consignee_phone.required' => 'The Consignee Phone field is required.',
            'consignee_zip_code.required' => 'The Consignee Postal/Zip field is required.',
            'consignee_code.required' => 'The Consignee Code field is required.',

            'notify_name.required' => 'The Notify Name field is required.',
            'notify_address.required' => 'The Notify Address field is required.',
            'notify_country.required' => 'The Notify Country field is required.',
            'notify_location.required' => 'The Notify Location field is required.',
            'notify_phone.required' => 'The Notify Phone field is required.',
            'notify_zip_code.required' => 'The Notify Postal/Zip field is required.',
            'notify_code.required' => 'The Notify Code field is required.',
        ];

        $validated = $request->validate([
            'billing_id' => 'required|string',
            'hbl_no' => 'required|string',
            'nvocc_scac' => 'required|string',
            'mbl_no' => 'required|string',
            'carrier_scac' => 'required|string',
            'import_export' => 'required|string',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'incoterm' => 'required|string',
            'shipper_name' => 'required|string',
            'shipper_address' => 'required|string',
            'shipper_country' => 'required|string',
            'shipper_location' => 'required|string',
            'shipper_phone' => 'required|string',
            'shipper_zip_code' => 'required|string',
            'shipper_code' => 'required|string',

            'consignee_name' => 'required|string',
            'consignee_address' => 'required|string',
            'consignee_country' => 'required|string',
            'consignee_location' => 'required|string',
            'consignee_phone' => 'required|string',
            'consignee_zip_code' => 'required|string',
            'consignee_code' => 'required|string',

            'notify_name' => 'required|string',
            'notify_address' => 'required|string',
            'notify_country' => 'required|string',
            'notify_location' => 'required|string',
            'notify_phone' => 'required|string',
            'notify_zip_code' => 'required|string',
            'notify_code' => 'required|string',

            'inv_no' => 'nullable|string',
            'inv_per_cycle_mbl' => 'nullable|string',
            'cargoaim_inv_amount' => ['nullable', 'decimal:3', 'max:999.999'],
            'cargoaim_inv_currency' => 'nullable|string',
            'cargoaim_inv_roe' => ['nullable', 'decimal:3', 'max:999.999'],
            'business_unit' => 'nullable|string',
            'bkg_no' => 'nullable|string',
            'ultimate_hbl_no' => 'nullable|string',
            'hbl_type' => 'nullable|string',
            'mbl_type' => 'nullable|string',
            'filing_type' => 'nullable|string',
            'original_hbl_no' => 'nullable|string',
            'original_mbl_no' => 'nullable|string',
            'actual_pol_etd_hbl' => 'nullable|date',
            'actual_pod_eta_hbl' => 'nullable|date',
            'vsl_name' => 'nullable|string',
            'vsl_voyage' => 'nullable|string',
            'lloyed_no' => 'nullable|string',
            'vsl_call_sign' => 'nullable|string',
            'vsl_register_country' => 'nullable|string',
            'vsl_route_start_port' => 'nullable|string',
            'pol_for_us' => 'nullable|string',
            'pol_for_us_date' => 'nullable|date',
            'last_foreign_port' => 'nullable|string',
            'first_us_port' => 'nullable|string',
            'first_us_port_eta' => 'nullable|string',
            'seller_code' => 'nullable|string',
            'seller_name' => 'nullable|string',
            'seller_address' => 'nullable|string',
            'seller_location' => 'nullable|string',
            'seller_zip_code' => 'nullable|string',
            'seller_country' => 'nullable|string',
            'seller_phone' => 'nullable|string',
            'seller_email' => 'nullable|string',
            'seller_registration' => 'nullable|string',
            'buyer_code' => 'nullable|string',
            'buyer_name' => 'nullable|string',
            'buyer_address' => 'nullable|string',
            'buyer_location' => 'nullable|string',
            'buyer_zip_code' => 'nullable|string',
            'buyer_country' => 'nullable|string',
            'buyer_phone' => 'nullable|string',
            'buyer_email' => 'nullable|string',
            'buyer_registration' => 'nullable|string',
            'vsl_cutoms_office_code' => 'nullable|integer',
            'hbl_cutoms_office_code' => 'nullable|string',
            'hbl_shipping_bill_reg_serial' => 'nullable|string',
            'hbl_shipping_bill_date' => 'nullable|string',
            'mbl_ams_last_status' => 'nullable|string',
            'hbl_ams_last_status' => 'nullable|string',
            'isf_last_status' => 'nullable|string',
            'last_update_date' => 'nullable|date',
            'first_ams_submit_by' => 'nullable|string',
            'first_ams_submit_date' => 'nullable|date',
            'filing_channel' => 'nullable|string',
            'ams_reference_no' => 'nullable|string',
            'submission_status' => 'nullable|string',
            'version' => 'nullable|integer',
            'status' => 'nullable|string',
            'ens_status_code' => 'nullable|string',
            'ens_disposition_code' => 'nullable|string',
            'ens_mrn_no' => 'nullable|string',
            'eu_lrn_no' => 'nullable|string',
            'notification_email' => 'nullable|string',
            'notification_mobile' => 'nullable|string',
            'entry_by' => 'nullable|string',
            'entry_date' => 'nullable|date',
            'update_by' => 'nullable|string',
            'update_date' => 'nullable|date',
            'delete_by' => 'nullable|string',
            'delete_date' => 'nullable|date',
            'case_close' => 'nullable|string',
            'case_close_by' => 'nullable|string',
            'case_close_date' => 'nullable|date',


        ], $customMessages);

        $validated['ultimate_hbl_no'] = $validated['hbl_no'];
        $validated['hbl_type'] = 'OBL';
        $validated['mbl_type'] = 'OBL';
        $validated['filing_type'] = 'EUENS';
        $validated['original_hbl_no'] = $validated['hbl_no'];
        $validated['original_mbl_no'] = $validated['mbl_no'];
        $validated['entry_by'] = 'admin.demo';
        $validated['entry_date'] = now();
        $validated['soft_cust_id'] = 'FILING';
        $validated['partition_id'] = 1130;
        $validated['version'] = 1;

        $validated['inv_no'] = '';
        $validated['inv_per_cycle_mbl'] = '';
        $validated['cargoaim_inv_amount'] = 0.0;
        $validated['cargoaim_inv_currency'] = '';
        $validated['cargoaim_inv_roe'] = 0.0;
        $validated['business_unit'] = '';
        $validated['bkg_no'] = '';
        $validated['hbl_shipping_bill_no'] = '';
        $validated['actual_pol_etd_hbl'] = '0000-00-00 00:00:00';
        $validated['actual_pod_eta_hbl'] = '0000-00-00 00:00:00';
        $validated['vsl_name'] = '';
        $validated['vsl_voyage'] = '';
        $validated['lloyed_no'] = '';
        $validated['vsl_call_sign'] = '';
        $validated['vsl_register_country'] = '';
        $validated['vsl_route_start_port'] = '';
        $validated['pol_for_us'] = '';
        $validated['pol_for_us_date'] = '0000-00-00 00:00:00';
        $validated['last_foreign_port'] = '';
        $validated['first_us_port'] = '';
        $validated['first_us_port_eta'] = '0000-00-00 00:00:00';
        $validated['seller_code'] = '';
        $validated['seller_name'] = '';
        $validated['seller_address'] = '';
        $validated['seller_location'] = '';
        $validated['seller_zip_code'] = '';
        $validated['seller_country'] = '';
        $validated['seller_phone'] = '';
        $validated['seller_email'] = '';
        $validated['seller_registration'] = '';
        $validated['buyer_code'] = '';
        $validated['buyer_name'] = '';
        $validated['buyer_address'] = '';
        $validated['buyer_location'] = '';
        $validated['buyer_zip_code'] = '';
        $validated['buyer_country'] = '';
        $validated['buyer_phone'] = '';
        $validated['buyer_email'] = '';
        $validated['buyer_registration'] = '';
        $validated['vsl_cutoms_office_code'] = 0;
        $validated['hbl_cutoms_office_code'] = '';
        $validated['hbl_shipping_bill_reg_serial'] = '';
        $validated['hbl_shipping_bill_date'] = '0000-00-00 00:00:00';
        $validated['mbl_ams_last_status'] = '';
        $validated['hbl_ams_last_status'] = '';
        $validated['isf_last_status'] = '';
        $validated['last_update_date'] = '0000-00-00 00:00:00';
        $validated['first_ams_submit_by'] = '';
        $validated['first_ams_submit_date'] = '0000-00-00 00:00:00';
        $validated['filing_channel'] = '';
        $validated['ams_reference_no'] = '';
        $validated['submission_status'] = '';
        $validated['ens_status_code'] = '';
        $validated['ens_disposition_code'] = '';
        $validated['ens_mrn_no'] = '';
        $validated['eu_lrn_no'] = '';
        $validated['notification_email'] = '';
        $validated['notification_mobile'] = '';
        $validated['update_by'] = '0000-00-00 00:00:00';
        $validated['update_date'] = '0000-00-00 00:00:00';
        $validated['delete_by'] = '';
        $validated['delete_date'] = '0000-00-00 00:00:00';
        $validated['case_close'] = '';
        $validated['case_close_by'] = '';
        $validated['case_close_date'] = '0000-00-00 00:00:00';


        $validated['shipper_email'] = $request->input('shipper_email') ?? '';
        $validated['consignee_email'] = $request->input('consignee_email') ?? '';
        $validated['notify_email'] = $request->input('notify_email') ?? '';

        $validated['shipper_registration'] = $request->input('shipper_registration') ?? '';
        $validated['consignee_registration'] = $request->input('consignee_registration') ?? '';
        $validated['notify_registration'] = $request->input('notify_registration') ?? '';

        $validated['ts_one'] = $request->input('ts_one') ?? '';
        $validated['ts_two'] = $request->input('ts_two') ?? '';
        $validated['ts_three'] = $request->input('ts_three') ?? '';

        
        $data = CustomsFiling::updateOrCreate(
            ['row_id' => $request->row_id],
            $validated
        );

        // Step 1: Validate container_no inputs
        $request->validate([
            'container_no.*' => 'required|string|max:11',
            'size_iso.*' => 'required|string',
            'seal_no.*' => 'required|string',
            'pkg_qty.*' => 'required|integer',
            'pkg_type.*' => 'required|string',
            'weight_kg.*' => 'required|integer',
            'cbm.*' => 'required|integer',
            'hs_code.*' => 'required|integer',
            'un_code_dg.*' => 'nullable|integer',
            'cargo_marks.*' => 'required|string',
            'cargo_description.*' => 'required|string',
        ], [
            'container_no.*.max' => 'Each container number must not exceed 11 characters.',
        ]);

        // ✅ Then insert container rows (if available)
        if ($request->has('container_no')) {
            foreach ($request->container_no as $index => $container_no) {
                if (!$container_no) continue; // skip if empty

                CustomsFilingEqDetails::create([
                    'soft_cust_id' => 'FILING',
                    'partition_id' => 1124,
                    'business_unit' => '',
                    'bkg_no' => '',
                    'hbl_no' => $validated['hbl_no'],
                    'ultimate_hbl_no' => $validated['hbl_no'],
                    'mbl_no' => $validated['mbl_no'],
                    'container_no' => $container_no,
                    'size_iso' => $request->size_iso[$index],
                    'seal_no' => $request->seal_no[$index],
                    'pkg_qty' => $request->pkg_qty[$index],
                    'pkg_type' => $request->pkg_type[$index],
                    'weight_kg' => $request->weight_kg[$index],
                    'cbm' => $request->cbm[$index],
                    'hs_code' => $request->hs_code[$index],
                    'un_code_dg' => $request->un_code_dg[$index] ?? '',
                    'cargo_marks' => $request->cargo_marks[$index],
                    'cargo_description' => $request->cargo_description[$index],
                    'version' => 1,
                    'status' => 'A',
                    'entry_by' => 'admin.filing',
                    'entry_date' => now(),
                    'update_by' => '',
                    'update_date' => '0000-00-00 00:00:00',
                    'delete_by' => '',
                    'delete_date' => '0000-00-00 00:00:00',
                ]);
            }
        }

        $message = $request->row_id != 0 ? 'Updated successfully!' : 'Inserted successfully!';

        return response()->json(['success' => true, 'message' => $message, 'data' => $data]);
    }


    public function show($id){}

    public function edit($id)
    {
        $data = CustomsFiling::where('row_id', $id)->first();

        $detailsData = CustomsFilingEqDetails::where('soft_cust_id', $data->soft_cust_id)
            ->select(
                'row_id as row_id_eqd',
                'container_no',
                'size_iso',
                'seal_no',
                'pkg_qty',
                'pkg_type',
                'weight_kg',
                'cbm',
                'hs_code',
                'un_code_dg',
                'cargo_marks',
                'cargo_description',
            )
            ->where('hbl_no', $data->hbl_no)
            ->where('mbl_no', $data->mbl_no)
            ->where('status', 'A')
            ->where('version', $data->version)
            ->get();

        // Collection কে array তে কনভার্ট করুন
        $detailsArray = $detailsData->toArray();

        return response()->json([
            'main' => $data,
            'details' => $detailsArray,
        ]);
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
