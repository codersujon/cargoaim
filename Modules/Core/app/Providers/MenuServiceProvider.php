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

            $sidemenus = Menu::whereNull('parent_route')
                    ->whereNull('icon')
                    ->where('is_active', 1)
                    ->where('is_hidden', 0)
                    ->where('has_children', 0)
                    ->orderBy('order', 'asc')
                    ->get();

            $view->with(compact('menus', 'sidemenus'));
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
