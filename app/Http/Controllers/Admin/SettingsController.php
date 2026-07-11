<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Settings;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

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
    public function update(UpdateSettingsRequest $request)
    {
        $validated = $request->validated();

        // $this->service->updateSettings($validated);

        $imageFields = ['site_logo', 'favicon', 'hero_banner'];

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
