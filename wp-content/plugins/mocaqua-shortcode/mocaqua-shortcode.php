<?php
/**
 
* Plugin Name: Mocaqua shortcodes
 
* Plugin URI: #
 
* Description: A plugin to create custom post type, metabox, shortcode... for Bolder theme
 
* Version:  1.0
 
* Author: CoronaThemes
 
* Author URI: #
 
* License:  GPL2
 
*/

/**
 * Initialise the internationalisation domain
 */

//load_plugin_textdomain('bolder', 'wp-content/plugins/mocaqua-shortcode/languages','mocaqua-shortcode/languages');

/**
 * Include files
 */

define('MOCAQUA_SHORTCODE_VERSION', 1.0);
define('MOCAQUA_SHORTCODE', plugin_dir_path( __FILE__ ));

include MOCAQUA_SHORTCODE . '/shortcode/shortcodes.php';
include MOCAQUA_SHORTCODE . '/shortcode/vc-functions.php';

return true;