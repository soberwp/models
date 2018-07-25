<?php

namespace Sober\Models\Model;

use Sober\Models\Model;

class PostType extends Model
{
    // data req for register_post_type()
    protected $supports = [];

    public function run()
    {
        if ($this->isDisabled()) {
            return;
        }
        
        $this->setDefaultConfig()->setConfig();
        $this->setDefaultLabels()->setLabels();

        $this->merge();
        $this->register();
    }

    /**
     * Set config defaults
     *
     * Make public and change menu position
     * @return $this
     */
    protected function setDefaultConfig()
    {
        $this->config = [
            'public'        => true,
            'menu_position' => 5
        ];
        $this->supports = $this->data['supports'];

        return $this;
    }

    /**
     * Set default labels
     *
     * Create an labels array and implement default singular and plural labels
     * @return $this
     */
    protected function setDefaultLabels()
    {
        $this->labels = [
            'name'                  => _x($this->many, 'Post type general name', $this->i18n),
            'singular_name'         => _x($this->one, 'Post type singular name', $this->i18n),
            'menu_name'             => _x($this->many, 'Admin Menu text', $this->i18n),
            'name_admin_bar'        => _x($this->one, 'Add New on Toolbar', $this->i18n),
            'add_new_item'          => __('Add New ' . $this->one, $this->i18n),
            'edit_item'             => __('Edit ' . $this->one, $this->i18n),
            'new_item'              => __('New ' . $this->one, $this->i18n),
            'view_item'             => __('View ' . $this->one, $this->i18n),
            'view_items'            => __('View ' . $this->many, $this->i18n),
            'search_items'          => __('Search ' . $this->many, $this->i18n),
            'not_found'             => __('No ' . strtolower($this->many) . ' found.', $this->i18n),
            'not_found_in_trash'    => __('No ' . strtolower($this->many) . ' found in Trash.', $this->i18n),
            'parent_item_colon'     => __('Parent ' . $this->many . ':', $this->i18n),
            'all_items'             => __('All ' . $this->many, $this->i18n),
            'archives'              => __($this->one . ' Archives', $this->i18n),
            'attributes'            => __($this->one . ' Attributes', $this->i18n),
            'insert_into_item'      => __('Insert into ' . strtolower($this->one), $this->i18n),
            'uploaded_to_this_item' => __('Uploaded to this ' . strtolower($this->one), $this->i18n),
            'filter_items_list'     => __('Filter ' . strtolower($this->many) . ' list', $this->i18n),
            'items_list_navigation' => __($this->many . ' list navigation', $this->i18n),
            'items_list'            => __($this->many . ' list', $this->i18n)
        ];

        return $this;
    }

    /**
     * Merge
     *
     * Args to be passed to WP register_post_type()
     * @return $this
     */
    protected function merge()
    {
        $this->args = [
            'labels' => $this->labels,
            'supports' => $this->supports,
        ];
        $this->args = array_merge($this->args, $this->config);
    }

    /**
     * Register Post Type
     * 
     * Uses extended-cpts if available.
     * @see https://github.com/johnbillion/extended-cpts
     * 
     * @return void
     */
    protected function register()
    {
        if (function_exists('register_extended_post_type')) {
            register_extended_post_type($this->name, $this->args);
        } else {
            register_post_type($this->name, $this->args);
        }
    }
}
