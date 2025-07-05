<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Menu;
use Carbon\Carbon;;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = include(__DIR__ . '/data/menus_data.php');
        $routeToId = [];

        // First pass: Insert all menus with parent_id = null
        foreach ($menus as $menu) {
            $menuModel = new Menu();

            $menuModel->title        = $menu['title'];
            $menuModel->icon         = $menu['icon'];
            $menuModel->url          = $menu['url'];
            $menuModel->route        = $menu['route'];
            $menuModel->params       = $menu['params']; // will auto-cast if model has cast
            $menuModel->order        = $menu['order'];
            $menuModel->permission   = $menu['permission'];
            $menuModel->roles        = $menu['roles'];  // will auto-cast if model has cast
            $menuModel->is_active    = $menu['is_active'];
            $menuModel->is_hidden    = $menu['is_hidden'];
            $menuModel->has_children = $menu['has_children'];
            $menuModel->module       = $menu['module'];
            $menuModel->target       = $menu['target'];
            $menuModel->parent_route = null; // temporary
            $menuModel->created_at   = Carbon::now();
            $menuModel->updated_at   = Carbon::now();

            $menuModel->save();

            $routeToId[$menu['route']] = $menuModel->id;
        }

        // Second pass: Update parent_route using route mapping
        foreach ($menus as $menu) {
            if (!empty($menu['parent_route']) && isset($routeToId[$menu['parent_route']])) {
                Menu::where('route', $menu['route'])
                    ->update(['parent_route' => $routeToId[$menu['parent_route']]]);
            }
        }

    }
}
