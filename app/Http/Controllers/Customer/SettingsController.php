<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('customer.settings.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email_notifications' => ['boolean'],
            'order_updates' => ['boolean'],
            'marketing_updates' => ['boolean'],
            'language' => ['required', 'string', 'in:en,id'],
            'timezone' => ['required', 'string', 'timezone'],
        ]);

        // Convert checkbox values to boolean
        $settings = [
            'email_notifications' => $request->has('email_notifications'),
            'order_updates' => $request->has('order_updates'),
            'marketing_updates' => $request->has('marketing_updates'),
            'language' => $validated['language'],
            'timezone' => $validated['timezone'],
        ];

        $user->settings()->updateOrCreate(
            ['user_id' => $user->id],
            $settings
        );

        return redirect()->route('profile.settings')->with('success', 'Settings updated successfully.');
    }
} 