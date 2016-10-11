<?php get_header(); ?>

	<section id="primary" class="content-area uk-width-1-1 uk-width-large-7-10 site-content-left clearfix">
		<main id="main" class="site-main main-content" role="main">

		<?php if ( have_posts() ) : ?>
				
			<div class="post-author author-detail">
				<article class="uk-comment">
					<header class="uk-comment-header">
						<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'aquamag_author_bio_avatar_size', 90 ) ); ?>
						<h3 class="uk-comment-title">
							<?php echo strip_tags( get_the_author() ); ?>
						</h3>
						<div class="uk-comment-meta"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></div>
						<div class="author-media">
							<?php if ( get_the_author_meta( 'facebook' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>"><i class="uk-icon-facebook"></i></a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'twitter' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'twitter' ) ); ?>"><i class="uk-icon-twitter"></i></a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'gplus' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'gplus' ) ); ?>"><i class="uk-icon-google-plus"></i></a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'pinterest' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'pinterest' ) ); ?>"><i class="uk-icon-pinterest"></i></a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'linkedin' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'linkedin' ) ); ?>"><i class="uk-icon-linkedin"></i></a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'tumblr' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'tumblr' ) ) ?>"><i class="uk-icon-tumblr"></i></a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'vimeo' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'vimeo' ) ); ?>"><i class="uk-icon-vimeo-square"></i></a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'instagram' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'instagram' ) ); ?>"><i class="uk-icon-instagram"></i></a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'feed' ) ); { ?>
								<a href="<?php echo esc_url( get_the_author_meta( 'feed' ) ); ?>"><i class="uk-icon-rss"></i></a>
							<?php } ?>
						</div>
					</header>
				</article>
			</div><!-- .post-author -->

			<div class="author-list">

				<div class="uk-clearfix"></div>
			
				<div class="list-view recent-post">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile; ?>
				</div>

			</div>

			<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
