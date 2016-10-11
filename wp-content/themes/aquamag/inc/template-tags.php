<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * 
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'aquamag_thumbnail' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0.0
 */
function aquamag_thumbnail() {
?>
	<div class="article-img">
		<a class="uk-overlay" href="<?php the_permalink(); ?>">

			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'aquamag-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
			<?php endif; ?>

			<div class="uk-overlay-area uk-hidden-small">
				<?php
					$category = get_the_category();
					if ( $category && aquamag_categorized_blog() ) :
				?>
				<span class="cat-links">
					<?php echo esc_attr( $category[0]->name ); ?>
				</span>
				<span class="rating"><i class="uk-icon-eye"></i> <?php echo do_shortcode( '[entry-views]' ); ?></span>
				<?php endif; // End if $tags_list ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comment"><?php comments_number( '<i class="uk-icon-comment"></i> 0', '<i class="uk-icon-comment"></i> 1', '<i class="uk-icon-comment"></i> %' ); ?></span>
				<?php endif; ?>
				<time datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><span class="date"><?php echo esc_html( get_the_date() ); ?></span></time>
			</div>

			<div class="rating-area uk-visible-small">
				<span class="rating"><i class="uk-icon-eye"></i> <?php echo do_shortcode( '[entry-views]' ); ?></span>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comment"><?php comments_number( '<i class="uk-icon-comment"></i> 0', '<i class="uk-icon-comment"></i> 1', '<i class="uk-icon-comment"></i> %' ); ?></span>
				<?php endif; ?>
				<time datetime="<?php echo get_the_date( 'c' ); ?>"><span class="date"><?php echo get_the_date(); ?></span></time>
			</div>

		</a>
	</div>
<?php
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since  1.0.0
 * @return bool
 */
function aquamag_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'aquamag_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'aquamag_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so aquamag_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so aquamag_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in aquamag_categorized_blog.
 *
 * @since 1.0.0
 */
function aquamag_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'aquamag_categories' );
}
add_action( 'edit_category', 'aquamag_category_transient_flusher' );
add_action( 'save_post',     'aquamag_category_transient_flusher' );

if ( ! function_exists( 'aquamag_site_branding' ) ) :
/**
 * Site branding for the site.
 * 
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer page.
 * 
 * @since  1.0.0
 */
function aquamag_site_branding() {

	$logo = of_get_option( 'aquamag_logo' );

	// Check if logo available, then display it.
	if ( $logo ) :
		echo '<a class="logo" href="' . esc_url( get_home_url() ) . '" rel="home">' . "\n";
			echo '<img class="img-responsive" src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
		echo '</a>' . "\n";

	// If not, then display the Site Title and Site Description.
	else :
		echo '<h1 class="site-title"><a class="logo" href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></h1>';
	endif;

}
endif;

if ( ! function_exists( 'aquamag_social_links' ) ) :
/**
 * Social links.
 *
 * @since  1.0.0
 */
function aquamag_social_links() {

	// Get option value.
	$enable     = of_get_option( 'aquamag_enable_social', '1' );
	$facebook   = of_get_option( 'aquamag_fb' );
	$twitter    = of_get_option( 'aquamag_tw' );
	$gplus      = of_get_option( 'aquamag_gplus' );
	$linkedin   = of_get_option( 'aquamag_linkedin' );
	$flickr     = of_get_option( 'aquamag_flickr' );
	$dribbble   = of_get_option( 'aquamag_dribbble' );
	$instagram  = of_get_option( 'aquamag_instagram' );
	$youtube    = of_get_option( 'aquamag_youtube' );
	$vimeo      = of_get_option( 'aquamag_vimeo' );

	// Check if social links option enabled.
	if ( $enable ) {
		echo '<ul class="uk-hidden-small">';

			if ( $facebook ) {
				echo '<li><a href="' . esc_url( $facebook ) . '"><i class="uk-icon-facebook-square uk-icon-small"></i></a></li>';
			}
			if ( $twitter ) {
				echo '<li><a href="' . esc_url( $twitter ) . '"><i class="uk-icon-twitter uk-icon-small"></i></a></li>';
			}
			if ( $gplus ) {
				echo '<li><a href="' . esc_url( $gplus ) . '"><i class="uk-icon-google-plus uk-icon-small"></i></a></li>';
			}
			if ( $linkedin ) {
				echo '<li><a href="' . esc_url( $linkedin ) . '"><i class="uk-icon-linkedin-square uk-icon-small"></i></a></li>';
			}
			if ( $flickr ) {
				echo '<li><a href="' . esc_url( $flickr ) . '"><i class="uk-icon-flickr uk-icon-small"></i></a></li>';
			}
			if ( $dribbble ) {
				echo '<li><a href="' . esc_url( $dribbble ) . '"><i class="uk-icon-dribbble uk-icon-small"></i></a></li>';
			}
			if ( $instagram ) {
				echo '<li><a href="' . esc_url( $instagram ) . '"><i class="uk-icon-instagram uk-icon-small"></i></a></li>';
			}
			if ( $youtube ) {
				echo '<li><a href="' . esc_url( $youtube ) . '"><i class="uk-icon-youtube uk-icon-small"></i></a></li>';
			}
			if ( $vimeo ) {
				echo '<li><a href="' . esc_url( $vimeo ) . '"><i class="uk-icon-vimeo-square uk-icon-small"></i></a></li>';
			}

		echo '</ul>';
	}

}
endif;

if ( ! function_exists( 'aquamag_featured_posts' ) ) :
/**
 * Featured posts.
 *
 * @since  1.0.0
 */
function aquamag_featured_posts() {
	global $post, $cat;

	$enable = of_get_option( 'aquamag_enable_featured', '1' ); // Enable disable area.
	$tag    = of_get_option( 'aquamag_featured_tag' ); // Get the user selected tag for the featured posts.

	// Bail if disable by user.
	if ( ! $enable ) {
		return;
	}

	// Get any existing copy of our transient data.
	if ( false === ( $featured = get_transient( 'aquamag_featured_posts' ) ) ) {
		// It wasn't there, so regenerate the data and save the transient.
		
		// Posts query arguments.
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 4
		);

		if ( ! empty( $tag ) ) {
			$args['tag_id'] = $tag;
		}

		if ( is_category() ) {
			$args['cat'] = $cat;
		}

		// The post query
		$featured = get_posts( $args );

		// Store the transient.
		set_transient( 'aquamag_featured_posts', $featured );
	}

	// Check if the post(s) exist.
	if ( $featured ) :

		$html = '<div class="slider uk-clearfix">';

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

	// Restore original Post Data.
	wp_reset_postdata();

	// Display the posts.
	if ( ! empty( $html ) ) {
		echo $html;
	}

}
endif;

/**
 * Flush out the transients used in aquamag_featured_posts.
 *
 * @since 1.0.0
 */
function aquamag_featured_transient_flusher() {
	delete_transient( 'aquamag_featured_posts' );
}
add_action( 'save_post', 'aquamag_featured_transient_flusher' );
add_action( 'optionsframework_after_validate', 'aquamag_featured_transient_flusher' );

if ( ! function_exists( 'aquamag_post_author' ) ) :
/**
 * Author post informations.
 *
 * @since  1.0.0
 */
function aquamag_post_author() {

	// Bail if not on the single post.
	if ( ! is_single() ) {
		return;
	}

	// Bail if user hasn't fill the Biographical Info field.
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}

	// Bail if user don't want to display the author info via theme settings.
	if ( ! of_get_option( 'aquamag_post_author', '1' ) ) {
		return;
	}
?>

	<div class="post-author border-style">
		<article class="uk-comment">
			<header class="uk-comment-header">
				<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'aquamag_author_bio_avatar_size', 90 ) ); ?>
				<h3 class="uk-comment-title">
					<?php echo strip_tags( get_the_author() ); ?>
				</h3>
				<div class="uk-comment-meta"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></div>
				<a class="author-name url fn n author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( ( '%s <i class="uk-icon-angle-right"></i>' ), __( 'More from this Author', 'aquamag' ) ); ?></a>
			</header>
		</article>
	</div><!-- .post-author -->

<?php
}
endif;

if ( ! function_exists( 'aquamag_related_posts' ) ) :
/**
 * Related posts.
 *
 * @since  1.0.0
 */
function aquamag_related_posts() {
	global $post;

	// User selected to display the related posts or not.
	if ( ! of_get_option( 'aquamag_related_posts', '1' ) ) {
		return;
	}

	// Only display related posts on single post.
	if ( ! is_single() ) {
		return;
	}

	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );

	// Bail if term empty.
	if ( empty( $terms ) ) {
		return;
	}

	// Query arguments.
	$query = array(
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 3,
		'post__not_in'   => array( $post->ID ),
		'post_type'      => 'post',
	);

	// Allow plugins/themes developer to filter the default query.
	$query = apply_filters( 'aquamag_related_posts_query', $query );

	// Perform the query.
	$related = new WP_Query( $query );
	
	if ( $related->have_posts() ) : 
?>

		<div class="related-post border-style recent-post">

			<h4><?php _e( 'Related Articles', 'aquamag' ); ?></h4>
			<div class="uk-grid uk-clearfix">

				<?php while ( $related->have_posts() ) : $related->the_post(); ?>

					<div class="uk-width-1-1 uk-width-medium-1-3">
						<article class="one-third uk-clearfix">
							<?php aquamag_thumbnail(); // Get the thumbnail function. ?>
							<div class="article-text">
								<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							</div>
						</article>
					</div>

				<?php endwhile; ?>

			</div>

		</div><!-- .related-post -->

<?php 
	endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'aquamag_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since  1.0.0
 */
function aquamag_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'aquamag' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'aquamag' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment uk-comment">
			
			<header class="uk-comment-header">
				<?php echo get_avatar( $comment, 60 ); ?>
				<h4 class="uk-comment-title"><?php echo get_comment_author_link(); ?></h4>
				<div class="uk-comment-meta"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php echo get_comment_time( 'c' ); ?>"><?php echo get_comment_date(); ?></time></a></div>
			</header>

			<div class="uk-comment-body">
				<div class="comment-text">
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'aquamag' ); ?></p>
					<?php endif; ?>
					<?php comment_text(); ?>
					<span class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="uk-icon-reply"></i> Reply', 'aquamag' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span><!-- .reply -->
				</div>
			</div>

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'aquamag_social_share' ) ) :
/**
 * Social share.
 *
 * @since  1.0.0
 */
function aquamag_social_share() {
	global $post;

	/// User selected to display the social share or not.
	if ( ! of_get_option( 'aquamag_post_share', '1' ) ) {
		return;
	}

	// Only display social share on single post.
	if ( ! is_single() ) {
		return;
	}
?>

	<div class="share">
		<span class="media-title"><?php _e( 'Share this:', 'aquamag' ); ?></span>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="uk-icon-facebook-square"></i></a>
		<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="uk-icon-twitter-square"></i></a>
		<a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="uk-icon-google-plus-square"></i></a>
		<a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>&description=<?php echo get_the_excerpt(); ?>"><i class="uk-icon-pinterest-square"></i></a>
		<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&title=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&summary=<?php echo get_the_excerpt(); ?>&source=<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"><i class="uk-icon-linkedin-square"></i></a>
		<a href="mailto:?Subject=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&amp;body=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="uk-icon-envelope"></i></a>
		<a href="#" onclick="window.print();"><i class="uk-icon-print"></i></a>
	</div>

<?php
}
endif;

if ( ! function_exists( 'aquamag_latest_posts_home' ) ) :
/**
 * Latest posts.
 *
 * @since  1.0.0
 */
function aquamag_latest_posts_home() {

	// Used transient API to cache the related posts.
	if ( false === ( $latest = get_transient( 'aquamag_latest_query' ) ) ) {

		// Query arguments.
		$query = array(
			'posts_per_page' => 3,
			'post_type'      => 'post',
			'post__not_in'   => get_option( 'sticky_posts' )
		);

		// Allow plugins/themes developer to filter the default query.
		$query = apply_filters( 'aquamag_latest_posts_query', $query );

		// Perform the query.
		$latest = new WP_Query( $query );

		// Put the query results in a transient.
		set_transient( 'aquamag_latest_query', $latest );

	}
	
	if ( $latest->have_posts() ) : 
?>

	<?php while ( $latest->have_posts() ) : $latest->the_post(); ?>

		<div class="uk-width-1-1 uk-width-medium-1-3">
			<article class="one-third uk-clearfix">
				<?php aquamag_thumbnail(); // Get the thumbnail function. ?>
				<div class="article-text">
					<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
				</div>
			</article>
		</div>

	<?php endwhile; ?>

<?php 
	endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

/**
 * Flush out the transients used in aquamag_latest_posts.
 *
 * @since 1.0.0
 */
function aquamag_latest_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'aquamag_latest_query' );
}
add_action( 'save_post', 'aquamag_latest_transient_flusher' );

if ( ! function_exists( 'aquamag_popular_posts_home' ) ) :
/**
 * Popular posts.
 *
 * @since  1.0.0
 */
function aquamag_popular_posts_home() {

	// Used transient API to cache the related posts.
	if ( false === ( $popular = get_transient( 'aquamag_popular_query' ) ) ) {

		// Query arguments.
		$query = array(
			'posts_per_page' => 3,
			'post_type'      => 'post',
			'post__not_in'   => get_option( 'sticky_posts' ),
			'orderby'        => 'comment_count' 
		);

		// Allow plugins/themes developer to filter the default query.
		$query = apply_filters( 'aquamag_popular_posts_query', $query );

		// Perform the query.
		$popular = new WP_Query( $query );

		// Put the query results in a transient.
		set_transient( 'aquamag_popular_query', $popular );

	}
	
	if ( $popular->have_posts() ) : 
?>

	<?php while ( $popular->have_posts() ) : $popular->the_post(); ?>

		<div class="uk-width-1-1 uk-width-medium-1-3">
			<article class="one-third uk-clearfix">
				<?php aquamag_thumbnail(); // Get the thumbnail function. ?>
				<div class="article-text">
					<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
				</div>
			</article>
		</div>

	<?php endwhile; ?>

<?php 
	endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

/**
 * Flush out the transients used in aquamag_popular_posts.
 *
 * @since 1.0.0
 */
function aquamag_popular_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'aquamag_popular_query' );
}
add_action( 'save_post', 'aquamag_popular_transient_flusher' );

if ( ! function_exists( 'aquamag_first_cat_posts' ) ) :
/**
 * Popular posts.
 *
 * @since  1.0.0
 */
function aquamag_first_cat_posts() {

	// Pull the selected category.
	$cat_id = of_get_option( 'aquamag_first_cat' );

	// Get the category.
	$category = get_category( $cat_id );

	$childs = get_categories ( array(
		'hide_empty' => 0,
		'parent'     => $cat_id
	) );

	$cat_child = array( $cat_id );

?>

	<div class="recent-post border-style uk-clearfix">

		<div class="uk-grid">

			<div class="uk-width-1-1">
				<h4 class="post-title"><?php echo $category->name; ?></h4>
			</div>
			
			<div class="uk-width-1-1 duoi-gl">
				<ul class="uk-tab recent-post-tab catagory-post-tab" data-uk-tab="{connect:'#catagory-post-content'}">
					<?php if ( !empty( $childs ) ) : ?>
						<li class="uk-active"><a href="#"><?php _e( 'All', 'aquamag' ); ?></a></li>
					<?php endif; ?>
					<?php foreach ( $childs as $child ) : ?>
						<li><a href="#"><?php echo $child->name; ?></a></li>
						<?php $cat_child[] = $child->term_id; ?>
					<?php endforeach; ?>
				</ul>
			</div>

		</div><!-- .uk-grid -->

		<div id="catagory-post-content" class="uk-switcher">
			
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
endif;

if ( ! function_exists( 'aquamag_second_cat_posts' ) ) :
/**
 * Popular posts.
 *
 * @since  1.0.0
 */
function aquamag_second_cat_posts() {

	// Pull the selected category.
	$cat_id = of_get_option( 'aquamag_second_cat' );

	// Get the category.
	$category = get_category( $cat_id );

	$childs = get_categories ( array(
		'hide_empty' => 0,
		'parent'     => $cat_id
	) );

	$cat_child = array( $cat_id );

?>

	<div class="recent-post border-style uk-clearfix">

		<div class="uk-grid">

			<div class="uk-width-2-10 1">
				<h4 class="post-title"><?php echo $category->name; ?></h4>
			</div>
			
			<div class="uk-width-8-10">
				<ul class="uk-tab recent-post-tab catagory-post-tab" data-uk-tab="{connect:'#catagory-post-content1'}">
					<?php if ( !empty( $childs ) ) : ?>
						<li class="uk-active"><a href="#"><?php _e( 'All', 'aquamag' ); ?></a></li>
					<?php endif; ?>
					<?php foreach ( $childs as $child ) : ?>
						<li><a href="#"><?php echo $child->name; ?></a></li>
						<?php $cat_child[] = $child->term_id; ?>
					<?php endforeach; ?>
				</ul>
			</div>

		</div><!-- .uk-grid -->

		<div id="catagory-post-content1" class="uk-switcher">
			
			<?php foreach ( $cat_child as $catID ) : ?>

				<div class="uk-grid uk-clearfix">

					<?php 
					// Query arguments.
					$query = array(
						'posts_per_page' => 1,
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
										<p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
									</div>
								</article>
							<?php endwhile; ?>
						</div>

					<?php } wp_reset_postdata(); ?>

					<?php 
					// Query arguments.
					$query = array(
						'posts_per_page' => 3,
						'offset'         => 1,
						'post_type'      => 'post',
						'cat'            => $catID,
						'post__not_in'   => get_option( 'sticky_posts' )
					);

					// Perform the query.
					$posts = new WP_Query( $query );

					if ( $posts->have_posts() ) {
					?>
						<div class="uk-width-1-1 uk-width-medium-1-3 catagory-b">
							<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
								<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							<?php endwhile; ?>
						</div>

					<?php } wp_reset_postdata(); ?>
					
				</div>

			<?php endforeach; ?>

		</div><!-- #catagory-post-content -->

	</div><!-- .recent-post -->

<?php
	
}
endif;

if ( ! function_exists( 'aquamag_third_cat_posts' ) ) :
/**
 * Popular posts.
 *
 * @since  1.0.0
 */
function aquamag_third_cat_posts() {

	// Pull the selected category.
	$cat_id = of_get_option( 'aquamag_third_cat' );

	// Get the category.
	$category = get_category( $cat_id );

	$childs = get_categories ( array(
		'hide_empty' => 0,
		'parent'     => $cat_id
	) );

	$cat_child = array( $cat_id );

?>

	<div class="recent-post border-style uk-clearfix">

		<div class="uk-grid">

			<div class="uk-width-2-10 3">
				<h4 class="post-title"><?php echo $category->name; ?></h4>
			</div>
			
			<div class="uk-width-8-10">
				<ul class="uk-tab recent-post-tab catagory-post-tab" data-uk-tab="{connect:'#catagory-post-content2'}">
					<?php if ( !empty( $childs ) ) : ?>
						<li class="uk-active"><a href="#"><?php _e( 'All', 'aquamag' ); ?></a></li>
					<?php endif; ?>
					<?php foreach ( $childs as $child ) : ?>
						<li><a href="#"><?php echo $child->name; ?></a></li>
						<?php $cat_child[] = $child->term_id; ?>
					<?php endforeach; ?>
				</ul>
			</div>

		</div><!-- .uk-grid -->

		<div id="catagory-post-content2" class="uk-switcher">
			
			<?php foreach ( $cat_child as $catID ) : ?>

				<div class="uk-grid uk-clearfix">

					<?php 
					// Query arguments.
					$query = array(
						'posts_per_page' => 1,
						'post_type'      => 'post',
						'cat'            => $catID,
						'post__not_in'   => get_option( 'sticky_posts' )
					);

					// Perform the query.
					$posts = new WP_Query( $query );

					if ( $posts->have_posts() ) {
					?>
						
						<div class="uk-width-1-1 uk-width-medium-1-2">
							<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
								<article class="half-grid uk-clearfix">
									<?php aquamag_thumbnail(); // Get the thumbnail function. ?>
									<div class="article-text">
										<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
										<p><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
									</div>
								</article>
							<?php endwhile; ?>
						</div>

					<?php } wp_reset_postdata(); ?>

					<?php 
					// Query arguments.
					$query = array(
						'posts_per_page' => 3,
						'offset'         => 1,
						'post_type'      => 'post',
						'cat'            => $catID,
						'post__not_in'   => get_option( 'sticky_posts' )
					);

					// Perform the query.
					$posts = new WP_Query( $query );

					if ( $posts->have_posts() ) {
					?>
						<div class="uk-width-1-1 uk-width-medium-1-2">
							<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
								<article class="half-list uk-clearfix">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="article-img">
											<a class="uk-overlay" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( 'aquamag-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
											</a>
										</div>
									<?php endif; ?>
									<div class="article-text">
										<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
										<p><?php echo wp_trim_words( get_the_excerpt(), 8 ); ?></p>
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
endif;

if ( ! function_exists( 'aquamag_fourth_cat_posts' ) ) :
/**
 * Latest posts.
 *
 * @since  1.0.0
 */
function aquamag_fourth_cat_posts() {

	// Pull the selected category.
	$cat_id = of_get_option( 'aquamag_fourth_cat' );

	if ( ! isset( $cat_id ) ) {
		return;
	}

	// Get the category.
	$category = get_category( $cat_id );

	// Query arguments.
	$query = array(
		'post_type'    => 'post',
		'post__not_in' => get_option( 'sticky_posts' ),
		'cat'          => $cat_id
	);

	// Perform the query.
	$fourth = new WP_Query( $query );
	
	if ( $fourth->have_posts() ) : 
?>

	<div class="latest-video border-style uk-clearfix">
		<h4 class="post-title"><?php echo $category->name; ?></h4>
		<div class="latest-video-slider">
			<div id="video-flexslider" class="flexslider">
				<ul class="slides">
					<?php while ( $fourth->have_posts() ) : $fourth->the_post(); ?>
						<li>
							<a class="uk-overlay" href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'aquamag-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
								<?php endif; ?>
								<div class="uk-overlay-area">
									<i class="uk-icon-play-circle-o"></i>
									<h3><?php the_title(); ?></h3>
								</div>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
	</div>

<?php 
	endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'aquamag_featured_cat_posts' ) ) :
/**
 * Featured posts on category page.
 *
 * @since  1.0.0
 */
function aquamag_featured_cat_posts() {
	global $post, $cat;

	$enable = of_get_option( 'aquamag_enable_featured', '1' ); // Enable disable area.
	$tag    = of_get_option( 'aquamag_featured_tag' ); // Get the user selected tag for the featured posts.

	// Bail if disable by user.
	if ( ! $enable ) {
		return;
	}

	// Return early if not on category page.
	if ( ! is_category() ) {
		return;
	}
		
	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 4
	);

	if ( ! empty( $tag ) ) {
		$args['tag_id'] = $tag;
	}

	if ( is_category() ) {
		$args['category__in'] = $cat;
	}

	// The post query
	$featured = get_posts( $args );

	// Check if the post(s) exist.
	if ( $featured ) :

		$html = '<div class="slider uk-clearfix">';

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

	// Restore original Post Data.
	wp_reset_postdata();

	// Display the posts.
	if ( ! empty( $html ) ) {
		echo $html;
	}

}
endif;