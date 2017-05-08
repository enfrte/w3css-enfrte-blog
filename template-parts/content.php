<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package w3css-enfrte-blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('w3-card-4 w3-margin w3-white'); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<!-- <img src="<?php echo get_the_post_thumbnail_url(); ?>" style="width:100%;" /> -->
		<?php the_post_thumbnail('full'); /* styled with .wp-post-image */ ?>
	<?php endif; ?>
	<header class="w3-container w3-padding-8">
		<?php
		if ( is_single() ) :
			echo '<h1 class="entry-title">' . esc_html( strtoupper(get_the_title()) ) . '</h1>';
			// the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			echo '<h3 class="entry-title"><b><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . strtoupper(get_the_title()) . '</a></b></h3>';
			//the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<!-- Displays - Posted on date() by Author Name -->
			<?php a_simple_blog_posted_on(); /* function defined in /ing/template-tags.php */ ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="w3-container">
		<?php // customisation setting to toggle categories and tags visibility
		if (! get_theme_mod('a_simple_blog_show_hide_categories_tags')) {
			a_simple_blog_entry_categories_tags();
		}
		?>
		<div class="entry-content">
			<!-- Displays - Body of post -->
			<?php
				the_content();

				/*
					wp_link_pages() displays page links for paginated posts (i.e. includes
					the <!–nextpage–>. Quicktag one or more times). This tag must be within The Loop.
					*/
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'a-simple-blog' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="w3-row">
			<?php a_simple_blog_entry_footer(); /* function defined in /inc/template-tags.php */  ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->
