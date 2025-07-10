<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Services\GlobalSearchService;
use Illuminate\Routing\Controller;

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

    public function getCtryCdeRecords(GlobalSearchService $service)
    {
        return response()->json($service->getCountryCode());
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

    public function getCstDtlRecords(GlobalSearchService $service)
    {
        return response()->json($service->getCustomerDetails());
    }

    public function getPolPodDtlRecords(GlobalSearchService $service)
    {
        return response()->json($service->getPolPodDetails());
    }

    public function getCityRecords(GlobalSearchService $service)
    {
        return response()->json($service->getCity());
    }


}
