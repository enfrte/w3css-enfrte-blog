<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package w3css-enfrte-blog
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class("w3-content w3-card-4 w3-white w3-padding"); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php a_simple_blog_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<a href="<?php echo get_permalink() ?>">
			<?php the_excerpt(); ?>
		</a>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
