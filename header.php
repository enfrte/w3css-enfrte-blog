<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content"> (includes nav and title)
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package w3css-enfrte-blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class('w3-light-grey'); ?>>

<div id="page" class="site w3-content" style="max-width:1400px">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'a-simple-blog' ); ?></a> -->

	<!-- Header -->
	<header id="masthead" class="site-header w3-container w3-center w3-padding-32" role="banner">
		<div class="site-branding">

			<?php if ( get_theme_mod( 'a_simple_blog_logo' ) ) : ?><!-- see customizer.php -->
				<img src="<?php echo get_theme_mod( 'a_simple_blog_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
			<?php endif; ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo strtoupper(get_bloginfo( 'name' )); ?></a></h1>

			<?php	if ( is_front_page() && is_home() ) : ?>
				<?php $description = get_bloginfo( 'description', 'display' ); ?>
				<?php if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p><!-- wp tagline -->
				<?php endif; ?>
			<?php endif; ?>

		</div><!-- .site-branding -->
	</header>

	<!-- Grid -->
	<div id="content" class="site-content w3-row">
