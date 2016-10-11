<?php
/**
 * Tabbed widget.
 *
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class AquaMag_Tabs_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-aquamag-tabs tabs-widget',
			'description' => __( 'Display popular posts, recent posts and tags in tabs.', 'aquamag' )
		);

		// Create the widget.
		$this->WP_Widget(
			'aquamag-tabs',                  // $this->id_base
			__( '&raquo; Tabs', 'aquamag' ), // $this->name
			$widget_options                  // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;
		?>
		
		<ul class="uk-tab" data-uk-tab="{connect:'#tab-content'}">
			<li class="active"><a href="#"><?php echo esc_attr( $instance['popular'] ); ?></a></li>
			<li><a href="#"><?php echo esc_attr( $instance['recent'] ); ?></a></a></li>
			<li><a href="#"><?php echo esc_attr( $instance['tags'] ); ?></a></li>
		</ul>

		<ul id="tab-content" class="uk-switcher">
			<li><?php echo aquamag_popular_posts(); ?></li>
			<li><?php echo aquamag_latest_posts(); ?></li>
			<li><?php the_widget( 'WP_Widget_Tag_Cloud' ); ?></li>
		</ul>

		<?php
		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['popular'] = strip_tags( $new_instance['popular'] );
		$instance['recent']  = strip_tags( $new_instance['recent'] );
		$instance['tags']    = strip_tags( $new_instance['tags'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'popular' => esc_html__( 'Popular', 'aquamag' ),
			'recent'  => esc_html__( 'Latest', 'aquamag' ),
			'tags'    => esc_html__( 'Tags', 'aquamag' )
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'popular' ); ?>">
				<?php _e( 'Popular posts title:', 'aquamag' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'popular' ); ?>" name="<?php echo $this->get_field_name( 'popular' ); ?>" value="<?php echo esc_attr( $instance['popular'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'recent' ); ?>">
				<?php _e( 'Recent posts title:', 'aquamag' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'recent' ); ?>" name="<?php echo $this->get_field_name( 'recent' ); ?>" value="<?php echo esc_attr( $instance['recent'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>">
				<?php _e( 'Tags title:', 'aquamag' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" value="<?php echo esc_attr( $instance['tags'] ); ?>" />
		</p>

	<?php

	}

}

/**
 * Popular Posts by comment
 *
 * @since 1.0.0
 */
function aquamag_popular_posts() {

	// Posts query arguments.
	$args = array(
		'posts_per_page' => 5,
		'orderby'        => 'comment_count',
		'post_type'      => 'post'
	);

	// The post query
	$popular = get_posts( $args );

	global $post;

	if ( $popular ) {
		$html = '<div class="posts-thumbnail-widget">';
			$html .= '<ul>';

				foreach ( $popular as $post ) :
					setup_postdata( $post );

					$html .= '<li>';
						$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'aquamag-widget-thumb', array( 'class' => 'entry-thumb', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
						$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . esc_attr( get_the_title( $post->ID ) ) . '</a>';
						$html .= '<time class="entry-date" datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
					$html .= '</li>';

				endforeach;

			$html .= '</ul>';
		$html .= '</div>';
	}

	// Reset the query.
	wp_reset_postdata();

	if ( isset( $html ) ) {
		return $html;
	}

}

/**
 * Recent Posts
 *
 * @since 1.0.0
 */
function aquamag_latest_posts() {

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 5
	);

	// The post query
	$recent = get_posts( $args );

	global $post;

	if ( $recent ) {
		$html = '<div class="posts-thumbnail-widget">';
			$html .= '<ul>';

				foreach ( $recent as $post ) :
					setup_postdata( $post );

					$html .= '<li>';
						$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'aquamag-widget-thumb', array( 'class' => 'entry-thumb', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
						$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . esc_attr( get_the_title( $post->ID ) ) . '</a>';
						$html .= '<time class="entry-date" datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
					$html .= '</li>';

				endforeach;

			$html .= '</ul>';
		$html .= '</div>';
	}

	// Reset the query.
	wp_reset_postdata();

	if ( isset( $html ) ) {
		return $html;
	}

}