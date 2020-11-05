<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index():View
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request):RedirectResponse
    {
        $setting = Setting::first();
        $setting->update($request->only('facebook', 'youtube', 'instagram', 'pinterest', 'email', 'whatsapp'));
        return redirect(route('admin.settings.index'))->with('success', 'Setting successfully updated');
    }
}
