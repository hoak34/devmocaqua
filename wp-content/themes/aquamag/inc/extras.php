<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since  1.0.0
 * @param  array $args Configuration arguments.
 * @return array
 */
function aquamag_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'aquamag_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function aquamag_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of boxed layout.
	if ( of_get_option( 'aquamag_site_layouts', 'boxed' ) == 'boxed' ) {
		$classes[] = 'box';
	}

	if ( of_get_option( 'aquamag_home_ads_3' ) ) {
		$classes[] = 'last-ad';
	}

	return $classes;
}
add_filter( 'body_class', 'aquamag_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function aquamag_post_classes( $classes ) {

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	// Grid list.
	$layout = of_get_option( 'aquamag_posts_layout', 'list' );
	if ( is_home() || is_archive() || is_search() || is_author() ) {
		if ( $layout === 'grid' ) {
			$classes[] = 'one-third';
		} else {
			$classes[] = 'full-list';
		}
	}

	$classes[] = 'uk-clearfix';

	return $classes;
}
add_filter( 'post_class', 'aquamag_post_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since  1.0.0
 * @param  string $title Default title text for current view.
 * @param  string $sep Optional separator.
 * @return string The filtered title.
 */
function aquamag_wp_title( $title, $sep ) {

	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'aquamag' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'aquamag_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @since  1.0.0
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function aquamag_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'aquamag_setup_author' );

/**
 * Generates the relevant template info. Adds template meta with theme version. Uses the theme 
 * name and version from style.css.
 *
 * @since 1.0.0
 */
function aquamag_meta_template() {
	$theme    = wp_get_theme( get_template() );
	$template = sprintf( '<meta name="template" content="%1$s %2$s" />' . "\n", esc_attr( $theme->get( 'Name' ) ), esc_attr( $theme->get( 'Version' ) ) );

	echo apply_filters( 'aquamag_meta_template', $template );
}
add_action( 'wp_head', 'aquamag_meta_template', 10 );

/**
 * Removes default styles set by WordPress recent comments widget.
 *
 * @since 1.0.0
 */
function aquamag_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'aquamag_remove_recent_comments_style' );

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 * @return string
 */
function aquamag_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'aquamag_excerpt_more' );

/**
 * Control the excerpt length.
 *
 * @since  1.0.0
 * @param  $length
 */
function aquamag_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'aquamag_excerpt_length', 999 );

/**
 * Override the default options.php location.
 *
 * @since  1.0.0
 */
function aquamag_location_override() {
	return array( 'admin/options.php' );
}
add_filter( 'options_framework_location', 'aquamag_location_override' );

/**
 * Change the theme options text.
 *
 * @since  1.0.0
 * @param  array $menu
 */
function aquamag_theme_options_text( $menu ) {
	$menu['page_title'] = '';
	$menu['menu_title'] = __( 'Theme Settings', 'aquamag' );

	return $menu;
}
add_filter( 'optionsframework_menu', 'aquamag_theme_options_text' );

/**
 * Custom RSS feed url.
 *
 * @since  1.0.0
 * @return string
 */
function aquamag_feed_url( $output, $feed ) {

	// Get the custom rss feed url.
	$url = of_get_option( 'aquamag_feedburner_url' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( !empty( $url ) ) {
		$output = $url;
	}

	return $output;
}
add_filter( 'feed_link', 'aquamag_feed_url', 10, 2 );

/**
 * Register custom contact info fields.
 *
 * @since  1.0.0
 * @param  array $contactmethods
 * @return array
 */
function aquamag_contact_info_fields( $contactmethods ) {
	$contactmethods['facebook']  = __( 'Facebook URL', 'aquamag' );
	$contactmethods['twitter']   = __( 'Twitter URL', 'aquamag' );
	$contactmethods['gplus']     = __( 'Google Plus URL', 'aquamag' );
	$contactmethods['pinterest'] = __( 'Pinterest URL', 'aquamag' );
	$contactmethods['linkedin']  = __( 'LinkedIn URL', 'aquamag' );
	$contactmethods['tumblr']    = __( 'Tumblr URL', 'aquamag' );
	$contactmethods['vimeo']     = __( 'Vimeo URL', 'aquamag' );
	$contactmethods['instagram'] = __( 'Instagram URL', 'aquamag' );
	$contactmethods['feed']      = __( 'Blog Feed URL', 'aquamag' );

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'aquamag_contact_info_fields' );

/**
 * Change the default tag cloud widget args.
 *
 * @since  1.0.0
 * @param  array  $args
 * @return array
 */
function aquamag_widget_tag_cloud_args( $args ) {
	$args['number']   = 20;
	$args['largest']  = 12;
	$args['smallest'] = 12;
	$args['unit']     = 'px';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'aquamag_widget_tag_cloud_args' );

/**
 * Custom comment form fields.
 *
 * @since  1.0.0
 * @param  array $fields
 * @return array
 */
function aquamag_comment_form_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$fields['author'] = '<p><input class="comment-name" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Name (required)', 'aquamag' ) . '"' . $aria_req . ' /></p>';

	$fields['email'] = '<p><input class="comment-email" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Email (required)', 'aquamag' ) . '"' . $aria_req . ' /></p>';

	$fields['url'] = '<p><input class="comment-website" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_attr__( 'Website (optional)', 'aquamag' ) . '" /></p>';

	return $fields;

}
add_filter( 'comment_form_default_fields', 'aquamag_comment_form_fields' );