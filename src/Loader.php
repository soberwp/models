<?php

namespace Sober\Models;

use Noodlehaus\Config;
use Sober\Models\Model\PostType;
use Sober\Models\Model\Taxonomy;

class Loader
{
    protected $path;
    protected $file;
    protected $config;

    public function __construct()
    {
        $this->getPath();
        $this->createPath();
        $this->loadConfig();
    }

    /**
     * Get custom path
     */
    protected function getPath()
    {
        $this->path = (has_filter('sober/models/path') ?  apply_filters('sober/models/path', rtrim($path)) : get_stylesheet_directory() . '/model-json');
    }

    /**
     * Create path
     */
    protected function createPath()
    {
        if (!file_exists($this->path)) mkdir($this->path);
    }

    /**
     * Load config
     */
    protected function loadConfig()
    {
        $path = new \RecursiveDirectoryIterator($this->path);
        foreach (new \RecursiveIteratorIterator($path) as $filename => $file) {   
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $this->config = new Config($file);
                ($this->isMultipleConfig() ? $this->loadEachConfig() : $this->routeConfig($this->config));
            }
        }
    }

    /**
     * Is multidimensional config
     */
    protected function isMultipleConfig()
    {
        return (is_array(current($this->config->all())));
    }

    /**
     * Load each from multidimensional config
     */
    protected function loadEachConfig()
    {   
        foreach($this->config as $config) {
            $this->routeConfig($config);
        }
    }

    /**
     * Route config to class
     */
    protected function routeConfig($config)
    {
        if (in_array($config['type'], ['post-type', 'cpt', 'posttype', 'post_type'])) {
            (new PostType($config))->run();
        }
        if (in_array($config['type'], ['taxonomy', 'tax', 'category', 'cat', 'tag'])) {
            (new Taxonomy($config))->run();
        }
    }
}
