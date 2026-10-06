<?php

namespace ModularityQuickLinks;

use ModularityQuickLinks\AcfFields\AcfFieldLoader;
use ModularityQuickLinks\Helper\CacheBust;

class App
{
    public function __construct()
    {
        // Register module
        add_action('init', array($this, 'registerModule'));
        // Iframed block canvas. enqueue_block_editor_assets never reaches the preview.
        add_action('enqueue_block_assets', array($this, 'addEditorStyles'));
        add_filter('Pitea/Editor/ModuleStyles', array($this, 'registerEditorStyle'));
    }

    /**
     * Register the module
     * @return void
     */
    public function registerModule()
    {
        if (function_exists('modularity_register_module')) {
            modularity_register_module(
                MODULARITY_QUICK_LINKS_MODULE_PATH,
                'QuickLinks'
            );
        }
    }

    /**
     * Register the module stylesheet for the shared editor-canvas loader.
     *
     * @param array<string, string> $styles
     * @return array<string, string>
     */
    public function registerEditorStyle(array $styles): array
    {
        $url = $this->stylesheetUrl();
        if ($url !== '') {
            $styles['modularity-quick-links'] = $url;
        }

        return $styles;
    }

    /**
     * Enqueue the module stylesheet inside the block editor iframe.
     *
     * @return void
     */
    public function addEditorStyles(): void
    {
        if (!is_admin() || wp_style_is('modularity-quick-links', 'enqueued')) {
            return;
        }

        $url = $this->stylesheetUrl();
        if ($url === '') {
            return;
        }

        wp_enqueue_style('modularity-quick-links', $url, [], null);
    }

    /**
     * Built stylesheet URL, or an empty string when the Vite manifest has no entry.
     */
    private function stylesheetUrl(): string
    {
        $styleFile = CacheBust::name('css/modularity-quick-links.css');
        if (!$styleFile) {
            return '';
        }

        return MODULARITY_QUICK_LINKS_URL . '/assets/dist/' . $styleFile;
    }
}
