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

class GlobalSearchService
{
    public function getHBLEori()
    {
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
        return FilingContractRate::select('billing_id')
            ->orderBy('billing_id', 'asc')
            ->distinct()
            ->get();
    }

    public function getContainerSize()
    {
        return EqCodeTable::select('eq_code', 'eq_size_display')
            ->where('eq_code', '!=', 'CBM')
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
