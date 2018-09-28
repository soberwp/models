<?php

namespace Sober\Models\Model;

use Sober\Models\Model;

class Taxonomy extends Model
{
    // data req for register_taxonomy()
    protected $links = 'post';

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
        if ($this->data['config']) {
            $this->config = $this->data['config'];
        }
        if (in_array($this->data['type'], ['cat', 'category'])) {
            $this->config = ['hierarchical' => true];
        }
        if ($this->data['links']) {
            $this->links = $this->data['links'];
        }

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
            'name'                       => _x($this->many, 'Taxonomy general name', $this->i18n),
            'singular_name'              => _x($this->one, 'Taxonomy singular name', $this->i18n),
            'search_items'               => __('Search ' . $this->many, $this->i18n),
            'popular_items'              => __('Popular ' . $this->many, $this->i18n),
            'all_items'                  => __('All ' . $this->many, $this->i18n),
            'parent_item'                => __('Parent ' . $this->one, $this->i18n),
            'parent_item_colon'          => __('Parent ' . $this->one . ':', $this->i18n),
            'edit_item'                  => __('Edit ' . $this->one, $this->i18n),
            'view_item'                  => __('View ' . $this->one, $this->i18n),
            'update_item'                => __('Update ' . $this->one, $this->i18n),
            'add_new_item'               => __('Add New ' . $this->one, $this->i18n),
            'new_item_name'              => __('New ' . $this->one . ' Name', $this->i18n),
            'separate_items_with_commas' => __('Separate ' . strtolower($this->many) . ' with commas', $this->i18n),
            'add_or_remove_items'        => __('Add or remove '. strtolower($this->many), $this->i18n),
            'choose_from_most_used'      => __('Choose from the most used ' . strtolower($this->many), $this->i18n),
            'not_found'                  => __('No ' . strtolower($this->many) . ' found.', $this->i18n),
            'no_terms'                   => __('No ' . strtolower($this->many), $this->i18n),
            'items_list_navigation'      => __($this->many . ' list navigation', $this->i18n),
            'items_list'                 => __($this->many . ' list', $this->i18n)
        ];

        return $this;
    }

    /**
     * Merge
     *
     * Args to be passed to WP register_taxonomy()
     * @return $this
     */
    protected function merge()
    {
        $this->args = [
            'labels' => $this->labels
        ];
        $this->args = array_merge($this->args, $this->config);
    }

    /**
     * Register Taxonomy
     * 
     * Uses extended-cpts if available.
     * @see https://github.com/johnbillion/extended-cpts
     * 
     * @return void
     */
    protected function register()
    {
        if (function_exists('register_extended_taxonomy')) {
            register_extended_taxonomy($this->name, $this->links, $this->args);
        } else {
            register_taxonomy($this->name, $this->links, $this->args);
        }
    }
}
