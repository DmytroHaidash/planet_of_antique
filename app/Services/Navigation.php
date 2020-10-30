<?php

namespace App\Services;

class Navigation
{
    public function header()
    {
        return [
            //
        ];
    }

    public function footer()
    {
        return [
            //
        ];
    }

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
                'match' => app('router')->is('admin.products'),
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
        ];
    }

    public function board(){
        return [
            (object)[
                'name' => 'Shops',
                'route' => route('board.shops.index'),
                'icon' => 'i-laptop',
                'match' => app('router')->is('board.shops.*'),
            ],
            (object)[
                'name' => 'Articles',
                'route' => route('board.articles.index'),
                'icon' => 'i-newspaper',
                'match' => app('router')->is('board.articles.*'),
            ],
            (object)[
                'name' => 'Products',
                'route' => route('board.products.index'),
                'icon' => 'i-folder',
                'match' => app('router')->is('board.products'),
            ],
        ];
    }
}