<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

use CWSPS154\AppSettings\Models\AppSettings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

if (! function_exists('get_settings')) {
    function get_settings($key = null)
    {
        $settingsData = [];

        if (Schema::hasTable('app_settings')) {
            try {
                $settings = Cache::remember('settings_data.all', 60 * 60, function () {
                    return AppSettings::all();
                });

                foreach ($settings as $setting) {
                    $cacheKey = 'settings_data.'.$setting->tab.'.'.$setting->key;

                    $value = Cache::remember($cacheKey, 60 * 60, function () use ($setting) {
                        return $setting->value ?? $setting->default;
                    });

                    $keys = explode('.', $setting->key);
                    $current = &$settingsData[$setting->tab];
                    foreach ($keys as $k) {
                        if (! isset($current[$k])) {
                            $current[$k] = [];
                        }
                        $current = &$current[$k];
                    }
                    $current = $value;
                }
            } catch (\Exception $e) {
                return null;
            }
        }
        if ($key) {
            return data_get($settingsData, $key);
        }

        return $settingsData;
    }
}
