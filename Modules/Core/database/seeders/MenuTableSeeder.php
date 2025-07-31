<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Menu;
use Carbon\Carbon;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = include(__DIR__ . '/data/menus_data.php');
        $routeToId = [];

        // First pass: Insert or Update menus with parent_id = null
        foreach ($menus as $menu) {
            $menuData = [
                'title'         => $menu['title'],
                'icon'          => $menu['icon'],
                'url'           => $menu['url'],
                'params'        => $menu['params'],
                'order'         => $menu['order'],
                'permission'    => $menu['permission'],
                'roles'         => $menu['roles'],
                'is_active'     => $menu['is_active'],
                'is_hidden'     => $menu['is_hidden'],
                'has_children'  => $menu['has_children'],
                'module'        => $menu['module'],
                'target'        => $menu['target'],
                'tooltip_title' => $menu['tooltip_title'] ?? null,
                'parent_route'  => null,
                'updated_at'    => Carbon::now(),
            ];

            // Add created_at only when inserting
            $menuModel = Menu::updateOrCreate(
                ['route' => $menu['route']],
                array_merge(['created_at' => Carbon::now()], $menuData)
            );

            $routeToId[$menu['route']] = $menuModel->id;
        }

        // Second pass: Update parent_route using route mapping
        foreach ($menus as $menu) {
            if (!empty($menu['parent_route']) && isset($routeToId[$menu['parent_route']])) {
                Menu::where('route', $menu['route'])
                    ->update(['parent_route' => $routeToId[$menu['parent_route']]]);
            }
        }

        $this->command->info('Menu table seeded successfully!');
    }
}
