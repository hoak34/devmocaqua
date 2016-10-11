<?php get_header(); ?>

	<section id="primary" class="content-area uk-width-1-1 uk-width-large-7-10 site-content-left clearfix">
		<main id="main" class="site-main main-content" role="main">

		<?php if ( have_posts() ) : ?>

			<div class="author-list">
				
				<form method="get" class="uk-search post-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
					<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'aquamag' ); ?>">
					<button class="uk-search-submit" type="submit" name="submit"><?php _e( 'Search', 'aquamag' ); ?></button>
				</form>

				<h2><?php printf( __( 'Search Results for: %s', 'aquamag' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

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
