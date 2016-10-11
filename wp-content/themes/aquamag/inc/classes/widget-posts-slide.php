<?php
/**
 * Posts Slider with Thumbnail widget.
 *
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class AquaMag_Posts_Slide_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-aquamag-posts-slide posts-slides breaking-news',
			'description' => __( 'Display slider of posts list.', 'aquamag' )
		);

		// Create the widget.
		$this->WP_Widget(
			'aquamag-posts-slide',                   // $this->id_base
			__( '&raquo; Posts Slider', 'aquamag' ), // $this->name
			$widget_options                          // $this->widget_options
		);

		// Flush the transient.
		add_action( 'save_post'   , array( $this, 'flush_widget_transient' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_transient' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_transient' ) );

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

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		// Display the recent posts.
		if ( false === ( $slide = get_transient( 'aquamag_slide_widget_' . $this->id ) ) ) {

			// Posts query arguments.
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => $instance['limit']
			);

			if ( isset( $instance['cat'] ) ) {
				$args['category__in'] = $instance['cat'];
			}

			// The post query
			$slide = get_posts( $args );

			// Store the transient.
			set_transient( 'aquamag_slide_widget_' . $this->id, $slide );

		}

		global $post;
		if ( $slide ) {
			echo '<div id="news-slider" class="flexslider news-slider">';
				echo '<ul class="slides">';

					foreach ( $slide as $post ) :
						setup_postdata( $post );

						echo '<li>';
							echo '<article class="half-list uk-clearfix">';
								if ( has_post_thumbnail( $post->ID ) ) :
									echo '<div class="article-img">';
										echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'aquamag-widget-slide', array( 'class' => 'entry-thumb', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
									echo '</div>';
								endif;
								echo '<div class="article-text">';
									echo '<h3 class="article-title"><a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . esc_attr( get_the_title( $post->ID ) ) . '</a></h3>';
								echo '</div>';
							echo '</article>';
						echo '</li>';

					endforeach;

				echo '</ul>';
			echo '</div>';
		}

		// Reset the query.
		wp_reset_postdata();
		
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
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = (int) $new_instance['limit'];
		$instance['cat']   = $new_instance['cat'];

		// Delete our transient.
		$this->flush_widget_transient();

		return $instance;
	}

	/**
	 * Flush the transient.
	 *
	 * @since  1.0.0
	 */
	function flush_widget_transient() {
		delete_transient( 'aquamag_slide_widget_' . $this->id );
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title' => esc_html__( 'Breaking News', 'aquamag' ),
			'limit' => 5,
			'cat'   => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title', 'aquamag' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php _e( 'Number of posts to show', 'aquamag' ); ?>
			</label>
			<input type="text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo absint( $instance['limit'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php _e( 'Limit to specific or multiple Category: ', 'aquamag' ); ?></label>
		   	<select class="widefat" multiple="multiple" id="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat' ) ); ?>[]" style="width:100%;">
				<optgroup label="<?php echo esc_attr_e( 'Categories', 'aquamag' ); ?>">
					<?php $categories = get_terms( 'category' ); ?>
					<?php foreach( $categories as $category ) { ?>
						<option value="<?php echo $category->term_id; ?>" <?php if ( is_array( $instance['cat'] ) && in_array( $category->term_id, $instance['cat'] ) ) echo ' selected="selected"'; ?>><?php echo $category->name; ?></option>
					<?php } ?>
				</optgroup>
			</select>
		</p>

	<?php

	}

}