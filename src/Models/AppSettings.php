<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\AppSettings\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model
{
    use HasUuids;

    public const APP_SETTINGS = 'app-settings';

    public const VIEW_EDIT_SETTINGS = 'view-edit-settings';

    public const APP_SECTION_SETTINGS = 'app-section-settings';

    protected $fillable = [
        'tab',
        'key',
        'default',
        'value',
    ];
}
