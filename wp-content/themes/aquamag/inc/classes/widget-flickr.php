<?php
/**
 * Flickr widget.
 *
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class AquaMag_Flickr_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {
	
		$widget_ops = array( 
			'classname' => 'widget-aquamag-flickr flickr-widget', 
			'description' => __( 'Display photo galleries from your Flickr account.', 'aquamag' ) 
		);

		// Create the widget.
		$this->WP_Widget(
			'aquamag-flickr',                              // $this->id_base
			__( '&raquo; Flickr Photostream', 'aquamag' ), // $this->name
			$widget_ops                                    // $this->widget_options
		);

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title         = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$type          = $instance['type'];
		$tags          = $instance['tags'];
		$set           = $instance['set'];
		$id            = $instance['id'];
		$num_items     = $instance['num_items'];
		$before_list   = '<ul>';
		$html          = '<li class="picture-item %classes%"><a href="%flickr_page%" rel="external nofollow" title="%title%"><img src="%image_square%" alt="%title%"/></a></li>';
		$after_list    = '</ul>';
		$default_title = __( 'Untitled Flickr photo', 'aquamag' );

		echo $before_widget;
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
		$output = get_transient( 'flickr_cache' );

		if ( $output === false || $output === '' ) {
			$count = 0;

			if ( ! ( $rss = $this->getRSS( $instance ) ) )
				return;

			$pix = array();

			# builds html from array
			foreach ( $rss as $item ) {

				$count++;

				if( !preg_match( '<img src="([^"]*)" [^/]*/>', $item->get_description(), $imgUrlMatches ) ) {
					continue;
				}
				$baseurl = str_replace( "_m.jpg", "", $imgUrlMatches[1] );
				$thumbnails = array(
					'small' => $baseurl . "_m.jpg",
					'square' => $baseurl . "_s.jpg",
					'thumbnail' => $baseurl . "_t.jpg",
					'medium' => $baseurl . ".jpg",
					'large' => $baseurl . "_b.jpg"
				);

				#check if there is an image title (for html validation purposes)
				if( $item->get_title() !== "" )
					$pic_title = htmlspecialchars( stripslashes( $item->get_title() ) );
				else
					$pic_title = $default_title;

				$pic_url = $item->get_link();

				#build array with pix path and if applicable, cache them
				foreach ( $thumbnails as $size => $thumbnail ) {
					$cache_pic[$size] = $thumbnail;
				}

				$pix[] = array(
					'title' => $pic_title,
					'url' => $pic_url,
					'cache' => $cache_pic
				);

			}

			$output = stripslashes( $before_list );

			$count = 0;
			#array of pictures
			foreach( $pix as $pic ){

				$count++;
				$toprint = stripslashes( $html );

				if( strpos( $toprint, "%classes%" ) ) {
					$classes = 'item-'.$count;
					if( $count == 1 )
						$classes .= ' first';
					//If last element, add class 'last'
					if( $count == $num_items )
						$classes .= ' last';
					$toprint = str_replace( "%classes%", $classes, $toprint );
				}

				$toprint = str_replace( "%flickr_page%", $pic['url'], $toprint );
				$toprint = str_replace( "%title%", $pic['title'], $toprint );

				foreach( $pic['cache'] as $size => $path ) {
					$toprint = str_replace( "%image_".$size."%", $path, $toprint );
				}

				$output .= $toprint;
			}

			$output .= stripslashes( $after_list );
			set_transient( 'flickr_cache', $output, 60*60*12 );
		}
		echo $output;

		echo $after_widget;
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance; 
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['type']      = $new_instance['type'];
		$instance['tags']      = strip_tags( $new_instance['tags']);
		$instance['set']       = strip_tags( $new_instance['set']);
		$instance['id']        = strip_tags( $new_instance['id']);
		$instance['num_items'] = ( absint( $new_instance['num_items'] ) > 0 ) ? absint( $new_instance['num_items'] ) : 4;

        delete_transient( 'flickr_cache' );

		return $instance;
	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title'     => '',
			'type'      => 'user',
			'tags'      => '',
			'set'       => '',
			'id'        => '',
			'num_items' => 4
		);
		$instance  = wp_parse_args( (array) $instance, $defaults );
		$title     = esc_attr( $instance['title'] );
		$type      = $instance['type'];
		$tags      = esc_attr( $instance['tags'] );
		$set       = esc_attr( $instance['set'] );
		$id        = esc_attr( $instance['id'] );
		$num_items = $instance['num_items'];
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'aquamag' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'num_items' ); ?>"><?php _e( 'Display', 'aquamag'); ?></label>
			<select name="<?php echo $this->get_field_name( 'num_items' ); ?>" id="<?php echo $this->get_field_id( 'num_items' ); ?>">
				<?php for ($i=1; $i<=20; $i++) { ?>
					<option <?php selected( $num_items, $i ) ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
			<select onchange="javascript: toggleSource('<?php echo $this->get_field_id( 'type' ); ?>');" name="<?php echo $this->get_field_name( 'type' ); ?>" id="<?php echo $this->get_field_id( 'type' ); ?>">
				<option <?php selected( $type, 'user' ); ?> value="user"><?php _e( 'User', 'aquamag' ); ?></option>
				<option <?php selected( $type, 'set' ); ?> value="set"><?php _e( 'Set', 'aquamag' ); ?></option>
				<option <?php selected( $type, 'favorite' ); ?> value="favorite"><?php _e( 'Favorite', 'aquamag' ); ?></option>
				<option <?php selected( $type, 'group' ); ?> value="group"><?php _e( 'Group', 'aquamag' ); ?></option>
				<option <?php selected( $type, 'public' ); ?> value="public"><?php _e( 'Community', 'aquamag' ); ?></option>
			</select>
			<?php _e( 'photos', 'aquamag' ); ?>.
		</p>
		<p class="id_parent">
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'User or Group ID', 'aquamag' ); ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'id' ); ?>" type="text" id="<?php echo $this->get_field_id( 'id' ); ?>" value="<?php echo $id; ?>" /><br />
			<small><a href="<?php echo esc_url( 'http://idgettr.com/' ); ?>" rel="external" target="_blank"><?php _e( 'What is my ID ?', 'aquamag' );?></a></small>
		</p>
		<p class="set_parent">
			<label for="<?php echo $this->get_field_id( 'set' ); ?>"><?php _e( 'Set ID', 'aquamag' ); ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'set' ); ?>" type="text" id="<?php echo $this->get_field_id( 'set' ); ?>" value="<?php echo $set; ?>" /><br />
			<small><?php _e( 'Use number from the set url', 'aquamag' ); ?></small>
		</p>
		<p class="tags_parent">
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e( 'Tags (optional)', 'aquamag' ); ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'tags' ); ?>" type="text" id="<?php echo $this->get_field_id( 'tags' ); ?>" value="<?php echo $instance['tags']; ?>" size="40" />
			<small><?php _e( 'Comma separated, no spaces', 'aquamag' ); ?></small>
		</p>
		<script type="text/javascript">
            function toggleCache(a,b){jQuery("#"+a).is(":checked")?jQuery("#"+b).show():jQuery("#"+b).hide()} function toggleSource(a){if(jQuery("#"+a).val()=="user"){jQuery("#"+a).parent().nextAll("p.set_parent").hide();jQuery("#"+a).parent().nextAll("p.id_parent").show();jQuery("#"+a).parent().nextAll("p.tags_parent").show()}if(jQuery("#"+a).val()=="set"){jQuery("#"+a).parent().nextAll("p.set_parent").show();jQuery("#"+a).parent().nextAll("p.id_parent").show();jQuery("#"+a).parent().nextAll("p.tags_parent").hide()}if(jQuery("#"+a).val()=="favorite"){jQuery("#"+a).parent().nextAll("p.set_parent").hide(); jQuery("#"+a).parent().nextAll("p.id_parent").show();jQuery("#"+a).parent().nextAll("p.tags_parent").hide()}if(jQuery("#"+a).val()=="group"){jQuery("#"+a).parent().nextAll("p.set_parent").hide();jQuery("#"+a).parent().nextAll("p.id_parent").show();jQuery("#"+a).parent().nextAll("p.tags_parent").hide()}if(jQuery("#"+a).val()=="public"){jQuery("#"+a).parent().nextAll("p.set_parent").hide();jQuery("#"+a).parent().nextAll("p.id_parent").hide();jQuery("#"+a).parent().nextAll("p.tags_parent").show()}};
			toggleSource('<?php echo $this->get_field_id( 'type' ); ?>');
		</script>
		<?php
	}

	/**
	 * RSS setting
	 */
	function getRSS($settings) {
		require_once ( ABSPATH . WPINC . '/class-feed.php' );

		// get the feeds
		if ($settings['type'] == "user") { $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . $settings['id'] . '&tags=' . $settings['tags'] . '&format=rss_200'; }
		elseif ($settings['type'] == "favorite") { $rss_url = 'http://api.flickr.com/services/feeds/photos_faves.gne?id=' . $settings['id'] . '&format=rss_200'; }
		elseif ($settings['type'] == "set") { $rss_url = 'http://api.flickr.com/services/feeds/photoset.gne?set=' . $settings['set'] . '&nsid=' . $settings['id'] . '&format=rss_200'; }
		elseif ($settings['type'] == "group") { $rss_url = 'http://api.flickr.com/services/feeds/groups_pool.gne?id=' . $settings['id'] . '&format=rss_200'; }
		elseif ($settings['type'] == "public" || $settings['type'] == "community") { $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?tags=' . $settings['tags'] . '&format=rss_200'; }
		else {
			print __( '<strong>No "type" parameter has been setup. Check your settings, or provide the parameter as an argument.</strong>', 'aquamag' );
		}

		$feed = new SimplePie();
		$feed->set_feed_url($rss_url);
		$feed->set_cache_class('WP_Feed_Cache');
		$feed->set_file_class('WP_SimplePie_File');
		$feed->init();
		$feed->handle_content_type();

		if ( $feed->error() )
			printf( __( 'There was an error while connecting to Feed server, please, try again!', 'aquamag' ) );

		# get rss file
		return $feed->get_items(0, $settings['num_items']);
	}

}