<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">






<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header header-main" role="banner">
		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="uk-container uk-container-center">
			<div class="uk-grid" data-uk-grid-match>