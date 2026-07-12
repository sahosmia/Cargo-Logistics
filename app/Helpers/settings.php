<?php

use App\Models\Settings;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

if (! function_exists('settings')) {
    /**
     * Get setting value by key with optimized global caching and auto-casting.
     *
     * @param  mixed  $default
     * @return mixed
     */
    function settings(?string $key = null, $default = null)
    {
        $settings = Cache::rememberForever('settings.all', function () {
            return Settings::pluck('value', 'key');
        });

        if (is_null($key)) {
            return app(Settings::class);
        }

        $value = $settings->get($key);

        if (is_null($value)) {
            return $default;
        }

        // Auto-cast numeric strings to integers if applicable
        if (is_string($value) && is_numeric($value) && (string) (int) $value === $value) {
            return (int) $value;
        }

        return $value;
    }
}

if (! function_exists('handleImageUpload')) {
    function handleImageUpload(string $key, UploadedFile $file): void
    {
        // Get old image path
        $oldPath = Settings::pluck('value', 'key')->get($key);

        // Store new image
        $path = $file->store('settings', 'public');

        // Save path to DB
        Settings::updateOrCreate(
            ['key' => $key],
            ['value' => $path]
        );

        // Delete old image if exists
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
    }
}
