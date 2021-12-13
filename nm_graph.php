<?php

/**
 * @link              https://www.taifuun.ee
 * @since             1.0.0
 * @package           Nm_graph
 *
 * @wordpress-plugin
 * Plugin Name:       Nordic Milk Graph
 * Plugin URI:        https://www.taifuun.ee
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Taifuun OÜ
 * Author URI:        https://www.taifuun.ee
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nm_graph
 * Domain Path:       /languages
 * GitHub Plugin URI: stentibbing/nm_products
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 */
define('NM_GRAPH_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 */
function activate_nm_graph()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-nm_graph-activator.php';
    Nm_graph_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_nm_graph()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-nm_graph-deactivator.php';
    Nm_graph_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_nm_graph');
register_deactivation_hook(__FILE__, 'deactivate_nm_graph');

/**
 * The core plugin class that is used to define internationalization,
 */
require plugin_dir_path(__FILE__) . 'includes/class-nm_graph.php';

/**
 * Begins execution of the plugin.
 */
function run_nm_graph()
{
    $plugin = new Nm_graph();
    $plugin->run();
}
run_nm_graph();
