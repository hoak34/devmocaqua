<?php get_header(); ?>

	<div id="primary" class="content-area uk-width-1-1 uk-width-large-7-10 site-content-left clearfix">
		<main id="main" class="site-main main-content" role="main">

			<section class="error-404 not-found">
				
				<div class="error-page">
					<h1><?php _e( '404', 'aquamag' ) ?></h1>
					<h2><?php _e( 'Oops! That page can&rsquo;t be found.', 'aquamag' ); ?></h2>
					<p><?php _e( 'Maybe the page was moved or deleted, or perhaps you just mistyped the address. Please, try to use the search form below.', 'aquamag' ); ?></p>
					<form method="get" class="uk-search post-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
						<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'aquamag' ); ?>">
						<button class="uk-search-submit" type="submit" name="submit"><?php _e( 'Search', 'aquamag' ); ?></button>
					</form>
				</div>

			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>