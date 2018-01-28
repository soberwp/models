<?php

namespace Sober\Models;

use Sober\Models\Loader;

/**
 * Hook
 */
if (function_exists('add_action')) {
    add_action('init', function () {
        new Loader();
    });
}
