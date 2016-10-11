<?php get_header(); ?>

	<div id="primary" class="content-area uk-width-1-1 uk-width-large-7-10 site-content-left clearfix">
		<main id="main" class="site-main main-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php // get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template  ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>