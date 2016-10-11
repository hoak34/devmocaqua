<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<nav id="site-navigation" class="uk-navbar top-nav" role="navigation">
		
		<div class="uk-container uk-container-center">
			<div class="uk-grid">

				<div class="uk-width-2-3 top-nav-left">
					<a href="#" class="uk-navbar-toggle uk-hidden-large" data-uk-offcanvas="{target:'#offcanvas-1'}"></a>
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container'       => '',
							'menu_id'         => 'menu-primary-items',
							'menu_class'      => 'uk-navbar-nav uk-visible-large sf-menu',
							'fallback_cb'     => '',
							'walker'          => new Aquamag_Walker_Nav
						)
					); ?>
				</div><!-- top-nav-left -->

				<div class="uk-width-1-3 top-nav-right">
					<?php aquamag_social_links(); ?>
				</div><!-- top-nav-right -->

			</div>
		</div>

		<div id="offcanvas-1" class="uk-offcanvas">
			<div class="uk-offcanvas-bar">

				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container'       => '',
						'menu_id'         => 'mobile-menu-primary',
						'menu_class'      => 'uk-nav uk-nav-offcanvas uk-nav-parent-icon',
						'items_wrap'      => '<ul id="%1$s" class="%2$s" data-uk-nav>%3$s</ul>',
						'fallback_cb'     => '',
						'walker'          => new Aquamag_Mobile_Walker_Nav
					)
				); ?>

			</div>
		</div><!--  uk-offcanvas  -->

	</nav><!-- #site-navigation -->

<?php endif; // End check for menu. ?>