<?php

add_action( 'init', 'mocaqua_register_vc_shortcodes' , 10000);
function mocaqua_register_vc_shortcodes() {
	if (class_exists('Vc_Manager')) {
		
	$tags = array(__('Select tag', 'mocaqua-shortcode'));
	$tags_obj = get_tags();
	foreach ( $tags_obj as $tag ) {
		$tags[esc_html( $tag->name )] = $tag->term_id;
	}

	$categories = array(__('Select category', 'mocaqua-shortcode'));
	$categories_obj = get_categories();
	foreach ( $categories_obj as $category ) {
		$categories[esc_html( $category->cat_name )] = $category->cat_ID;
	}
		
//******************************************************************************************************/
// featured_posts
//******************************************************************************************************/
		
		vc_map( array(
			"name" => __("Featured posts", 'mocaqua-shortcode'),
			"description" => "Display featured posts",
			"base" => "mocaqua_featured_posts",
			"class" => "",
			"category" => __("For mocaqua theme", 'mocaqua-shortcode'),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose category', 'mocaqua-shortcode' ),
					'param_name' => 'category',
					'value' => $categories,
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose tag', 'mocaqua-shortcode' ),
					'param_name' => 'tag',
					'value' => $tags,
				),
			)
		) );
//******************************************************************************************************/
// Popular + lastest post
//******************************************************************************************************/
	vc_map( array(
		"name" => __("Popular + lastest post",'mocaqua-shortcode'),
		"base" => "mocaqua_popular_lastest_posts",
		"category" => __('For mocaqua theme','mocaqua-shortcode'),
		"params" => array(
		)
	));

			
//******************************************************************************************************/
// Category posts
//******************************************************************************************************/
		
		vc_map( array(
			"name" => __("Category posts", 'mocaqua-shortcode'),
			"description" => "Category posts",
			"base" => "mocaqua_category_posts",
			"class" => "",
			"category" => __("For mocaqua theme", 'mocaqua-shortcode'),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose category', 'mocaqua-shortcode' ),
					'param_name' => 'category',
					'value' => $categories,
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Max category children', 'mocaqua-shortcode' ),
					'param_name' => 'max_child',
					'value' => '',
				),
			)
		) );
		
//******************************************************************************************************/
// Category lists
//******************************************************************************************************/
		
		vc_map( array(
			"name" => __("Category lists", 'mocaqua-shortcode'),
			"description" => "Category lists",
			"base" => "mocaqua_category_lists",
			"class" => "",
			"category" => __("For mocaqua theme", 'mocaqua-shortcode'),
			"params" => array(
				array(
					'type' => 'checkbox',
					'heading' => __( 'Choose categories', 'mocaqua-shortcode' ),
					'param_name' => 'categories',
					'value' => $categories,
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'mocaqua-shortcode' ),
					'param_name' => 'title',
					'value' => 'All categories',
				),
			)
		) );
	}
}
?>