<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MainMenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'main')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Über Uns",
            'url' => '',
            'route' => 'pages.about_us',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => null,
                'order' => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Gaming",
            'url' => '#',
            'route' => '',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => null,
                'order' => 3,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Airsoft",
            'url' => '',
            'route' => 'pages.airsoft',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => null,
                'order' => 4,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Partner",
            'url' => '',
            'route' => 'pages.partner',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => null,
                'order' => 5,
            ])->save();
        }

        $GamingItem = MenuItem::where('title', 'Gaming')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "ArmA 3",
            'url' => '',
            'route' => 'pages.arma3',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => $GamingItem->id,
                'order' => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "CS:GO",
            'url' => '',
            'route' => 'pages.csgo',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => $GamingItem->id,
                'order' => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "League Of Legends",
            'url' => '',
            'route' => 'pages.league_of_legends',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => $GamingItem->id,
                'order' => 3,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Rocket League",
            'url' => '',
            'route' => 'pages.rocket_league',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => $GamingItem->id,
                'order' => 4,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "World Of Warcraft",
            'url' => '',
            'route' => 'pages.world_of_warcraft',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => '',
                'color' => null,
                'parent_id' => $GamingItem->id,
                'order' => 5,
            ])->save();
        }
    }
}
