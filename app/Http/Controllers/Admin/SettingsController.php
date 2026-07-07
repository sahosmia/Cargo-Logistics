<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Settings;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function __construct() {}

    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        return Inertia::render('Admin/Settings/Index', [
            'settings' => Settings::pluck('value', 'key')->toArray(),
        ]);
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:1024'],
            'app_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'website_url' => ['nullable', 'url', 'max:255'],
            // 'office_name_1' => ['nullable', 'string', 'max:255'],
            // 'office_name_2' => ['nullable', 'string', 'max:255'],
            'paginated_quantity' => ['required', 'integer', 'min:1'],
        ]);

        // $this->service->updateSettings($validated);

        $imageFields = ['site_logo', 'favicon'];

        foreach ($validated as $key => $value) {
            if (in_array($key, $imageFields)) {
                if ($value instanceof UploadedFile) {
                    handleImageUpload($key, $value);
                }
                continue;
            }

            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Clear the global settings cache
        Cache::forget('settings.all');

        return back()->with('success', 'Settings updated successfully.');
    }
}
