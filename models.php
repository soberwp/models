<?php
namespace Sober\Models;

use Sober\Models\Loader;

/**
 * Hook
 */
add_action('init', function () {
    new Loader();
});
