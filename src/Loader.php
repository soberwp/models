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
        $this->createFolder();
        $this->loadFiles();
    }

    /**
     * Get path
     */
    protected function getPath()
    {
        $this->path = (has_filter('sober/models/path') ?  apply_filters('sober/models/path', rtrim($path)) : get_stylesheet_directory() . '/model-json');
    }

    /**
     * Create folder
     */
    protected function createFolder()
    {
        if (!file_exists($this->path)) mkdir($this->path);
    }

    /**
     * Load files
     */
    protected function loadFiles()
    {
        foreach (glob($this->path . '/*.json') as $this->file) {
            $this->loadConfig();
            $this->routeType();
        }
    }

    /**
     * Load the config
     */
    protected function loadConfig()
    {
        $this->config = new Config($this->file);
    }

    /**
     * Route model type
     */
    protected function routeType()
    {
        if (in_array($this->config['type'], ['post-type', 'cpt', 'posttype', 'post_type'])) {
            (new PostType($this->config))->run();
        }
        if (in_array($this->config['type'], ['taxonomy', 'tax', 'category', 'tag'])) {
            (new Taxonomy($this->config))->run();
        }
    }
}
