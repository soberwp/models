<?php
/*
Plugin Name:        Models
Plugin URI:         http://github.com/soberwp/models
Description:        WordPress plugin to create custom post types and taxonomies using JSON, YAML or PHP files
Version:            1.0.4
Author:             Sober
Author URI:         http://github.com/soberwp/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
GitHub Plugin URI:  soberwp/models
GitHub Branch:      master
*/
namespace Sober\Models;

use Sober\Models\Loader;

/**
 * Plugin
 */
if (!defined('ABSPATH')) {
    die;
}

require(file_exists($composer = __DIR__ . '/vendor/autoload.php') ? $composer : __DIR__ . '/dist/autoload.php');

/**
 * Hook
 */
add_action('init', function () {
    new Loader();
});
