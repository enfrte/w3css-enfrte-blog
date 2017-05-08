<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package w3css-enfrte-blog
 */

get_header(); ?>

<!--<div class="w3-row">-->
	<div id="primary" class="content-area w3-col l8 s12">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
			?>

			<footer class="w3-container">
					<?php
					// nav links are created outside element
					the_posts_navigation(
						array(
							'prev_text'          => '<button class="w3-button w3-padding-large w3-white w3-border w3-margin-bottom">Older posts</button>',
							'next_text'          => '<button class="w3-button w3-padding-large w3-white w3-border w3-margin-bottom">Newer posts</button>',
							'screen_reader_text' => 'Post navigation'
						)
					);
					?>
			</footer>
		<?php
		else :
			// call the no posts template
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
//echo '</div>'; // End row holding primary and secondary (content / sidebar)
get_footer();
