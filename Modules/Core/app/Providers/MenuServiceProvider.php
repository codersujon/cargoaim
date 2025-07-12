<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Core\Models\Menu;

class MenuServiceProvider extends ServiceProvider
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
        View::composer([
            'core::dashboard.layouts.master',
        ], function ($view) {
           $menus = Menu::whereNull('parent_route')
                    ->with(['children' => function ($query) {
                        $query->orderBy('order', 'asc'); // child sort
                    }])
                    ->where('is_active', 1)
                    ->orderBy('order', 'asc') // parent sort
                    ->get();

            // $menus = Menu::where('is_active', 1)
            //     ->where('is_hidden', 0)
            //     ->get();

            $view->with(compact('menus'));
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
