<?php
/**
 * Plugin Name: Bookeo for CAOS
 * Description: Add Bookeo compatibility to CAOS
 * Version: 1.0.0
 * Author: Daan van den Bergh
 * Author URI: https://woosh.dev
 * License: GPL2v2 or later
 */

define('BOOKEO_PLUGIN_FILE', __FILE__);

/**
 * Add allowLinker: true to ga('create') configuration.
 *
 * @param $config
 *
 * @return array
 */
function caos_add_bookeo_to_ga_config($config)
{
    return $config + array('allowLinker' => true);
}
add_filter('caos_analytics_ga_create_config', 'caos_add_bookeo_to_ga_config');

/**
 * Add 'require': 'linker' and 'linker:autoLink', ['bookeo.com'] before send.
 *
 * @param $config
 * @param $trackingId
 *
 * @return array
 */
function caos_add_bookeo($config, $trackingId)
{
    return $config + array(
            "ga('require', 'linker');",
            "ga('linker:autoLink', ['bookeo.com']);"
        );
}
add_filter('caos_analytics_before_send', 'caos_add_bookeo', 10, 2);
