<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package w3css-enfrte-blog
 */

?>

<!-- END GRID -->
</div><br>

<!-- END w3-content -->
</div>

<!-- Footer -->
<footer id="colophon" class="w3-container w3-dark-grey w3-padding w3-margin-top" role="contentinfo">
	<div class="site-info">
  <p>
		Powered by
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'a-simple-blog' ) ); ?>"><?php printf( esc_html__( '%s', 'a-simple-blog' ), 'WordPress' ); ?></a>
		<span class="sep"> | </span>
		<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'a-simple-blog' ), 'a-simple-blog', '<a href="https://github.com/enfrte" rel="designer">Leon Forte</a>' ); ?>
	</p>
</div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
