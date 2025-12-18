<?php

namespace ModularityQuickLinks\Module;

class QuickLinks extends \Modularity\Module
{
    public $slug = 'quick-links';
    public $icon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMyA5SDEuNVYxMkgzVjlaTTMgMTVIMS41VjE4SDNWMTVaTTMgNkgxLjVWM0gzVjZaTTcuNSA2SDIyLjVWM0g3LjVWNk03LjUgMTJIMjIuNVY5SDcuNVYxMk03LjUgMThIMjIuNVYxNUg3LjVWMThaIi8+PC9zdmc+';
    public $supports = array();

    public function init()
    {
        $this->nameSingular = __('Quick Links', 'modularity-quick-links');
        $this->namePlural = __('Quick Links', 'modularity-quick-links');
        $this->description = __('Display a list of quick links', 'modularity-quick-links');
    }

    public function data(): array
    {
        $fields = $this->getFields();

        $data = [
            'links' => !empty($fields['links']) ? $fields['links'] : [],
            'columns' => !empty($fields['columns']) ? $fields['columns'] : '2',
        ];

        return $data;
    }

    /**
     * Blade Template
     * @return string
     */
    public function template(): string
    {
        return 'quick-links.blade.php';
    }

    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization (if you must, use __construct with care, this will probably break stuff!!)
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}
