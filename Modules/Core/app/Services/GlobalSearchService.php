<?php

namespace Modules\Core\Services;

use Modules\Core\Models\EqCodeTable;
use Modules\Core\Models\CountryTable;
use Modules\Core\Models\PkgCodeTable;
use Modules\Core\Models\LocationTable;
use Modules\Core\Models\CustomerAddress;
use Modules\Core\Models\CustomsFilingScacEoriCoded;
use Modules\Core\Models\FilingContractRate;
use Illuminate\Http\Request;
use Auth;

class GlobalSearchService
{
    public function getHBLEori()
    {
        $user = Auth::guard('web')->user();
        $soft_cust_id = $user->soft_cust_id;
        $billing_id = $user->billing_id;
        $super_admin_type = $user->super_admin_type;
        
        // customer base admin full acsses*(filing_contract_rate)
        return CustomsFilingScacEoriCoded::select('eori_code', 'scac_eori_full')
            ->where('code_owner_type', 'N')
            ->where('eori_code', '!=', '')
            ->distinct()
            ->orderBy('scac_eori_full', 'asc')
            ->get();
    }

    public function getMBLEori()
    {
        return CustomsFilingScacEoriCoded::select('eori_code', 'scac_eori_full')
            ->where('code_owner_type', 'L')
            ->where('eori_code', '!=', '')
            ->distinct()
            ->orderBy('scac_eori_full', 'asc')
            ->get();
    }

    public function getCountryCode(Request $request)
    {
        $query = CountryTable::select('countryName', 'countryCode');

        if ($request->has('ts_country')) {
            $query->where('ts_country', $request->input('ts_country'));
        }

        return $query->orderBy('countryName', 'asc')->get();
    }


    public function getBillFiling()
    {
        $user = Auth::guard('web')->user();
        $soft_cust_id = $user->soft_cust_id;
        $billing_id = $user->billing_id;
        $super_admin_type = $user->super_admin_type;

        $query = FilingContractRate::select('billing_id')->distinct('billing_id');

        if ($super_admin_type === 'N') {
            $query->where('soft_cust_id', $soft_cust_id)
                ->where('billing_id', $billing_id);
        }

        return $query->orderBy('billing_id', 'asc')->get();
    }


    public function getContainerSize()
    {
        return EqCodeTable::select('eq_code', 'eq_size_display')
            ->where('eq_code', '!=', 'CBM')
            ->orderBy('eq_size_display', 'asc')
            ->distinct()
            ->get();
    }

    public function getPKG()
    {
        return PkgCodeTable::select('pkg_code', 'pkg_description')
            ->where('show_e_bkg_list', 'Y')
            ->distinct()
            ->orderBy('pkg_description', 'asc')
            ->get();
    }

    public function getCustomerDetails(Request $request)
    {
        $name = $request->get('name');

        return CustomerAddress::where('customer_full_name', 'like', '%' . $name . '%')->get(); // সব matching result আনবে
    }

    public function getPolPodDetails(Request $request)
    {
        $polpod = $request->get('polpod');
        $seaAirLand = $request->get('seaAirLand');

        // validate incoming seaAirLand
        if (!in_array($seaAirLand, [1, 2, 3])) {
            return response()->json(['status' => false, 'message' => 'Invalid seaAirLand value']);
        }

        return LocationTable::where('locationSeaAirLand', $seaAirLand)
            ->where(function ($query) use ($polpod) {
                $query->where('locationCode', 'like', '%' . $polpod . '%')
                    ->orWhere('locationName', 'like', '%' . $polpod . '%');
            })
            ->limit(100)
            ->get();
    }

    public function getCity(Request $request)
    {
        $countryCode = $request->input('countryCode');
        
        return LocationTable::where('countryCode', $countryCode)
            ->orderBy('locationName', 'asc')
            ->get();
    }


    
}
