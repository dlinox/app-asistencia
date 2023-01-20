<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'email' => $request->user()->email,
                        'nombres' => $request->user()->nombres,
                        'apellidos' => $request->user()->apellidos,
                        'oficina' => $request->user()->oficina,
                        'rol' => $request->user()->getRoleNames()[0],
                        //'menu' => $this->getUserMenu($request->user())
                    ] : null,
                ];
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
        ]);
    }

    private function getUserMenu($user)
    {

        //var_dump($user);

        $user->getAllPermissions()->map(function ($permiso) {
            array_push($this->permisos, $permiso->name);
        });

        $menu = [];

        foreach ($this->menus as $item) {
            $can  =  explode(",", $item['can']);
            if (array_intersect($can,  $this->permisos)) {

                if (array_key_exists('children', $item)) {

                    $aux = $item['children'];
                    $item['children'] = [];
                    foreach ($aux as $child) {
                        $can_child  =  explode(",", $child['can']);
                        if (array_intersect($can_child,  $this->permisos)) {
                            array_push($item['children'],  $child);
                        }
                    }
                }
                array_push($menu,  $item);
            }
        }

        return $menu;
    }

    private $menus =  [
        [
            'label' => "Dashboard",
            'icon' =>  "pi pi-home",
            'route' => "/admin/dashboard",
            'can' => 'admin.dashboard'
        ],

        [
            'label' => "Administración",
            'icon' => "pi pi-cog",
            'can' => 'admin.usuarios.index,admin.roles.index',
            'children' => [
                [
                    'label' => "Usuarios",
                    'icon' => "pi pi-users",
                    'route' => "/admin/usuarios",
                    'can' => 'admin.usuarios.index',
                ],
                [
                    'label' => "Roles",
                    'icon' => "pi pi-wrench",
                    'route' => "/admin/roles",
                    'can' => 'admin.roles.index',
                ],
                [
                    'label' => "Bienes",
                    'icon' => "pi pi-tablet",
                    'route' => "/admin/bienes",
                    'can' => 'admin.bienes.index',
                ],
                [
                    'label' => "Oficinas",
                    'icon' => "pi pi-building",
                    'route' => "/admin/oficinas",
                    'can' => 'admin.oficinas.index',
                ],
            ],
        ],
    ];
}
