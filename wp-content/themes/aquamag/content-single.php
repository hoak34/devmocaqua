<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="single-post-wrapper">

		<div class="rating-area">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'aquamag' ) );
				if ( $categories_list && aquamag_categorized_blog() ) :
			?>
				<span class="catagory">
					<?php printf( __( 'Category: %1$s', 'tj_basic' ), $categories_list ); ?>
				</span>
			<?php endif; // End if categories ?>

			<time datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><span class="date"><i class="uk-icon-clock-o"></i><?php echo esc_html( get_the_date() ); ?></span></time>

			<span class="rating"><i class="uk-icon-eye"></i> <?php echo do_shortcode( '[entry-views]' ); ?></span>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comment"><?php comments_number( '<i class="uk-icon-comment"></i> 0', '<i class="uk-icon-comment"></i> 1', '<i class="uk-icon-comment"></i> %' ); ?></span>
			<?php endif; ?>
		</div>

		<div class="entry-content uk-clearfix">

			<?php the_content(); ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'aquamag' ),
					'after'  => '</div>',
				) );
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<div class="post-share">

				<?php aquamag_social_share(); // Get the social share. ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'aquamag' ) );
					if ( $tags_list ) :
				?>
				<div class="tag-catagory">
					<span class="media-title">
						<?php printf( __( 'Tags: %1$s', 'aquamag' ), $tags_list ); ?>
					</span>
				</div>
				<?php endif; // End if $tags_list ?>
			</div>

			<?php edit_post_link( __( 'Edit', 'aquamag' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
		
	</div>

	<?php aquamag_post_author(); // Get the post author information. ?>

	<?php aquamag_related_posts(); // Get the related posts. ?>
	
</article><!-- #post-## -->
