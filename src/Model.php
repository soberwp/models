<?php

namespace Sober\Models;

class Model
{
    protected $data;

    // data req for register_post_type() and register_taxonomy()
    protected $name;
    protected $args;

    // data req for computations
    protected $config = [];
    protected $labels = [];
    protected $one;
    protected $many;
    protected $i18n;

    public function __construct($data)
    {
        $this->data = $data;
        
        if ($this->isDisabled()) return;

        $this->setName();
        $this->setLabelOne();
        $this->setLabelMany();
        $this->setLabeli18n();
    }

    /**
     * Check to see if model has been disabled
     *
     * @return boolean
     */
    protected function isDisabled()
    {
        return (($this->data['active'] === false) ? true : false);
    }

    /**
     * Set name
     *
     * Required to register post type
     */
    protected function setName()
    {
        $this->name = $this->data['name'];
    }

    /**
     * Set config
     *
     * Merge and/or replace defaults with user config
     */
    protected function setConfig()
    {
        if ($this->data['config']) {
            $this->config = array_replace($this->config, $this->data['config']);
        }
    }

    /**
     * Set singular label defaults
     *
     * If key labels.has-one doesn't exist, use post type name
     */
    protected function setLabelOne()
    {
        $this->one = ($this->data['labels.has_one'] ? $this->data['labels.has_one'] : ucfirst($this->name));
    }

    /**
     * Set plural label defaults
     *
     * If key labels.has-many doesn't exist, use post type name and append 's'
     */
    protected function setLabelMany()
    {
        $this->many = ($this->data['labels.has_many'] ? $this->data['labels.has_many'] : ucfirst($this->name . 's'));
    }

    /**
     * Set text domain for labels
     *
     * If key labels.text-domain doesn't exist, set to 'sober'
     */
    protected function setLabeli18n()
    {
        $this->i18n = ($this->data['labels.text_domain'] ? $this->data['labels.text_domain'] : 'sober');
    }

    /**
     * Set default label overrides
     *
     * If key labels.overrides exists, add to or replace label defaults
     */
    protected function setLabels()
    {
        if ($this->data['labels.overrides']) {
            $this->labels = array_replace($this->labels, $this->data['labels.overrides']);
        }
    }
}
