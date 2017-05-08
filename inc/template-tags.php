<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package w3css-enfrte-blog
 */

if ( ! function_exists( 'a_simple_blog_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function a_simple_blog_posted_on() {
	$time_string = '<time datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		// A modified date exists (note the order of the classes)
		$time_string = '<time datetime="%1$s">%2$s</time> / <time datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted/Updated on %s', 'post date', 'a-simple-blog' ),
		'<span class="w3-opacity">' . $time_string . '</span>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'a-simple-blog' ),
		'<span class="author vcard"><a class="w3-tag w3-light-grey w3-hover-black" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<h5><span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span></h5>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'a_simple_blog_entry_categories_tags' ) ) :
/**
 * Prints HTML with meta information for the categories and tags.
 */
function a_simple_blog_entry_categories_tags() {
	if ( 'post' === get_post_type() ) {
		// translators: used between list items, there is a space after the comma
		$categories_list = get_the_category_list( esc_html__( ' ', 'a-simple-blog' ) );
		if ( $categories_list && a_simple_blog_categorized_blog() ) {
			printf( '<p><span class="cat-links">' . esc_html__( 'Posted in %1$s', 'a-simple-blog' ) . '</span></p>', $categories_list ); // WPCS: XSS OK.
		}

		// translators: used between list items, there is a space after the comma
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'a-simple-blog' ) );
		if ( $tags_list ) {
			printf( '<p><span class="tags-links">' . esc_html__( 'Tagged %1$s', 'a-simple-blog' ) . '</span></p>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		// Edit post link (if logged in)
		edit_post_link(
			esc_html__( 'Edit', 'a-simple-blog' ), '<span class="w3-row">', '</span>'
		);
	}
}
endif;

if ( ! function_exists( 'a_simple_blog_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the comments.
 */
function a_simple_blog_entry_footer() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		// Read More button link
		echo '<div class="w3-col m8 s12"><p>';
		echo '<a class="w3-button w3-padding-large w3-white w3-border" href="'.esc_url( get_permalink() ).'"><b>' . __('READ MORE »', 'a-simple-blog') . '</b></a>';
		echo '</p></div>';

		// Comments info
		echo '<div class="asb-comments-notification w3-col m4 s12"><p><span class="asb-comment-link w3-padding-large w3-right">';
		comments_popup_link(
			wp_kses(
				__( '<b>Comments</b> <span class="w3-tag"><b>0</b></span>', 'a-simple-blog' ),
				array( 'span' => array( 'class' => array() ), 'b' => array() )
			), // zero comments
			wp_kses(
				__( '<b>Comments</b> <span class="w3-tag"><b>1</b></span>', 'a-simple-blog' ),
				array( 'span' => array( 'class' => array() ), 'b' => array() )
			), // one comment
			wp_kses(
				__( '<b>Comments</b> <span class="w3-tag"><b>%</b></span>', 'a-simple-blog' ),
				array( 'span' => array( 'class' => array() ), 'b' => array() )
			), // two or more comments
			false, // class
			__( '<b>Comments disabled</b>', 'a-simple-blog' ) // comments turned off
		);
		echo '</span></p></div>';
	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function a_simple_blog_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'a_simple_blog_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'a_simple_blog_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so a_simple_blog_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so a_simple_blog_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in a_simple_blog_categorized_blog.
 */
function a_simple_blog_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'a_simple_blog_categories' );
}
add_action( 'edit_category', 'a_simple_blog_category_transient_flusher' );
add_action( 'save_post',     'a_simple_blog_category_transient_flusher' );
