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
        // Enqueue editor styles for the block editor
        add_action('enqueue_block_editor_assets', array($this, 'addEditorStyles'));
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

    public function addEditorStyles() {
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
}
