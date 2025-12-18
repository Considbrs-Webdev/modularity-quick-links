<?php

/**
 * Plugin Name:       Modularity Quick Links
 * Plugin URI:        https://github.com/Considbrs-Webdev/modularity-quick-links.git
 * Description:       A module for Modularity that creates the ability for the user to create a grid of cards that link to important pages.
 * Version: 1.0.0
 * Author:            Consid Borås AB
 * Author URI:        https://github.com/Considbrs-Webdev
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       modularity-quick-links
 * Domain Path:       /languages
 */

// Protect agains direct file access
if (!defined('WPINC')) {
    die;
}

define('MODULARITY_QUICK_LINKS_PATH', plugin_dir_path(__FILE__));
define('MODULARITY_QUICK_LINKS_URL', plugins_url('', __FILE__));
define('MODULARITY_QUICK_LINKS_VIEW_PATH', MODULARITY_QUICK_LINKS_PATH . 'views/');
define('MODULARITY_QUICK_LINKS_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('MODULARITY_QUICK_LINKS_MODULE_PATH', MODULARITY_QUICK_LINKS_PATH . 'source/php/Module/');

add_action('init', function() {
    load_plugin_textdomain('modularity-quick-links', false, plugin_basename(dirname(__FILE__)) . '/languages');
}); 

// Autoload from plugin
if (file_exists(MODULARITY_QUICK_LINKS_PATH . 'vendor/autoload.php')) {
    require_once MODULARITY_QUICK_LINKS_PATH . 'vendor/autoload.php';
}
require_once MODULARITY_QUICK_LINKS_PATH . 'Public.php';

// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-quick-links');
    $acfExportManager->setExportFolder(MODULARITY_QUICK_LINKS_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'settings' => 'group_69445f2589f85'
    ));
    $acfExportManager->import();
}); 

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-quick-links'] = MODULARITY_QUICK_LINKS_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new ModularityQuickLinks\App();
