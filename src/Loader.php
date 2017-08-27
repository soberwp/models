<?php

namespace Sober\Models;

use Noodlehaus\Config;
use Sober\Models\ConfigNoFile;
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
        $this->load();
    }

    /**
     * Get custom path
     */
    protected function getPath()
    {
        $default = (file_exists(dirname(get_template_directory()) . '/app') ? 
                    dirname(get_template_directory()) . '/app/models' :
                    get_stylesheet_directory() . '/models');

        $this->path = (has_filter('sober/models/path') ? 
                    apply_filters('sober/models/path', rtrim($this->path)) : 
                    $default);
    }

    /**
     * Load
     */
    protected function load()
    {
        if (file_exists($this->path)) {
            $path = new \RecursiveDirectoryIterator($this->path);
            foreach (new \RecursiveIteratorIterator($path) as $filename => $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['json', 'php', 'yml', 'yaml'])) {
                    $this->config = new Config($file);
                    ($this->isMultiple() ? $this->loadEach() : $this->route($this->config));
                }
            }
        }
    }

    /**
     * Is multidimensional config
     */
    protected function isMultiple()
    {
        return (is_array(current($this->config->all())));
    }

    /**
     * Load each from multidimensional config
     */
    protected function loadEach()
    {
        foreach ($this->config as $config) {
            $this->route(new ConfigNoFile($config));
        }
    }

    /**
     * Route to class
     */
    protected function route($config)
    {
        if (in_array($config['type'], ['post-type', 'cpt', 'posttype', 'post_type'])) {
            (new PostType($config))->run();
        }
        if (in_array($config['type'], ['taxonomy', 'tax', 'category', 'cat', 'tag'])) {
            (new Taxonomy($config))->run();
        }
    }
}
