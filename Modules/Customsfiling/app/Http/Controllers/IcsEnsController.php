<?php

namespace Modules\Customsfiling\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customsfiling\Models\CustomsFiling;
use Modules\Customsfiling\Models\CustomsFilingEqDetails;
use Modules\Core\Models\CarrierBasic;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IcsEnsController extends Controller
{
    public function index()
    {
        return view('customsfiling::euens.ics2_ens');
    }

    public function create(){}

    public function liner()
    {
        $user = Auth::guard('web')->user();
        $userID = $user->userId;
        $softCustID = $user->soft_cust_id;

        $carriers = CarrierBasic::where('soft_cust_id', $softCustID)
            ->where('carrierCode', '!=', 'DUM')
            ->where('carrierType', '2')
            ->orderByRaw("
                CASE
                    WHEN carrierCodeNick IS NULL OR carrierCodeNick = ''
                    THEN carrierName
                    ELSE CONCAT(carrierCodeNick, '-', carrierName)
                END ASC
            ")
            ->select(
                'carrierCode',
                'carrierCodeNick',
                'carrierName',
                DB::raw("
                    CASE
                        WHEN carrierCodeNick IS NULL OR carrierCodeNick = ''
                        THEN carrierName
                        ELSE CONCAT(carrierCodeNick, '-', carrierName)
                    END as full_name
                ")
            )
            ->get();

        return response()->json($carriers);
    }


    // public function liner()
    // {
    //     $user = Auth::guard('web')->user();
    //     $userID = $user->userId;
    //     $softCustID = $user->soft_cust_id;

    //     $carriers = CarrierBasic::when($userID != 'admin.filing', function ($query) use ($softCustID) {
    //             $query->where('soft_cust_id', $softCustID);
    //         })
    //         ->where('carrierCode', '!=', 'DUM')
    //         ->where('carrierType', '2')
    //         ->orderByRaw("
    //             CASE
    //                 WHEN carrierCodeNick IS NULL OR carrierCodeNick = ''
    //                 THEN carrierName
    //                 ELSE CONCAT(carrierCodeNick, '-', carrierName)
    //             END
    //         ")
    //         ->select(
    //             'carrierCode',
    //             'carrierCodeNick',
    //             'carrierName',
    //             DB::raw("
    //                 CASE
    //                     WHEN carrierCodeNick IS NULL OR carrierCodeNick = ''
    //                     THEN carrierName
    //                     ELSE CONCAT(carrierCodeNick, '-', carrierName)
    //                 END as full_name
    //             ")
    //         )
    //         ->get();

    //     return response()->json($carriers);
    // }



    public function filingFetch(Request $request)
    {
        $user = Auth::guard('web')->user();
        $userID = $user->userId;
        $softCustID = $user->soft_cust_id;
        $billing_id = $user->billing_id;

        $data = $request->all();
        $hbl_mbl = $data['hbl_mbl'] ?? '';
        $bkg_no = $data['bkg_no'] ?? '';
        $date_type = $data['date_type'] ?? 'entry_date';
        $liner = $data['stock_filter_carrier_name'] ?? '';
        $requested_b_unit = $data['stock_filter_b_unit'] ?? '';
        $open_close = $data['open_close'] ?? '';
        $stock_status = $data['stock_status'] ?? '';

        $date_from = Carbon::createFromFormat('d-m-Y', $data['date_range_from'])->format('Y-m-d');
        $date_to = Carbon::createFromFormat('d-m-Y', $data['date_range_to'])->format('Y-m-d');

        $query = DB::table('customs_filing')
            ->select(
                'row_id',
                'soft_cust_id',
                'business_unit',
                'bkg_no as bkg_no_got',
                'bkg_no as bkg_no_got',
                'hbl_no as hbl_no_got',
                'ultimate_hbl_no',
                'mbl_no',
                'version',
                'hbl_type',
                'mbl_type',
                'carrier_scac',
                'nvocc_scac',
                'from_location',
                'to_location',
                'shipper_name',
                'consignee_name',
                'case_close',
                'ams_reference_no',
                'hbl_ams_last_status',
                'import_export',
                'status',
                'pol_for_us_date',
                DB::raw("DATE_FORMAT(first_us_port_eta, '%Y-%m-%d') as first_us_port_eta"),
                'ts_one',
                'ts_two',
                'ts_three',
                'ens_status_code',
                'ens_disposition_code',
                'ens_mrn_no',
                'cargoaim_inv_amount',
                'eu_lrn_no',

                // ✅ Subqueries
                DB::raw("(SELECT COUNT(DISTINCT bkg_bl_cont_no)
                        FROM bkg_bl_container_details_t
                        WHERE soft_cust_id = customs_filing.soft_cust_id
                            AND bkg_bl_hbl_no = customs_filing.hbl_no
                            AND bkg_bl_bkg_no = customs_filing.bkg_no
                        LIMIT 1) as cont_count"),

                DB::raw("(SELECT 
                            CASE 
                                WHEN status_code = 'ACK_FAILURE' THEN UPPER(status_details_text)
                                WHEN status_code IN ('AWAITING', 'ACK_WAITING') THEN 'WAITING'
                                ELSE 'OK'
                            END
                        FROM customs_filing_status_history
                        WHERE soft_cust_id = customs_filing.soft_cust_id
                            AND hbl_no = customs_filing.hbl_no
                            AND ultimate_hbl_no = customs_filing.ultimate_hbl_no
                            AND status_type IN ('ACK_STATUS', 'UPDATE_SENT', 'SUMBITTED')
                        ORDER BY update_date_time DESC LIMIT 1) as fmc_status"),

                DB::raw("(SELECT response_details
                        FROM customs_filing_status_history
                        WHERE soft_cust_id = customs_filing.soft_cust_id
                            AND hbl_no = customs_filing.hbl_no
                            AND ultimate_hbl_no = customs_filing.ultimate_hbl_no
                            AND response_details != ''
                        ORDER BY row_id DESC LIMIT 1) as response_details"),

                DB::raw("IFNULL((
                        SELECT SUM(pkg_qty)
                        FROM customs_filing_eq_details
                        WHERE soft_cust_id = customs_filing.soft_cust_id
                            AND status = customs_filing.status
                            AND bkg_no = customs_filing.bkg_no
                            AND hbl_no = customs_filing.hbl_no
                            AND ultimate_hbl_no = customs_filing.ultimate_hbl_no
                            AND version = customs_filing.version
                        ), 0) as pky_qty"),

                DB::raw("IFNULL((
                        SELECT SUM(weight_kg)
                        FROM customs_filing_eq_details
                        WHERE soft_cust_id = customs_filing.soft_cust_id
                            AND status = customs_filing.status
                            AND bkg_no = customs_filing.bkg_no
                            AND hbl_no = customs_filing.hbl_no
                            AND ultimate_hbl_no = customs_filing.ultimate_hbl_no
                            AND version = customs_filing.version
                        ), 0) as weight_kg"),

                DB::raw("IFNULL((
                        SELECT SUM(cbm)
                        FROM customs_filing_eq_details
                        WHERE soft_cust_id = customs_filing.soft_cust_id
                            AND status = customs_filing.status
                            AND bkg_no = customs_filing.bkg_no
                            AND hbl_no = customs_filing.hbl_no
                            AND ultimate_hbl_no = customs_filing.ultimate_hbl_no
                            AND version = customs_filing.version
                        ), 0) as cbm"),

                DB::raw("IFNULL((
                        SELECT COUNT(DISTINCT container_no)
                        FROM customs_filing_eq_details
                        WHERE soft_cust_id = customs_filing.soft_cust_id
                            AND status = customs_filing.status
                            AND bkg_no = customs_filing.bkg_no
                            AND hbl_no = customs_filing.hbl_no
                            AND ultimate_hbl_no = customs_filing.ultimate_hbl_no
                            AND version = customs_filing.version
                        ), 0) as eq_qty")
            )
            ->when($userID !== 'admin.filing', function ($query) use ($softCustID) {
                $query->where('customs_filing.soft_cust_id', $softCustID);
            })
            ->where(function ($query) use ($requested_b_unit) {
                $query->where('business_unit', 'like', "%$requested_b_unit%");
            })
            ->where(function ($query) use ($bkg_no) {
                $query->where('bkg_no', 'like', "%$bkg_no%");
            })
            ->where(function ($query) use ($open_close) {
                $query->where('case_close', 'like', "%$open_close%");
            })
            ->when(!empty($liner), function ($query) use ($liner) {
                $query->where('carrier_scac', 'like', "%$liner%");
            })
            ->when(!empty($hbl_mbl), function ($query) use ($hbl_mbl) {
                $query->where(function ($q) use ($hbl_mbl) {
                    $q->where('hbl_no', 'like', "%$hbl_mbl%")
                    ->orWhere('mbl_no', 'like', "%$hbl_mbl%");
                });
            })
            ->where(function ($query) use ($date_type, $date_from, $date_to) {
                $query->whereBetween(DB::raw("DATE($date_type)"), [$date_from, $date_to]);
            })
            ->whereIn('status', ['A', 'N'])
            ->where('filing_type', 'EUENS')
            ->orderByDesc('entry_date')
            ->get();

        return response()->json($query);
    }




    // public function filingFetch(Request $request)
    // {
    //     $user = Auth::guard('web')->user();
    //     $userID = $user->userId;
    //     $softCustID = $user->soft_cust_id;
        
    //     $data = $request->all();
    //     $date_from = Carbon::createFromFormat('d-m-Y', $data['date_range_from'])->format('Y-m-d');
    //     $date_to = Carbon::createFromFormat('d-m-Y', $data['date_range_to'])->format('Y-m-d');

    //     $filingFetchData = DB::table('customs_filing')
    //         ->select(
    //             'row_id',
    //             'hbl_no',
    //             'mbl_no',
    //             'ultimate_hbl_no as filing_t_ultimate_hbl_no',
    //             'ens_disposition_code',
    //             'status',
    //             'shipper_name',
    //             'consignee_name',
    //             'entry_date'
    //         )
    //         ->when($userID !== 'admin.filing', function ($query) use ($userID, $softCustID) {
    //             $query->where('soft_cust_id', $softCustID);
    //         })
    //         ->where(function($query) use ($date_from, $date_to) {
    //             $query->whereBetween(DB::raw("STR_TO_DATE(entry_date, '%Y-%m-%d')"), [$date_from, $date_to])
    //                 ->orWhereBetween(DB::raw("STR_TO_DATE(entry_date, '%d-%m-%Y')"), [$date_from, $date_to]);
    //         })
    //         ->orderBy('customs_filing.row_id', 'desc')
    //         ->get();

    //     return response()->json($filingFetchData);
    // }



    public function store(Request $request)
    {
        $user = Auth::guard('web')->user();

        return DB::transaction(function () use ($request, $user) {
            // ✅ Validation error messages
            $messages = [
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

            // ✅ Sanitize input values (your existing $request->merge([...]) part)
             $request->merge([
                'hbl_no' => substr(preg_replace('/[^0-9a-zA-Z\-_.\/]/', '', $request->hbl_no), 0, 50),
                'nvocc_scac'       => substr(preg_replace('/[^0-9a-zA-Z.\- ]/', '', $request->nvocc_scac), 0, 50),
                'mbl_no'           => substr(preg_replace('/[^0-9a-zA-Z\-_.\/]/', '', $request->mbl_no), 0, 50),
                'carrier_scac'     => substr(preg_replace('/[^0-9a-zA-Z.\- ]/', '', $request->carrier_scac), 0, 50),
                'from_location'    => strtoupper(preg_replace('/[^A-Z]/', '', strtoupper($request->from_location))),
                'to_location'      => strtoupper(preg_replace('/[^A-Z]/', '', strtoupper($request->to_location))),
                
                'shipper_name'     => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->shipper_name)), 0, 69),
                'shipper_address'  => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->shipper_address)), 0, 69),
                'shipper_location' => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->shipper_location)), 0, 69),
                'shipper_phone'    => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->shipper_phone), 0, 50),
                'shipper_zip_code' => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->shipper_zip_code), 0, 50),
                'shipper_email'    => substr(preg_replace('/[^0-9.@a-zA-Z\-_\/]/', '', $request->shipper_email), 0, 50),

                'consignee_name'     => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->consignee_name)), 0, 69),
                'consignee_address'  => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->consignee_address)), 0, 69),
                'shipper_location' => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->shipper_location)), 0, 69),
                'consignee_phone'    => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->consignee_phone), 0, 50),
                'consignee_zip_code' => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->consignee_zip_code), 0, 50),
                'consignee_email'    => substr(preg_replace('/[^0-9.@a-zA-Z\-_\/]/', '', $request->consignee_email), 0, 50),

                'notify_name'     => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->notify_name)), 0, 69),
                'notify_address'  => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->notify_address)), 0, 69),
                'notify_location' => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->notify_location)), 0, 69),
                'notify_phone'    => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->notify_phone), 0, 50),
                'notify_zip_code' => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->notify_zip_code), 0, 50),
                'notify_email'    => substr(preg_replace('/[^0-9.@a-zA-Z\-_\/]/', '', $request->notify_email), 0, 50),
            ]);

            // ✅ Main field validation (same as before)
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
                'shipper_email' => 'nullable|string|email',
                'shipper_code' => 'required|string',
                'consignee_name' => 'required|string',
                'consignee_address' => 'required|string',
                'consignee_country' => 'required|string',
                'consignee_location' => 'required|string',
                'consignee_phone' => 'required|string',
                'consignee_zip_code' => 'required|string',
                'consignee_email' => 'nullable|string|email',
                'consignee_code' => 'required|string',
                'notify_name' => 'required|string',
                'notify_address' => 'required|string',
                'notify_country' => 'required|string',
                'notify_location' => 'required|string',
                'notify_phone' => 'required|string',
                'notify_zip_code' => 'required|string',
                'notify_email' => 'nullable|string|email',
                'notify_code' => 'required|string',
            ], $messages);

            // ✅ Add default and optional fields
            $validated += [
                'billing_id' => $user->billing_id,
                'ultimate_hbl_no' => $validated['hbl_no'],
                // 'business_unit' => $validated['hbl_no'],
                'hbl_type' => 'OBL',
                'mbl_type' => 'OBL',
                'filing_type' => 'EUENS',
                'original_hbl_no' => $validated['hbl_no'],
                'original_mbl_no' => $validated['mbl_no'],
                'entry_by' => $user->userId,
                'entry_date' => Carbon::now($user->user_time_zone)->format('Y-m-d H:i:s'),
                'soft_cust_id' => $user->soft_cust_id,
                'partition_id' => $user->partition_id,
                'cargoaim_inv_amount' => 0.000,
                'cargoaim_inv_roe' => 0.000,
                'vsl_cutoms_office_code' => 0.000,
            ];

            // ✅ Optional nullable fields
            $nullableFields = [ /* your previous list of nullable fields */ ];
            foreach ($nullableFields as $field) {
                $validated[$field] = $request->input($field, '');
            }

            // ✅ Optional date fields
            $dateFields = [ /* your date fields list */ ];
            foreach ($dateFields as $field) {
                $validated[$field] = $request->input($field, '0000-00-00 00:00:00');
            }

            // ✅ Insert or Update CustomsFiling
            $data = CustomsFiling::updateOrCreate(
                ['row_id' => $request->row_id],
                $validated
            );

            // ✅ Sanitize & validate container inputs (merge part)
            $request->merge([
                'container_no' => collect($request->input('container_no', []))->map(fn($item) => preg_replace('/[^0-9.a-zA-Z_\/-]/', '', $item))->toArray(),
                'seal_no' => collect($request->input('seal_no', []))->map(fn($item) => preg_replace('/[^0-9.a-zA-Z_\/-]/', '', $item))->toArray(),
                'pkg_qty' => collect($request->input('pkg_qty', []))->map(fn($item) => preg_replace('/[^0-9]/', '', $item))->toArray(),
                'weight_kg' => collect($request->input('weight_kg', []))->map(fn($item) => preg_replace('/[^0-9]/', '', $item))->toArray(),
                'cbm' => collect($request->input('cbm', []))->map(fn($item) => preg_replace('/[^0-9]/', '', $item))->toArray(),
                'hs_code' => collect($request->input('hs_code', []))->map(fn($item) => preg_replace('/[^0-9]/', '', $item))->toArray(),

                'cargo_marks' => collect($request->input('cargo_marks', []))
                    ->map(function($item) {
                        $item = str_replace(['#', '&'], ['NO', 'AND'], $item);
                        $item = preg_replace('/[^0-9. %a-zA-Z_\/-]/', '', $item);
                        return substr($item, 0, 178);
                    })->toArray(),

                'cargo_description' => collect($request->input('cargo_description', []))
                    ->map(function($item) {
                        $item = str_replace(['#', '&'], ['NO', 'AND'], $item);
                        $item = preg_replace('/[^0-9. %a-zA-Z_\/-]/', '', $item);
                        return substr($item, 0, 510);
                    })->toArray(),
            ]);

            // ✅ Validate container array fields
            $request->validate([
                'container_no.*' => 'required|string|size:11',
                'size_iso.*' => 'required|string',
                'seal_no.*' => 'required|string',
                'pkg_qty.*' => 'required|integer',
                'pkg_type.*' => 'required|string',
                'weight_kg.*' => 'required|integer',
                'cbm.*' => 'required|integer',
                'hs_code.*' => 'required|integer',
                'cargo_marks.*' => 'required|string',
                'cargo_description.*' => 'required|string',
            ]);

            // ✅ Insert container rows
            foreach ($request->container_no as $i => $no) {
                if (!$no) continue;

                CustomsFilingEqDetails::create([
                    'soft_cust_id' => $validated['soft_cust_id'],
                    'partition_id' => $validated['partition_id'],
                    'bkg_no' => '',
                    'hbl_no' => $validated['hbl_no'],
                    'ultimate_hbl_no' => $validated['ultimate_hbl_no'],
                    'mbl_no' => $validated['mbl_no'],
                    'container_no' => $no,
                    'size_iso' => $request->size_iso[$i],
                    'seal_no' => $request->seal_no[$i],
                    'pkg_qty' => $request->pkg_qty[$i],
                    'pkg_type' => $request->pkg_type[$i],
                    'weight_kg' => $request->weight_kg[$i],
                    'cbm' => $request->cbm[$i],
                    'hs_code' => $request->hs_code[$i],
                    'cargo_marks' => $request->cargo_marks[$i],
                    'cargo_description' => $request->cargo_description[$i],
                    'version' => 1,
                    'status' => 'A',
                    'entry_by' => $user->userId,
                    'entry_date' => Carbon::now($user->user_time_zone)->format('Y-m-d H:i:s'),
                    'update_by' => '',
                    'update_date' => '0000-00-00 00:00:00',
                    'delete_by' => '',
                    'delete_date' => '0000-00-00 00:00:00',
                ]);
            }

            $message = $request->row_id != 0 ? transText('f_upd_msg') :  transText('f_ins_msg');

            // ✅ All done, transaction will be committed
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ]);
        });
    }


    // public function store(Request $request)
    // {
    //     $user = Auth::guard('web')->user();

    //     // 🔹 Custom error messages
    //     $messages = [
    //         'billing_id.required' => 'The Company field is required.',
    //         'hbl_no.required' => 'The Ultimate HBL field is required.',
    //         'nvocc_scac.required' => 'The HBL Filler EORI field is required.',
    //         'mbl_no.required' => 'The Carrier MBL field is required.',
    //         'carrier_scac.required' => 'The Carrier EORI field is required.',
    //         'import_export.required' => 'The IM/EX/FROB field is required.',
    //         'from_location.required' => 'The Port of Loading field is required.',
    //         'to_location.required' => 'The Port of Discharge field is required.',
    //         'incoterm.required' => 'The HBL Prepaid/Collect field is required.',
    //         'shipper_name.required' => 'The Shipper Name field is required.',
    //         'shipper_address.required' => 'The Shipper Address field is required.',
    //         'shipper_country.required' => 'The Shipper Country field is required.',
    //         'shipper_location.required' => 'The Shipper Location field is required.',
    //         'shipper_phone.required' => 'The Shipper Phone field is required.',
    //         'shipper_zip_code.required' => 'The Shipper Postal/Zip field is required.',
    //         'shipper_code.required' => 'The Shipper Code field is required.',
    //         'consignee_name.required' => 'The Consignee Name field is required.',
    //         'consignee_address.required' => 'The Consignee Address field is required.',
    //         'consignee_country.required' => 'The Consignee Country field is required.',
    //         'consignee_location.required' => 'The Consignee Location field is required.',
    //         'consignee_phone.required' => 'The Consignee Phone field is required.',
    //         'consignee_zip_code.required' => 'The Consignee Postal/Zip field is required.',
    //         'consignee_code.required' => 'The Consignee Code field is required.',
    //         'notify_name.required' => 'The Notify Name field is required.',
    //         'notify_address.required' => 'The Notify Address field is required.',
    //         'notify_country.required' => 'The Notify Country field is required.',
    //         'notify_location.required' => 'The Notify Location field is required.',
    //         'notify_phone.required' => 'The Notify Phone field is required.',
    //         'notify_zip_code.required' => 'The Notify Postal/Zip field is required.',
    //         'notify_code.required' => 'The Notify Code field is required.',
    //     ];

    //     $request->merge([
    //         'hbl_no' => substr(preg_replace('/[^0-9a-zA-Z\-_.\/]/', '', $request->hbl_no), 0, 50),
    //         'nvocc_scac'       => substr(preg_replace('/[^0-9a-zA-Z.\- ]/', '', $request->nvocc_scac), 0, 50),
    //         'mbl_no'           => substr(preg_replace('/[^0-9a-zA-Z\-_.\/]/', '', $request->mbl_no), 0, 50),
    //         'carrier_scac'     => substr(preg_replace('/[^0-9a-zA-Z.\- ]/', '', $request->carrier_scac), 0, 50),
    //         'from_location'    => strtoupper(preg_replace('/[^A-Z]/', '', strtoupper($request->from_location))),
    //         'to_location'      => strtoupper(preg_replace('/[^A-Z]/', '', strtoupper($request->to_location))),
            
    //         'shipper_name'     => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->shipper_name)), 0, 69),
    //         'shipper_address'  => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->shipper_address)), 0, 69),
    //         'shipper_location' => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->shipper_location)), 0, 69),
    //         'shipper_phone'    => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->shipper_phone), 0, 50),
    //         'shipper_zip_code' => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->shipper_zip_code), 0, 50),
    //         'shipper_email'    => substr(preg_replace('/[^0-9.@a-zA-Z\-_\/]/', '', $request->shipper_email), 0, 50),

    //         'consignee_name'     => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->consignee_name)), 0, 69),
    //         'consignee_address'  => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->consignee_address)), 0, 69),
    //         'shipper_location' => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->shipper_location)), 0, 69),
    //         'consignee_phone'    => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->consignee_phone), 0, 50),
    //         'consignee_zip_code' => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->consignee_zip_code), 0, 50),
    //         'consignee_email'    => substr(preg_replace('/[^0-9.@a-zA-Z\-_\/]/', '', $request->consignee_email), 0, 50),

    //         'notify_name'     => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->notify_name)), 0, 69),
    //         'notify_address'  => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->notify_address)), 0, 69),
    //         'notify_location' => substr(preg_replace('/[^0-9. a-zA-Z\-_\/]/', '', str_replace(['#', '&'], ['NO', 'AND'], $request->notify_location)), 0, 69),
    //         'notify_phone'    => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->notify_phone), 0, 50),
    //         'notify_zip_code' => substr(preg_replace('/[^0-9.a-zA-Z\-_\/]/', '', $request->notify_zip_code), 0, 50),
    //         'notify_email'    => substr(preg_replace('/[^0-9.@a-zA-Z\-_\/]/', '', $request->notify_email), 0, 50),
    //     ]);

    //     // 🔹 Main validation
    //     $validated = $request->validate([
    //         'billing_id' => 'required|string',
    //         'hbl_no' => 'required|string',
    //         'nvocc_scac' => 'required|string',
    //         'mbl_no' => 'required|string',
    //         'carrier_scac' => 'required|string',
    //         'import_export' => 'required|string',
    //         'from_location' => 'required|string',
    //         'to_location' => 'required|string',
    //         'incoterm' => 'required|string',
    //         'shipper_name' => 'required|string',
    //         'shipper_address' => 'required|string',
    //         'shipper_country' => 'required|string',
    //         'shipper_location' => 'required|string',
    //         'shipper_phone' => 'required|string',
    //         'shipper_zip_code' => 'required|string',
    //         'shipper_email' => 'nullable|string|email',
    //         'shipper_code' => 'required|string',

    //         'consignee_name' => 'required|string',
    //         'consignee_address' => 'required|string',
    //         'consignee_country' => 'required|string',
    //         'consignee_location' => 'required|string',
    //         'consignee_phone' => 'required|string',
    //         'consignee_zip_code' => 'required|string',
    //         'consignee_email' => 'nullable|string|email',
    //         'consignee_code' => 'required|string',

    //         'notify_name' => 'required|string',
    //         'notify_address' => 'required|string',
    //         'notify_country' => 'required|string',
    //         'notify_location' => 'required|string',
    //         'notify_phone' => 'required|string',
    //         'notify_zip_code' => 'required|string',
    //         'notify_email' => 'nullable|string|email',
    //         'notify_code' => 'required|string',

    //     ], $messages);

    //     // 🔹 Default & additional fields
    //     $validated += [
    //         'billing_id' => $user->billing_id,
    //         'ultimate_hbl_no' => $validated['hbl_no'],
    //         'hbl_type' => 'OBL',
    //         'mbl_type' => 'OBL',
    //         'filing_type' => 'EUENS',
    //         'original_hbl_no' => $validated['hbl_no'],
    //         'original_mbl_no' => $validated['mbl_no'],
    //         'entry_by' => $user->userId,
    //         'entry_date' => Carbon::now($user->user_time_zone)->format('Y-m-d H:i:s'),
    //         'soft_cust_id' => $user->soft_cust_id,
    //         'partition_id' => $user->partition_id,
    //         'cargoaim_inv_amount' => 0.000,
    //         'cargoaim_inv_roe' => 0.000,
    //         'vsl_cutoms_office_code' => 0.000,
    //     ];

    //     // 🔹 Calculate version
    //     $version = CustomsFiling::where('soft_cust_id', $validated['soft_cust_id'])
    //         ->where('hbl_no', $validated['hbl_no'])
    //         ->where('ultimate_hbl_no', $validated['ultimate_hbl_no'])
    //         ->max('version') ?? 0;
    //     $validated['version'] = $version + 1;

    //     // 🔹 Null-যোগ্য ফিল্ড লিস্ট
    //     $nullableFields = [
    //         'inv_no', 'inv_per_cycle_mbl', 'cargoaim_inv_currency', 'hbl_shipping_bill_no', 'vsl_name', 'vsl_voyage', 'lloyed_no', 
    //         'vsl_call_sign', 'vsl_register_country', 'vsl_route_start_port', 'pol_for_us', 'last_foreign_port', 'first_us_port',
    //         'seller_code', 'seller_name', 'seller_address', 'seller_location', 'seller_zip_code', 'seller_country', 'seller_phone',
    //         'seller_email', 'seller_registration', 'buyer_code', 'buyer_name', 'buyer_address', 'buyer_location', 'buyer_zip_code',
    //         'buyer_country', 'buyer_phone', 'buyer_email', 'buyer_registration', 'hbl_cutoms_office_code', 'hbl_shipping_bill_reg_serial',
    //         'mbl_ams_last_status', 'hbl_ams_last_status', 'isf_last_status', 'first_ams_submit_by', 'filing_channel', 'ams_reference_no', 
    //         'submission_status', 'ens_status_code', 'ens_disposition_code', 'ens_mrn_no', 'eu_lrn_no', 'notification_email', 
    //         'notification_mobile', 'delete_by', 'case_close', 'case_close_by', 'update_by'
    //     ];

    //     foreach ($nullableFields as $field) {
    //         $validated[$field] = $request->input($field, '');
    //     }

    //     // 🔹 Step 4: Date Fields (set default '0000-00-00 00:00:00' if empty)
    //     $dateFields = [
    //         'actual_pol_etd_hbl', 'actual_pod_eta_hbl', 'pol_for_us_date', 'first_us_port_eta', 'hbl_shipping_bill_date', 
    //         'last_update_date', 'first_ams_submit_date', 'update_date', 'delete_date', 'case_close_date',
    //     ];

    //     foreach ($dateFields as $field) {
    //         $validated[$field] = $request->input($field, '0000-00-00 00:00:00');
    //     }

    //     // 🔹 Insert or update main record
    //     $data = CustomsFiling::updateOrCreate(
    //         ['row_id' => $request->row_id],
    //         $validated
    //     );

    //     // seal_no থাকলে, সরাসরি sanitize করে merge
    //     $request->merge([
    //         'container_no' => collect($request->input('container_no', []))->map(fn($item) => preg_replace('/[^0-9.a-zA-Z_\/-]/', '', $item))->toArray(),
    //         'seal_no' => collect($request->input('seal_no', []))->map(fn($item) => preg_replace('/[^0-9.a-zA-Z_\/-]/', '', $item))->toArray(),
    //         'pkg_qty' => collect($request->input('pkg_qty', []))->map(fn($item) => preg_replace('/[^0-9]/', '', $item))->toArray(),
    //         'weight_kg' => collect($request->input('weight_kg', []))->map(fn($item) => preg_replace('/[^0-9]/', '', $item))->toArray(),
    //         'cbm' => collect($request->input('cbm', []))->map(fn($item) => preg_replace('/[^0-9]/', '', $item))->toArray(),
    //         'hs_code' => collect($request->input('hs_code', []))->map(fn($item) => preg_replace('/[^0-9]/', '', $item))->toArray(),

    //         'cargo_marks' => collect($request->input('cargo_marks', []))
    //             ->map(function($item) {
    //                 $item = str_replace(['#', '&'], ['NO', 'AND'], $item);
    //                 $item = preg_replace('/[^0-9. %a-zA-Z_\/-]/', '', $item);
    //                 return substr($item, 0, 178);
    //             })->toArray(),

    //         'cargo_description' => collect($request->input('cargo_description', []))
    //             ->map(function($item) {
    //                 $item = str_replace(['#', '&'], ['NO', 'AND'], $item);
    //                 $item = preg_replace('/[^0-9. %a-zA-Z_\/-]/', '', $item);
    //                 return substr($item, 0, 510);
    //             })->toArray(),
    //     ]);

    //     // 🔹 Validate containers
    //     $request->validate([
    //         'container_no.*'       => 'required|string|size:11',
    //         'size_iso.*'           => 'required|string',
    //         'seal_no.*'            => 'required|string',
    //         'pkg_qty.*'            => 'required|integer',
    //         'pkg_type.*'           => 'required|string',
    //         'weight_kg.*'          => 'required|integer',
    //         'cbm.*'                => 'required|integer',
    //         'hs_code.*'            => 'required|integer',
    //         'un_code_dg.*'         => 'nullable|integer',
    //         'cargo_marks.*'        => 'required|string',
    //         'cargo_description.*'  => 'required|string',
    //     ], [
    //         'container_no.*.required'      => 'Container number is required.',
    //         'container_no.*.max'           => 'Each container number must not exceed 11 characters.',

    //         'size_iso.*.required'     => 'Size ISO is required.',
    //         'size_iso.*.string'       => 'Size ISO must be a string.',

    //         // ✅ seal_no
    //         'seal_no.*.required'      => 'Seal number is required.',
    //         'seal_no.*.string'        => 'Seal number must be a string.',

    //         // ✅ pkg_qty
    //         'pkg_qty.*.required'      => 'Package quantity is required.',
    //         'pkg_qty.*.integer'       => 'Package quantity must be an integer.',

    //         // ✅ pkg_type
    //         'pkg_type.*.required'     => 'Package type is required.',
    //         'pkg_type.*.string'       => 'Package type must be a string.',

    //         // ✅ weight_kg
    //         'weight_kg.*.required'    => 'Weight (KG) is required.',
    //         'weight_kg.*.integer'     => 'Weight (KG) must be an integer.',

    //         // ✅ cbm
    //         'cbm.*.required'          => 'CBM is required.',
    //         'cbm.*.integer'           => 'CBM must be an integer.',

    //         // ✅ hs_code
    //         'hs_code.*.required'      => 'HS Code is required.',
    //         'hs_code.*.integer'       => 'HS Code must be an integer.',

    //         // ✅ un_code_dg
    //         'un_code_dg.*.integer'    => 'UN Code DG must be an integer.',

    //         // ✅ cargo_marks
    //         'cargo_marks.*.required'  => 'Cargo marks are required.',
    //         'cargo_marks.*.string'    => 'Cargo marks must be a string.',
    //         'cargo_marks.*.max'       => 'Cargo marks must not exceed 178 characters.',

    //         // ✅ cargo_description
    //         'cargo_description.*.required' => 'Cargo description is required.',
    //         'cargo_description.*.string'   => 'Cargo description must be a string.',
    //         'cargo_description.*.max'      => 'Cargo description must not exceed 510 characters.',
    //     ]);

    //     // 🔹 Insert container rows
    //     if ($request->has('container_no')) {
    //         foreach ($request->container_no as $i => $no) {
    //             if (!$no) continue;

    //             CustomsFilingEqDetails::create([
    //                 'soft_cust_id' => $validated['soft_cust_id'],
    //                 'partition_id' => $validated['partition_id'],
    //                 'partition_id' => $validated['partition_id'],
    //                 'business_unit' => '',
    //                 'bkg_no' => '',
    //                 'hbl_no' => $validated['hbl_no'],
    //                 'ultimate_hbl_no' => $validated['ultimate_hbl_no'],
    //                 'mbl_no' => $validated['mbl_no'],
    //                 'container_no' => $no,
    //                 'size_iso' => $request->size_iso[$i],
    //                 'seal_no' => $request->seal_no[$i],
    //                 'pkg_qty' => $request->pkg_qty[$i],
    //                 'pkg_type' => $request->pkg_type[$i],
    //                 'weight_kg' => $request->weight_kg[$i],
    //                 'cbm' => $request->cbm[$i],
    //                 'hs_code' => $request->hs_code[$i],
    //                 'un_code_dg' => $request->un_code_dg[$i] ?? '',
    //                 'cargo_marks' => $request->cargo_marks[$i],
    //                 'cargo_description' => $request->cargo_description[$i],
    //                 'version' => 1,
    //                 'status' => 'A',
    //                 'entry_by' => $user->userId,
    //                 'entry_date' => Carbon::now($user->user_time_zone)->format('Y-m-d H:i:s'),
    //                 'update_by' => '',
    //                 'update_date' => '0000-00-00 00:00:00',
    //                 'delete_by' => '',
    //                 'delete_date' => '0000-00-00 00:00:00',
    //             ]);
    //         }
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => $request->row_id ? 'Updated successfully!' : 'Inserted successfully!',
    //         'data' => $data
    //     ]);
    // }


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
