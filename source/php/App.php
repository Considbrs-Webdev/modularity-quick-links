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
     * Enqueue the module stylesheet inside the block editor iframe.
     *
     * @return void
     */
    public function addEditorStyles(): void
    {
        if (!is_admin()) {
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
