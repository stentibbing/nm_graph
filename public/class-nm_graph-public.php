<?php

/**
 * The public-facing functionality of the plugin.
 */
class Nm_graph_Public
{
    /**
     * The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/nm_graph-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script('amcharts_core', plugin_dir_url(__FILE__) . 'js/lib/core.js', array( ), $this->version, false);
        wp_enqueue_script('amcharts_charts', plugin_dir_url(__FILE__) . 'js/lib/charts.js', array( 'amcharts_core' ), $this->version, false);
        wp_enqueue_script('amcharts_animated', plugin_dir_url(__FILE__) . 'js/lib/animated.js', array( 'amcharts_core' ), $this->version, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/nm_graph-public.js', array( 'amcharts_core', 'amcharts_charts', 'amcharts_animated' ), $this->version, false);
    }

    /**
     * Register public shortcodes
     */
    public function add_shortcodes()
    {
        add_shortcode('nm_graph', array($this, 'render_graph' ));
    }

    /**
     * Render the graph
     */
    public function render_graph()
    {
        return require plugin_dir_path(__FILE__) . '/partials/nm_graph-public-display.php';
    }
}
