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
            'navId' => 'quick-links-' . ($this->ID ?: uniqid()),
            'maxItemsPerRow' => !empty($fields['max_items_per_row']) ? (int) $fields['max_items_per_row'] : 4,
            'useIcons' => !empty($fields['use_icons']),
            'useShortDescription' => !empty($fields['use_short_description']),
            'largeIcons' => !empty($fields['large_icons']),
            'links' => $this->parseLinks($fields['links'] ?? []),
            'gap' => isset($fields['link_gap']) && $fields['link_gap'] !== '' ? (int) $fields['link_gap'] : 0,
            'quickLinksRootStyle' => '',
        ];

        return $data;
    }

    /**
     * Parse and format the links repeater field
     * @param array $links
     * @return array
     */
    private function parseLinks(array $links): array
    {
        if (empty($links)) {
            return [];
        }

        return array_map(function ($link) {
            $hrefTarget = $this->parseAcfLinkField($link['link'] ?? null);

            return [
                'icon' => $link['icon'] ?? '',
                'title' => $link['title'] ?? '',
                'link' => $hrefTarget['url'],
                'target' => $hrefTarget['target'],
                'description' => $link['description'] ?? '',
            ];
        }, $links);
    }

    /**
     * ACF link fields return ['url' => string, 'title' => string, 'target' => '_blank'|''].
     *
     * @param array|string|null $linkField
     * @return array{url: string, target: string}
     */
    private function parseAcfLinkField($linkField): array
    {
        if (is_array($linkField)) {

            return [
                'url' => isset($linkField['url']) ? (string) $linkField['url'] : '',
                'target' => isset($linkField['target']) ? (string) $linkField['target'] : '',
            ];
        }

        if (is_string($linkField)) {
            return ['url' => $linkField, 'target' => ''];
        }
        return ['url' => '', 'target' => ''];
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
     * Enqueue styles
     * @return void
     */
    public function style(): void
    {
        $styleFile = \ModularityQuickLinks\Helper\CacheBust::name('css/modularity-quick-links.css');

        if ($styleFile) {
            wp_enqueue_style(
                'modularity-quick-links',
                MODULARITY_QUICK_LINKS_URL . '/assets/dist/' . $styleFile,
                [],
                null
            );
        }
    }

    /**
     * Enqueue scripts
     * @return void
     */
    /* public function script(): void
    {
        $scriptFile = \ModularityQuickLinks\Helper\CacheBust::name('js/modularity-quick-links.js');

        if ($scriptFile) {
            wp_enqueue_script(
                'modularity-quick-links',
                MODULARITY_QUICK_LINKS_URL . '/assets/dist/' . $scriptFile,
                [],
                null,
                true
            );
        }
    } */

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
