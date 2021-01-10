<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function show(Page $page)
    {
        return view('client.pages.default', compact('page'));
    }
}
