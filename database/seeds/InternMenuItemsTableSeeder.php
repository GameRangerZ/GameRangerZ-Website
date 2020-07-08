<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class InternMenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'intern')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Dashboard",
            'url' => '',
            'route' => 'dashboard',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => 'mdi-view-dashboard',
                'color' => null,
                'parent_id' => null,
                'order' => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Tetris",
            'url' => '',
            'route' => 'tetris',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => 'mdi-google-controller',
                'color' => null,
                'parent_id' => null,
                'order' => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Email",
            'url' => 'https://mail.gamerangerz.de/',
            'route' => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_blank',
                'icon_class' => 'mdi-email',
                'color' => null,
                'parent_id' => null,
                'order' => 3,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => "Musicbot",
            'url' => 'https://musicbot.gamerangerz.de/',
            'route' => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_blank',
                'icon_class' => 'mdi-music-note',
                'color' => null,
                'parent_id' => null,
                'order' => 4,
            ])->save();
        }
    }
}
