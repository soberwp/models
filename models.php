<?php
<<<<<<< HEAD

=======
/*
Plugin Name:        Models
Plugin URI:         http://github.com/soberwp/models
Description:        WordPress plugin to create custom post types and taxonomies using JSON, YAML or PHP files
Version:            1.1.0
Author:             Sober
Author URI:         http://github.com/soberwp/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
GitHub Plugin URI:  soberwp/models
GitHub Branch:      master
*/
>>>>>>> master
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
