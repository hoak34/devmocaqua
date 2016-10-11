<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower( $themename ) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );

}

/**
 * Defines an array of options that will be used to generate the settings page 
 * and be saved in the database.
 *
 * @since  1.0.0
 * @access public
 */
function optionsframework_options() {

	$options = array();

	// Pull all tags into an array.
	$tags = array();
	$tags_obj = get_tags();
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_html( $tag->name );
	}

	// Pull all the categories into an array
	$categories = array();
	$categories_obj = get_categories();
	foreach ( $categories_obj as $category ) {
		$categories[$category->cat_ID] = esc_html( $category->cat_name );
	}

	// Background thumbnail path.
	$imgpath =  get_template_directory_uri() . '/assets/img/bg/';

	$options = array();

	$options[] = array(
		'name' => __( 'General', 'aquamag' ),
		'type' => 'heading'
	);

	$options['aquamag_logo'] = array(
		'name' => __( 'Logo Uploader', 'aquamag' ),
		'desc' => __( 'Upload your custom logo, it will automatically replace the Site Title', 'aquamag' ),
		'id'   => 'aquamag_logo',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Favicon Uploader', 'aquamag' ),
		'desc' => __( 'Upload your custom favicon.', 'aquamag' ),
		'id'   => 'aquamag_favicon',
		'type' => 'upload'
	);

	$options[] = array(
		'name'  => __( 'FeedBurner URL', 'aquamag' ),
		'desc'  => __( 'Enter your full FeedBurner URL. If you wish to use FeedBurner over the standard WordPress feed.', 'aquamag' ),
		'id'    => 'aquamag_feedburner_url',
		'placeholder' => 'http://feeds.feedburner.com/ThemeJunkie',
		'type'  => 'text'
	);

	$options[] = array(
		'name'    => __( 'Boxed or Fullwidth', 'aquamag' ),
		'desc'    => __( 'Site layouts.', 'aquamag' ),
		'id'      => 'aquamag_site_layouts',
		'std'     => 'boxed',
		'type'    => 'radio',
		'options' => array(
			'boxed' => __( 'Boxed', 'aquamag' ),
			'full'  => __( 'Fullwidth', 'aquamag' )
		)
	);

	$options[] = array(
		'name'    => __( 'Posts List Layout', 'aquamag' ),
		'desc'    => __( 'Layout of the posts list on archive and search page.', 'aquamag' ),
		'id'      => 'aquamag_posts_layout',
		'std'     => 'list',
		'type'    => 'radio',
		'options' => array(
			'list' => __( 'List View', 'aquamag' ),
			'grid' => __( 'Grid View', 'aquamag' )
		)
	);

	$options[] = array(
		'name' => __( 'Home Page', 'aquamag' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Display Featured Posts', 'aquamag' ),
		'desc' => __( 'Enable the Featured Posts area on home page and category page.', 'aquamag' ),
		'id'   => 'aquamag_enable_featured',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name'    => __( 'Featured Posts Tag', 'aquamag' ),
		'desc'    => __( 'Select a tag to be used as Featured Posts.', 'aquamag' ),
		'id'      => 'aquamag_featured_tag',
		'type'    => 'select',
		'options' => $tags
	);

	$options[] = array(
		'name'    => __( 'First Category Posts Area', 'aquamag' ),
		'desc'    => __( 'Select a category.', 'aquamag' ),
		'id'      => 'aquamag_first_cat',
		'type'    => 'select',
		'options' => $categories
	);

	$options[] = array(
		'name'    => __( 'Second Category Posts Area', 'aquamag' ),
		'desc'    => __( 'Select a category.', 'aquamag' ),
		'id'      => 'aquamag_second_cat',
		'type'    => 'select',
		'options' => $categories
	);

	$options[] = array(
		'name'    => __( 'Third Category Posts Area', 'aquamag' ),
		'desc'    => __( 'Select a category.', 'aquamag' ),
		'id'      => 'aquamag_third_cat',
		'type'    => 'select',
		'options' => $categories
	);

	$options[] = array(
		'name'    => __( 'Fourth Category Posts Area', 'aquamag' ),
		'desc'    => __( 'Select a category.', 'aquamag' ),
		'id'      => 'aquamag_fourth_cat',
		'type'    => 'select',
		'options' => $categories
	);

	$options[] = array(
		'name' => __( 'Single Post', 'aquamag' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Display author info ', 'aquamag' ),
		'desc' => __( 'Enable the author biographical info.', 'aquamag' ),
		'id'   => 'aquamag_post_author',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Display share links', 'aquamag' ),
		'desc' => __( 'Enable the share links.', 'aquamag' ),
		'id'   => 'aquamag_post_share',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Display related posts', 'aquamag' ),
		'desc' => __( 'Enable the related posts.', 'aquamag' ),
		'id'   => 'aquamag_related_posts',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Before Content Advertisement', 'aquamag' ),
		'desc' => __( 'Your ad will appear on single post before content.', 'aquamag' ),
		'id'   => 'aquamag_ad_single_before',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'After Content Advertisement', 'aquamag' ),
		'desc' => __( 'Your ad will appear on single post after content.', 'aquamag' ),
		'id'   => 'aquamag_ad_single_after',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Social Links', 'aquamag' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '',
		'desc' => __( 'The social links will appear at the top of your site.', 'aquamag' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Enable ', 'aquamag' ),
		'desc' => __( 'Enable social links', 'aquamag' ),
		'id'   => 'aquamag_enable_social',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Facebook', 'aquamag' ),
		'desc' => __( 'Facebook profile url', 'aquamag' ),
		'id'   => 'aquamag_fb',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Twitter', 'aquamag' ),
		'desc' => __( 'Twitter profile url', 'aquamag' ),
		'id'   => 'aquamag_tw',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Google Plus', 'aquamag' ),
		'desc' => __( 'Google Plus profile url', 'aquamag' ),
		'id'   => 'aquamag_gplus',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'LinkedIn', 'aquamag' ),
		'desc' => __( 'LinkedIn profile url', 'aquamag' ),
		'id'   => 'aquamag_linkedin',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Flickr', 'aquamag' ),
		'desc' => __( 'Flickr profile url', 'aquamag' ),
		'id'   => 'aquamag_flickr',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Dribbble', 'aquamag' ),
		'desc' => __( 'Dribbble profile url', 'aquamag' ),
		'id'   => 'aquamag_dribbble',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Instgram', 'aquamag' ),
		'desc' => __( 'Instgram profile url', 'aquamag' ),
		'id'   => 'aquamag_instagram',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Youtube', 'aquamag' ),
		'desc' => __( 'Youtube profile url', 'aquamag' ),
		'id'   => 'aquamag_youtube',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Vimeo', 'aquamag' ),
		'desc' => __( 'Vimeo profile url', 'aquamag' ),
		'id'   => 'aquamag_vimeo',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Contact', 'aquamag' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Latitude ', 'aquamag' ),
		'desc' => '',
		'id'   => 'aquamag_lat',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Longitude ', 'aquamag' ),
		'desc' => '',
		'id'   => 'aquamag_lng',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => __( 'Alternate contact informations. It will appear below the map.', 'aquamag' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Title', 'aquamag' ),
		'desc' => '',
		'id'   => 'aquamag_contact_info_title',
		'std'  => __( 'Get in Touch', 'aquamag' ),
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Description', 'aquamag' ),
		'desc' => '',
		'id'   => 'aquamag_contact_info_desc',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Address', 'aquamag' ),
		'desc' => '',
		'id'   => 'aquamag_contact_info_addr',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Phone', 'aquamag' ),
		'desc' => '',
		'id'   => 'aquamag_contact_info_phone',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Email', 'aquamag' ),
		'desc' => '',
		'id'   => 'aquamag_contact_info_email',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Name', 'aquamag' ),
		'desc' => '',
		'id'   => 'aquamag_contact_info_name',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Advertisement', 'aquamag' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Home Page Advertisement', 'aquamag' ),
		'desc' => __( 'The ad will appear below the featured posts on home page. Recommended size 728x90', 'aquamag' ),
		'id'   => 'aquamag_home_ads',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Home Page Advertisement', 'aquamag' ),
		'desc' => __( 'The ad will appear below the second category posts. Recommended size 728x90', 'aquamag' ),
		'id'   => 'aquamag_home_ads_2',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Home Page Advertisement', 'aquamag' ),
		'desc' => __( 'The ad will appear at the bottom. Recommended size 728x90', 'aquamag' ),
		'id'   => 'aquamag_home_ads_3',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Custom Code', 'aquamag' ),
		'type' => 'heading'
	);

	$options['aquamag_script_head'] = array(
		'name' => __( 'Header code', 'aquamag' ),
		'desc' => __( 'If you need to add custom scripts to your header (meta tag verification, google fonts url), you should enter them in the box. They will be added before &lt;/head&gt; tag', 'aquamag' ),
		'id'   => 'aquamag_script_head',
		'type' => 'textarea'
	);

	$options['aquamag_script_footer'] = array(
		'name' => __( 'Footer code', 'aquamag' ),
		'desc' => __( 'If you need to add custom scripts to your footer (like google analytic script), you should enter them in the box. They will be added before &lt;/body&gt; tag', 'aquamag' ),
		'id'   => 'aquamag_script_footer',
		'type' => 'textarea'
	);

	/* Return the theme settings data. */
	return $options;
}