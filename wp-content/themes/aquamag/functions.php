<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 * 
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'aquamag_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function aquamag_theme_setup() {

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 780; /* pixels */
	}

	// Make the theme available for translation.
	load_theme_textdomain( 'aquamag', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css', aquamag_font_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare image sizes.
	add_image_size( 'aquamag-thumb', 439, 285, true );
	add_image_size( 'aquamag-mm-thumb', 180, 108, true );
	add_image_size( 'aquamag-widget-thumb', 45, 45, true );
	add_image_size( 'aquamag-widget-slide', 132, 87, true );
	add_image_size( 'aquamag-featured', 546, 276, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary'   => __( 'Primary Menu', 'aquamag' ),
			'secondary' => __( 'Secondary Menu' , 'aquamag' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aquamag_custom_background_args', array(
		'default-color'       => '232f46',
		'default-image'       => '%1$s/assets/img/bg.jpg',
		'default-repeat'      => 'no-repeat',
		'default-position-x'  => 'center',
		'default-attachment'  => 'fixed',
		'admin-head-callback' => 'aquamag_admin_bg_style',
	) ) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // aquamag_theme_setup
add_action( 'after_setup_theme', 'aquamag_theme_setup' );

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function aquamag_widgets_init() {

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-ads.php';
	register_widget( 'AquaMag_Ads_Widget' );

	// Register ad 125 widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-ads125.php';
	register_widget( 'AquaMag_Ads125_Widget' );

	// Register feedburner widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-feedburner.php';
	register_widget( 'AquaMag_Feedburner_Widget' );

	// Register recent posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-recent.php';
	register_widget( 'AquaMag_Recent_Widget' );

	// Register popular posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-popular.php';
	register_widget( 'AquaMag_Popular_Widget' );

	// Register most views posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-views.php';
	register_widget( 'AquaMag_Views_Widget' );

	// Register random posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-random.php';
	register_widget( 'AquaMag_Random_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-video.php';
	register_widget( 'AquaMag_Video_Widget' );

	// Register tabs widget.
	// require trailingslashit( get_template_directory() ) . 'inc/classes/widget-tabs.php';
	// register_widget( 'AquaMag_Tabs_Widget' );

	// Register flickr widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-flickr.php';
	register_widget( 'AquaMag_Flickr_Widget' );

	// Register posts slider widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-posts-slide.php';
	register_widget( 'AquaMag_Posts_Slide_Widget' );

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'aquamag' ),
			'id'            => 'primary',
			'description'   => __( 'Main sidebar that appears on the right.', 'aquamag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="title-section uk-clearfix"><h4 class="lead-title">',
			'after_title'   => '</h4><div class="white-line uk-clearfix"></div></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'aquamag' ),
			'id'            => 'footer-1',
			'description'   => __( 'The footer sidebar.', 'aquamag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="footer-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'aquamag' ),
			'id'            => 'footer-2',
			'description'   => __( 'The footer sidebar.', 'aquamag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="footer-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'aquamag' ),
			'id'            => 'footer-3',
			'description'   => __( 'The footer sidebar.', 'aquamag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="footer-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'aquamag' ),
			'id'            => 'footer-4',
			'description'   => __( 'The footer sidebar.', 'aquamag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="footer-title">',
			'after_title'   => '</h3>',
		)
	);
	
}
add_action( 'widgets_init', 'aquamag_widgets_init' );

/**
 * Register Oswald Google font.
 *
 * @since  1.0.0
 * @return string
 */
function aquamag_font_url() {
	
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Oswald, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'aquamag' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Oswald' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Styles the background image displayed on the Appearance > Background admin panel.
 *
 * Referenced via add_theme_support('custom-background') in aquamag_theme_setup().
 *
 * @since  1.0.0
 */
function aquamag_admin_bg_style() {
?>
	<style type="text/css" id="aquamag-admin-bg-css">
	#custom-background-image {
		max-height: 300px;
	}
	</style>
<?php
}

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/loop-pagination.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/entry-views.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/hybrid-media-grabber.php';

/**
 * Load Options Framework core.
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'admin/' );
require trailingslashit( get_template_directory() ) . 'admin/options-framework.php';
require trailingslashit( get_template_directory() ) . 'admin/options-functions.php';

/**
 * Custom menu walker.
 */
require trailingslashit( get_template_directory() ) . 'inc/classes/class-aquamag-walker.php';
require trailingslashit( get_template_directory() ) . 'inc/classes/class-aquamag-mobile-walker.php';
require trailingslashit( get_template_directory() ) . 'inc/classes/class-aquamag-megamenu-walker.php';