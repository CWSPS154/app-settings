<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

use CWSPS154\AppSettings\AppSettingsServiceProvider;
use CWSPS154\AppSettings\Models\AppSettings;
use Filament\Facades\Filament;

$panel_ids = [];

foreach (Filament::getPanels() as $panel) {
    if ($panel->hasPlugin(AppSettingsServiceProvider::$name)) {
        $panel_ids[] = $panel->getId();
    }
}

return [
    AppSettings::APP_SETTINGS => [
        'name' => 'App Settings',
        'panel_ids' => $panel_ids,
        'route' => null,
        'status' => true,
        'children' => [
            AppSettings::VIEW_EDIT_SETTINGS => [
                'name' => 'View & Edit App Settings',
                'panel_ids' => $panel_ids,
                'route' => 'pages.app-settings',
                'status' => true,
            ],
            AppSettings::APP_SECTION_SETTINGS => [
                'name' => 'App Section Settings',
                'panel_ids' => $panel_ids,
                'route' => null,
                'status' => true,
            ],
        ],
    ],
];
