<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class Sidebar extends Component
{
    public array $menus;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
         $currentRoute = request()->route()?->getName() ?? '';

        $menus = $this->menuItems();

        foreach ($menus as &$menu) {
            $menu['isActive'] = Str::is($menu['active'], $currentRoute);

            if (isset($menu['children'])) {
                foreach ($menu['children'] as &$child) {
                    $child['isActive'] = Str::is($child['active'], $currentRoute);
                }
                unset($child);

                $menu['isActive'] = $menu['isActive'] || collect($menu['children'])->contains('isActive', true);
            }
        }
        unset($menu);

        $this->menus = $menus;
    }

    public static function currentLabel(): string
    {
        $currentRoute = request()->route()?->getName() ?? '';

        // Special cases first
    if ($currentRoute === 'settings.users.edit') {
        return 'Atur Profil Pengguna';
    }

    if ($currentRoute === 'settings.users.create') {
        return 'Tambah Pengguna';
    }

        foreach ((new self())->menuItems() as $menu) {
            if (isset($menu['route']) && $menu['route'] === $currentRoute) {
                return $menu['label'];
            }

            if (isset($menu['children'])) {
                foreach ($menu['children'] as $child) {
                    if (isset($child['route']) && $child['route'] === $currentRoute) {
                        return $child['label'];
                    }
                }
            }

            if (Str::is($menu['active'], $currentRoute)) {
                return $menu['label'];
            }
        }

        return config('app.name');
    }

    private function menuItems(): array
    {
        return [
            [
                'label'    => 'Beranda',
                'route'    => 'home',
                'icon'     => ['type' => 'component', 'component' => 'heroicon-o-squares-2x2'],
                'active'   => 'home',
            ],            
            [
                'label'  => 'Pengaturan',
                'icon'   => ['type' => 'component', 'component' => 'heroicon-o-cog-6-tooth'],
                'active' => 'settings.*',
                'children' => [
                    [
                        'label'  => 'Profil Masjid',
                        'route'  => 'settings.profile',
                        'active' => 'settings.profile',
                    ],
                    [
                        'label'  => 'Jam Sholat',
                        'route'  => 'settings.prayertimes',
                        'active' => 'settings.prayertimes',
                    ],
                    [
                        'label'  => 'Manajemen Pengguna',
                        'route'  => 'settings.users',
                        'active' => 'settings.users*',
                    ],
                ],
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
