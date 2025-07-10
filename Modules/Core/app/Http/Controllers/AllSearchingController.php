<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Services\GlobalSearchService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AllSearchingController extends Controller 
{
     public function getHBLEoriRecords(GlobalSearchService $service)
    {
        return response()->json($service->getHBLEori());
    }

    public function getMBLEoriRecords(GlobalSearchService $service)
    {
        return response()->json($service->getMBLEori());
    }

    public function getCtryCdeRecords(Request $request, GlobalSearchService $service)
    {
        return response()->json($service->getCountryCode($request));
    }

    public function getBillFileRecords(GlobalSearchService $service)
    {
        return response()->json($service->getBillFiling());
    }

    public function getCntrSizeRecords(GlobalSearchService $service)
    {
        return response()->json($service->getContainerSize());
    }
    
    public function getPKGrecords(GlobalSearchService $service)
    {
        return response()->json($service->getPKG());
    }

    public function getCstDtlRecords(Request $request, GlobalSearchService $service)
    {
        return response()->json($service->getCustomerDetails($request));
    }

    public function getPolPodDtlRecords(Request $request, GlobalSearchService $service)
    {
        return response()->json($service->getPolPodDetails($request));
    }

    public function getCityRecords(Request $request, GlobalSearchService $service)
    {
        return response()->json($service->getCity($request));
    }


}
