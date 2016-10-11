<?php
/**
 * Template Name: Contact template
 */
get_header(); ?>

	<div id="primary" class="content-area uk-width-1-1 uk-width-large-7-10 site-content-left clearfix">
		<main id="main" class="site-main main-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( of_get_option( 'aquamag_lat' ) && of_get_option( 'aquamag_lng' ) ); { ?>
						<div id="map_canvas"></div>
						<script>
							jQuery(document).ready(function(){
								new GMaps({
									div: '#map_canvas',
									lat: <?php echo strip_tags( of_get_option( 'aquamag_lat' ) ); ?>,
									lng: <?php echo strip_tags( of_get_option( 'aquamag_lng' ) ); ?>,
									height: 380
								});
							});
						</script>
						<style>
						  #map_canvas {
						    width: 100%;
						    height: 380px;
						  }
						</style>
					<?php } ?>

					<div class="uk-grid contact-content">

						<div class="uk-width-1-1 uk-width-medium-1-3 contact-info">
							<?php if ( of_get_option( 'aquamag_contact_info_title' ) ); { ?>
								<h1 class="contact-title"><?php echo strip_tags( of_get_option( 'aquamag_contact_info_title' ) ); ?></h1>
							<?php } ?>
							
							<?php if ( of_get_option( 'aquamag_contact_info_desc' ) ); { ?>
								<p><?php echo stripslashes( of_get_option( 'aquamag_contact_info_desc' ) ); ?></p>
							<?php } ?>
							
							<?php if ( of_get_option( 'aquamag_contact_info_addr' ) ); { ?>
								<address><i class="uk-icon-map-marker"></i><?php printf( __( 'Address: %s', 'aquamag' ), of_get_option( 'aquamag_contact_info_addr' ) ); ?></address>
							<?php } ?>

							<?php if ( of_get_option( 'aquamag_contact_info_phone' ) ); { ?>
								<span class="contact-phone"><i class="uk-icon-phone"></i><?php printf( __( 'Phone: %s', 'aquamag' ), of_get_option( 'aquamag_contact_info_phone' ) ); ?></span>
							<?php } ?>

							<?php if ( of_get_option( 'aquamag_contact_info_email' ) ); { ?>
								<span class="contact-email"><i class="uk-icon-envelope"></i><?php printf( __( 'Email: %s', 'aquamag' ), of_get_option( 'aquamag_contact_info_email' ) ); ?></span>
							<?php } ?>

							<?php if ( of_get_option( 'aquamag_contact_info_name' ) ); { ?>
								<span class="contact-name"><i class="uk-icon-user"></i><?php printf( __( 'Name: %s', 'aquamag' ), of_get_option( 'aquamag_contact_info_name' ) ); ?></span>
							<?php } ?>

						</div>

						<div class="uk-width-1-1 uk-width-medium-2-3 contact-form">
							<?php the_title( '<h1 class="contact-title">', '</h1>' ); ?>
							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->
						</div>

					</div>

				</article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>