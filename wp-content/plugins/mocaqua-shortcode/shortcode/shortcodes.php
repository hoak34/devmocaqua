<?php
/**
 
* Plugin Name: Theme shortcodes
 
* Plugin URI: #
 
* Description: A plugin shortcode... for theme
 
* Version:  1.0
 
* Author: CoronaThemes
 
* Author URI: #
 
* License:  GPL2
 
*/

if(!class_exists('bolder_shortcodes')):
	class mocaqua_shortcodes {
		//******************************************************************************************************/
		// Globals Function
		//******************************************************************************************************/
		public function getExtraClass( $el_class ) {
			$output = '';
			if ( $el_class != '' ) {
				$output = " " . str_replace( ".", "", $el_class );
			}
			return $output;
		}

		public function getCSSAnimation( $css_animation,$data_wow_delay,$data_wow_duration) {
			$output = '';
			if ( $css_animation != '' ) {
				wp_enqueue_script( 'waypoints' );
				$output .= 'wow  ' . $css_animation.'"';
				$output .= 'data-wow-duration="'.$data_wow_duration.'"';
				$output .= 'data-wow-delay="'.$data_wow_delay.'"';
			}
			return $output;
		}
		public function bolder_shortcode_custom_css_class( $param_value, $prefix = '' ) {
			$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';
			return $css_class;
		}
	}
endif;

class mocaqua_shortcodes_fe extends mocaqua_shortcodes {
	//******************************************************************************************************/
	// featured_posts
	//******************************************************************************************************/
	static function featured_posts( $atts , $content = null) {

		$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'mocaqua_featured_posts', $atts ) : $atts;

		$el_class = $html = $css ='';
		extract( shortcode_atts(
			array(
				'category'=>'',
				'tag'=>'',
			), $atts ));
		
		// Posts query arguments.
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 4
		);

		if ( ! empty( $tag ) ) {
			$args['tag_id'] = $tag;
		}

		if (  ! empty( $category ) ) {
			$args['cat'] = $category;
		}

		// The post query
		$featured = get_posts( $args );
		
		$html = '';
		if ( $featured ) :

		$html .= '<div class="slider uk-clearfix">';

			$html .= '<div class="main-slider">';
				$html .= '<div id="mainFlexslider" class="flexslider">';
					$html .= '<ul class="slides">';

						foreach ( $featured as $post ) :
							$html .= '<li>';
								if ( has_post_thumbnail( $post->ID ) ) {
									$html .=  '<a href="' . get_permalink( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, 'aquamag-featured', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
								}
								$html .= '<div class="slider-wraper">';
									$category = get_the_category();
									if ( $category && aquamag_categorized_blog() ) :
										$html .= '<span class="music">' . esc_attr( $category[0]->name ) . '</span>';
									endif;
									$html .= '<div class="slider-wraper-inner">';
										$html .= '<span class="rating"><i class="uk-icon-eye"></i> ' . do_shortcode( '[entry-views]' ) . '</span>';
										if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
											$html .= '<span class="comment"><i class="uk-icon-comment"></i> ' . get_comments_number( $post->ID ) . '</span>';
										endif;
										$html .= '<span class="slider-title"><a href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a></span>';
									$html .= '</div>';
								$html .= '</div>';
							$html .= '</li>';
						endforeach;

					$html .= '</ul>';
				$html .= '</div>';
			$html .= '</div>';

			$html .= '<div class="thumb-slider uk-hidden-small">';
				$html .= '<div id="carousel" class="flexslider">';
					$html .= '<ul class="tabs" id="main-slider-control-nav">';

						foreach ( $featured as $post ) :
							$html .= '<li><h3>' . get_the_title( $post->ID ) . '</h3></li>';
						endforeach;

					$html .= '</ul>';
				$html .= '</div>';
			$html .= '</div>';

		$html .= '</div><!-- #slider -->';

		// End check.
		endif;

		return $html;
	}

	//******************************************************************************************************/
	// popular_latest_posts
	//******************************************************************************************************/
	static function popular_lastest_posts( $atts , $content = null) {

		$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'mocaqua_popular_lastest_posts', $atts ) : $atts;
		$rand = rand(100, 100000);
		ob_start();
		?>
		<div class="recent-post border-style uk-clearfix">
				
				<ul class="uk-subnav uk-subnav-pill recent-post-tab uk-clearfix" data-uk-switcher="{connect:'#latest-post-content-<?php echo $rand; ?>'}">

					<li class="uk-active"><a href="#"><?php _e( 'Latest', 'aquamag' ); ?></a></li>

					<li class=""><a href="#"><?php _e( 'Popular', 'aquamag' ); ?></a></li>

				</ul>


				<div id="latest-post-content-<?php echo $rand; ?>" class="uk-switcher">

					<div class="uk-active uk-grid uk-clearfix"><?php aquamag_latest_posts_home(); ?></div>

					<div class="uk-grid uk-clearfix"><?php aquamag_popular_posts_home(); ?></div>

				</div>

			</div><!-- .recent-post -->
		<?php
		$html = ob_get_contents();
		ob_clean();
		
		return $html;
	}

//******************************************************************************************************/
// category_posts
//******************************************************************************************************/
	static function category_posts( $atts , $content = null) {

		$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'mocaqua_category_posts', $atts ) : $atts;

		$el_class = $html = '';

		extract( shortcode_atts(
			array(
				'category'=>'',
				'max_child'=>'',
			), $atts ));
		
		// Get the category.
		if($category){
			$category = get_category( $category );
			$rand = rand(100, 100000);
			$childs = get_categories ( array(
				'hide_empty' => true,
				'parent'     => $cat_id
			) );

			$cat_child = array( $cat_id );
			$rand = rand(100, 100000);	
			ob_start();
			?>
			<div class="recent-post border-style uk-clearfix">

				<div class="uk-grid">

					<div class="uk-width-2-10">
						<h4 class="post-title"><?php echo $category->name; ?></h4>
					</div>

					<div class="uk-width-8-10">
						<ul class="uk-tab recent-post-tab catagory-post-tab" data-uk-tab="{connect:'#catagory-post-content-<?php echo $rand; ?>'}">
							<?php if ( !empty( $childs ) ) : ?>
								<li class="uk-active"><a href="#"><?php _e( 'All', 'aquamag' ); ?></a></li>
							<?php endif; ?>
							<?php foreach ( $childs as $child ) : ?>
							<?php if($max_child && (count($cat_child) + 1) > $max_child){ break;} ?>
								<li><a href="#"><?php echo $child->name; ?></a></li>
								<?php $cat_child[] = $child->term_id; ?>
							<?php endforeach; ?>
						</ul>
					</div>

				</div><!-- .uk-grid -->

				<div id="catagory-post-content-<?php echo $rand; ?>" class="uk-switcher">
					
					<?php foreach ( $cat_child as $catID ) : ?>

						<div class="uk-grid uk-clearfix">

							<?php 
							// Query arguments.
							$query = array(
								'posts_per_page' => 2,
								'post_type'      => 'post',
								'cat'            => $catID,
								'post__not_in'   => get_option( 'sticky_posts' )
							);

							// Perform the query.
							$posts = new WP_Query( $query );

							if ( $posts->have_posts() ) {
							?>
								
								<div class="uk-width-1-1 uk-width-medium-2-3">
									<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
										<article class="two-third uk-clearfix">
											<?php aquamag_thumbnail(); // Get the thumbnail function. ?>
											<div class="article-text">
												<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
												<p><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
											</div>
										</article>
									<?php endwhile; ?>
								</div>

							<?php } wp_reset_postdata(); ?>

							<?php 
							// Query arguments.
							$query = array(
								'posts_per_page' => 1,
								'offset'         => 2,
								'post_type'      => 'post',
								'cat'            => $catID,
								'post__not_in'   => get_option( 'sticky_posts' )
							);

							// Perform the query.
							$posts = new WP_Query( $query );

							if ( $posts->have_posts() ) {
							?>
								<div class="uk-width-1-1 uk-width-medium-1-3">
									<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
										<article class="one-third uk-clearfix">
											<?php aquamag_thumbnail(); // Get the thumbnail function. ?>
											<div class="article-text">
												<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
												<p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
											</div>
										</article>
									<?php endwhile; ?>
								</div>

							<?php } wp_reset_postdata(); ?>
							
						</div>

					<?php endforeach; ?>

				</div><!-- #catagory-post-content -->

			</div><!-- .recent-post -->
			<?php
		}
		
		$html = ob_get_contents();
		ob_clean();
		
		return $html;

	}

	//******************************************************************************************************/
	// popular_latest_posts
	//******************************************************************************************************/
	static function category_lists( $atts , $content = null) {

		$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'mocaqua_category_lists', $atts ) : $atts;
		extract( shortcode_atts(
			array(
				'categories'=>'',
			), $atts ));

		$html = '';
		if($categories){
			//ob_start();
			$categories = explode(',', $categories);
			echo '<div class="recent-post border-style uk-clearfix">';
			foreach ($categories as $category){
				$category = get_category($category);
				$image = get_field('image', $category);
				var_dump($image);exit;
				?>
					<!--<ul class="uk-subnav uk-subnav-pill recent-post-tab uk-clearfix" data-uk-switcher="{connect:'#latest-post-content-<?php /*echo $rand; */?>'}">

						<li class="uk-active"><a href="#"><?php /*_e( 'Latest', 'aquamag' ); */?></a></li>

						<li class=""><a href="#"><?php /*_e( 'Popular', 'aquamag' ); */?></a></li>

					</ul>

					<div id="latest-post-content-<?php /*echo $rand; */?>" class="uk-switcher">

						<div class="uk-active uk-grid uk-clearfix"><?php /*aquamag_latest_posts_home(); */?></div>

						<div class="uk-grid uk-clearfix"><?php /*aquamag_popular_posts_home(); */?></div>

					</div>
-->
				<!-- .recent-post -->
				<?php

			}
			echo '</div>';
			//$html = ob_get_contents();
			//ob_clean();
		}
		return $html;
	}

//*********************************************End Shortcode ****************************************************************************//
}
/*My shortcodes */
add_shortcode( 'mocaqua_featured_posts', array('mocaqua_shortcodes_fe','featured_posts') );
add_shortcode( 'mocaqua_popular_lastest_posts', array('mocaqua_shortcodes_fe','popular_lastest_posts') );
add_shortcode( 'mocaqua_category_posts', array('mocaqua_shortcodes_fe','category_posts') );
add_shortcode( 'mocaqua_category_lists', array('mocaqua_shortcodes_fe','category_lists') );