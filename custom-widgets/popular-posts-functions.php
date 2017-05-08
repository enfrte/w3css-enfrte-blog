<?php
/**
 * This is a single post page visitor counter.
 * Supports the popular posts widget. Required in functions.php
 * Needs to run regardless of whether the widget is activated.
 * Resets to zero if theme is changed(?) <- test this.
 */

// detect post views count and store it as a custom field for each post
function a_simple_blog_set_post_views($postID) {
	$count_key = 'a_simple_blog_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
	}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
	}
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// add the tracker in your header by using wp_head hook
function a_simple_blog_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;
    }
    a_simple_blog_set_post_views($post_id);
}
add_action( 'wp_head', 'a_simple_blog_track_post_views');

// display the post view count on your single post pages
function a_simple_blog_get_post_views($postID){
    $count_key = 'a_simple_blog_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}



?>
