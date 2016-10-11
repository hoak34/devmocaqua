<?php
/**
 * Enqueue scripts and styles.
 *
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function aquamag_enqueue() {

	// Load theme fonts.
	wp_enqueue_style( 'aquamag-fonts', aquamag_font_url(), array(), null );

	// Load framework stylesheet.
	wp_enqueue_style( 'aquamag-uikit', trailingslashit( get_template_directory_uri() ) . 'assets/css/uikit.min.css' );

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet.
		wp_enqueue_style( 'aquamag-style', get_stylesheet_uri() );

		// Load custom js plugins.
		wp_enqueue_script( 'aquamag-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.js', array( 'jquery' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'aquamag-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery' ), null, true );

	} else {

		// Load main stylesheet.
		wp_enqueue_style( 'aquamag-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css' );

		// If child theme is active, load the stylesheet.
		if ( is_child_theme() ) {
			wp_enqueue_style( 'aquamag-child-style', get_stylesheet_uri() );
		}

		// Load custom js plugins.
		wp_enqueue_script( 'aquamag-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/aquamag.min.js', array( 'jquery' ), null, true );

	}

	// Load colors stylesheet.
	wp_enqueue_style( 'aquamag-colors', trailingslashit( get_template_directory_uri() ) . 'assets/colors/color-default.css' );

	// Custom jquery plugin for google maps.
	if ( is_page_template( 'page-templates/contact.php' ) ) {
		wp_enqueue_script( 'aquamag-maps', trailingslashit( get_template_directory_uri() ) . 'assets/js/gmaps.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'aquamag-gmaps', 'http://maps.google.com/maps/api/js?sensor=true', array( 'jquery' ), null, false );
	}

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'aquamag_enqueue' );

/**
 * Loads HTML5 Shiv & Respond js file.
 * 
 * @since  1.0.0
 */
function aquamag_special_scripts() {
?>
<!--[if lte IE 9]>
<script src="<?php echo trailingslashit( get_template_directory_uri() ) . 'assets/js/html5shiv.js'; ?>"></script>
<![endif]-->
<?php
}
add_action( 'wp_head', 'aquamag_special_scripts', 15 );

/**
 * js / no-js script.
 *
 * @since  1.0.0
 */
function aquamag_no_js_script() {
?>
<script>document.documentElement.className = 'js';</script>
<?php
}
add_action( 'wp_footer', 'aquamag_no_js_script' );