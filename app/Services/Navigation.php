<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class Navigation
{
    public function backend()
    {
        return [
            (object)[
                'name' => 'Shops',
                'route' => route('admin.shops.index'),
                'icon' => 'i-laptop',
                'match' => app('router')->is('admin.shops.*'),
            ],
            (object)[
                'name' => 'Categories',
                'route' => route('admin.categories.index'),
                'icon' => 'i-bullet-list',
                'match' => app('router')->is('admin.categories.*'),
            ],
            (object)[
                'name' => 'Products',
                'route' => route('admin.products.index'),
                'icon' => 'i-folder',
                'match' => app('router')->is('admin.products.*'),
            ],
            (object)[
                'name' => 'Orders',
                'route' => route('admin.orders.index'),
                'icon' => 'i-gallery',
                'match' => app('router')->is('admin.orders.*'),
            ],
            (object)[
                'name' => 'Museums',
                'route' => route('admin.museums.index'),
                'icon' => 'i-flag',
                'match' => app('router')->is('admin.museums.*'),
            ],
            (object)[
                'name' => 'Exhibits',
                'route' => route('admin.exhibits.index'),
                'icon' => 'i-floppy',
                'match' => app('router')->is('admin.exhibits.*'),
            ],
            (object)[
                'name' => 'Tags',
                'route' => route('admin.tags.index'),
                'icon' => 'i-tag',
                'match' => app('router')->is('admin.tags.*'),
            ],
            (object)[
                'name' => 'Articles',
                'route' => route('admin.articles.index'),
                'icon' => 'i-newspaper',
                'match' => app('router')->is('admin.articles.*'),
            ],
            (object)[
                'name' => 'Pages',
                'route' => route('admin.pages.index'),
                'icon' => 'i-template',
                'match' => app('router')->is('admin.pages.*')
            ],
            (object)[
                'name' => 'Banners',
                'route' => route('admin.banners.index'),
                'icon' => 'i-portfolio',
                'match' => app('router')->is('admin.banners.*')
            ],
            (object)[
                'name' => 'Benefits',
                'route' => route('admin.benefits.index'),
                'icon' => 'i-bullet-list',
                'match' => app('router')->is('admin.benefits.*')
            ],
            (object)[
                'name' => 'Users',
                'route' => route('admin.users.index'),
                'icon' => 'i-user',
                'match' => app('router')->is('admin.users.*')
            ],
            (object)[
                'name' => 'Settings',
                'route' => route('admin.settings.index'),
                'icon' => 'i-settings',
                'match' => app('router')->is('admin.settings.*')
            ]
        ];
    }

    public function board()
    {
        $aside = [
            (object)[
                'name' => 'Shops',
                'route' => route('board.shops.index'),
                'icon' => 'i-laptop',
                'match' => app('router')->is('board.shops.*'),
            ],
            (object)[
                'name' => 'Products',
                'route' => route('board.products.index'),
                'icon' => 'i-folder',
                'match' => app('router')->is('board.products.*'),
            ],
            (object)[
                'name' => 'Orders',
                'route' => route('board.orders.index'),
                'icon' => 'i-gallery',
                'match' => app('router')->is('board.orders.*'),
            ],
        ];
        if(Auth::user()->museum){
            $aside[] = (object)[
                'name' => 'Museum',
                'route' => route('board.museums.edit', Auth::user()->museum),
                'icon' => 'i-flag',
                'match' => app('router')->is('board.museums.*'),
            ];
            $aside[] = (object)[
                'name' => 'Exhibits',
                'route' => route('board.exhibits.index'),
                'icon' => 'i-floppy',
                'match' => app('router')->is('board.exhibits.*'),
            ];
        }else{
            $aside[] = (object)[
                'name' => 'Create Museum',
                'route' => route('board.museums.create'),
                'icon' => 'i-flag',
                'match' => app('router')->is('board.museums.*'),
            ];
        }
        $aside[] = (object)[
            'name' => 'Articles',
            'route' => route('board.articles.index'),
            'icon' => 'i-newspaper',
            'match' => app('router')->is('board.articles.*'),
        ];

        return $aside;
    }
}