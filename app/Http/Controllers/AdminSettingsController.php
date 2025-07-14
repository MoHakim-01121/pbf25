<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

class AdminSettingsController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit', [
            'title' => 'Settings',
            'settings' => Setting::all()->pluck('value', 'key')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:1000',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'social_media' => 'nullable|array',
            'maintenance_mode' => 'boolean'
        ]);

        // Update each setting
        foreach ($request->except('_token', '_method') as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }

        // Clear settings cache
        Cache::forget('settings');

        return redirect()->route('admin.settings')
            ->with('success', 'Settings updated successfully');
    }
} 