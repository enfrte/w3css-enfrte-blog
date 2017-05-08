<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package w3css-enfrte-blog
 */

get_header(); ?>

<div class="w3-row">
	<div id="primary" class="content-area w3-col l8 s12">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );
			?>

			<footer class="w3-row">
					<?php
					// nav links are created outside element
					the_post_navigation(
						array(
							'prev_text'          => '<button class="w3-button w3-block w3-padding-large w3-white w3-border w3-margin-bottom"><b>'. __('Prev', 'a_simple_blog') .' : </b>%title</button>',
							'next_text'          => '<button class="w3-button w3-block w3-padding-large w3-white w3-border w3-margin-bottom"><b>'. __('Next', 'a_simple_blog') .' : </b>%title</button>',
							'in_same_term'			 => true,
							'screen_reader_text' => 'Post navigation'
						)
					);
					?>
			</footer>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			a_simple_blog_set_post_views(get_the_ID()); // count post views - see popular-posts-widget.php

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
echo '</div>'; // End row holding primary and secondary (content / sidebar)
get_footer();
