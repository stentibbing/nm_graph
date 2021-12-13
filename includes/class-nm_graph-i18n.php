<?php

/**
 * Define the internationalization functionality
 */
class Nm_graph_i18n
{


    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain(
            'nm_graph',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
