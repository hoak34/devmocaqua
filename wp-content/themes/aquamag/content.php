<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php aquamag_thumbnail(); // Get the thumbnail function. ?>

	<div class="article-text">
		<?php the_title( sprintf( '<h3 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'aquamag' ) );
			if ( $tags_list ) :
		?>
		<span class="catagory">
			<?php printf( __( 'Tagged: %1$s', 'tj_basic' ), $tags_list ); ?>
		</span>
		<?php endif; // End if $tags_list ?>
	</div>
	
</article><!-- #post-## -->
