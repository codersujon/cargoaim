<?php

namespace Modules\Customsfiling\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class Ics2EnsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $urlData = [
                'getBillFiling' => url('get-bill-filing'),
                'getHblEoriUrl' => url('get-hbl-eori-records'),
                'getMblEoriUrl' => url('get-mbl-eori-records'),
                'getCtryCde' => url('get-country-code'),
                'getCntrSize' => url('get-container-size'),
                'getPKG' => url('get-pkg'),
                'getCstDtl' => url('get-customer-details'),
                'getPolPodDtl' => url('get-pol-pod-details'),
                'getCity' => url('get-city'),
                'filingFetch' => url('filing_fetch'),
                'icsEns' => url('ics_ens'),
            ];

            $view->with('urlData', $urlData);
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
