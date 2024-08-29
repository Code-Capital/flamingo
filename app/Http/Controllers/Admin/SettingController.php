<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(): View
    {
        $setting = Setting::first();

        return view('admin.settings.index', get_defined_vars());
    }

    public function updateSub(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'sub_event_create_count' => ['required', 'numeric'],
            'sub_event_join_count' => ['required', 'numeric'],
            'sub_page_create_count' => ['required', 'numeric'],
            'sub_page_join_count' => ['required', 'numeric'],
        ]);

        $setting = Setting::first();
        $sub_event_create_count = $request->sub_event_create_count ?? $setting->sub_event_create_count;
        $sub_event_join_count = $request->sub_event_join_count ?? $setting->sub_event_join_count;
        $sub_page_create_count = $request->sub_page_create_count ?? $setting->sub_page_create_count;
        $sub_page_join_count = $request->sub_page_join_count ?? $setting->sub_page_join_count;

        $settings = [
            'sub_event_create_count' => $sub_event_create_count,
            'sub_event_join_count' => $sub_event_join_count,
            'sub_page_create_count' => $sub_page_create_count,
            'sub_page_join_count' => $sub_page_join_count,
        ];

        // Update the settings in the database
        Setting::updateOrCreate(['id' => 1], $settings);

        return redirect()->back()->with('success', 'Settings updated successfully');
    }

    public function updateUnSub(Request $request)
    {
        $request->validate([
            'un_sub_event_create_count' => ['required', 'numeric'],
            'un_sub_event_join_count' => ['required', 'numeric'],
            'un_sub_page_create_count' => ['required', 'numeric'],
            'un_sub_page_join_count' => ['required', 'numeric'],
        ]);

        $setting = Setting::first();
        $un_sub_event_create_count = $request->un_sub_event_create_count ?? $setting->un_sub_event_create_count;
        $un_sub_event_join_count = $request->un_sub_event_join_count ?? $setting->un_sub_event_join_count;
        $un_sub_page_create_count = $request->un_sub_page_create_count ?? $setting->un_sub_page_create_count;
        $un_sub_page_join_count = $request->un_sub_page_join_count ?? $setting->un_sub_page_join_count;

        $settings = [
            'un_sub_event_create_count' => $un_sub_event_create_count,
            'un_sub_event_join_count' => $un_sub_event_join_count,
            'un_sub_page_create_count' => $un_sub_page_create_count,
            'un_sub_page_join_count' => $un_sub_page_join_count,
        ];

        // Update the settings in the database
        Setting::updateOrCreate(['id' => 1], $settings);

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
