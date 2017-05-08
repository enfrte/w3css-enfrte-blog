<?php
// tutorial: http://www.wpbeginner.com/wp-tutorials/how-to-track-popular-posts-by-views-in-wordpress-without-a-plugin/

class a_simple_blog_Popular_Posts_Widget extends WP_Widget {

public $posts_per_page = 5; // deafult

// Set up the widget name and description.
public function __construct() {

	$widget_options = array(
		'classname' => 'popular_posts_widget',
		'description' => __('Display the most popular posts in your blog.', 'a-simple-blog'),
	);
	parent::__construct( 'popular_posts_widget', __('Popular posts', 'a-simple-blog'), $widget_options );
}

// Create the widget output for the sidebar
public function widget( $args, $instance ) {
	// number of posts to display as set in the widget by the admin
	$posts_per_page = apply_filters( 'widget_posts_per_page', $instance[ 'posts_per_page' ] );
	$posts_per_page = (empty($posts_per_page) ? $this->posts_per_page : $posts_per_page); // set default if empty
	// sort the posts by view count
	$popular_post = new WP_Query( array( 'posts_per_page' => $posts_per_page, 'meta_key' => 'a_simple_blog_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );

	echo $args['before_widget']; ?>
	<div class="w3-container w3-padding w3-light-grey">
		<h4 class="widget-title"><?php echo __('Popular posts', 'a-simple-blog') ?></h4>
	</div>
	<div class="w3-row w3-white">
	<ul class="w3-ul w3-hoverable w3-white">
	<?php while ( $popular_post->have_posts() ) : $popular_post->the_post(); ?>
		<li class="w3-padding-16" style="padding-right:16px;">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail('popular_posts_widget_thumb', ['class' => 'w3-left w3-margin-right']); ?>
      	<!--<img src="<php  ?>" alt="Image" class="w3-left w3-margin-right" style="width:50px">-->
			<?php else: ?>
				<div class="w3-left w3-margin-right" style="width:50px;height:50px;background:lightgrey;border:1px solid #bbb;"></div>
			<?php endif; ?>
      <span class="w3-large"><?php echo mb_strimwidth(get_the_title(), 0, 32, '...'); ?></span>
			<?php if (!empty( get_the_excerpt() )): ?>
				<br><span><?php echo mb_strimwidth(get_the_excerpt(), 0, 42, '...'); ?></span>
			<?php endif; ?>
			</a>
    </li>
	<?php endwhile; ?>
	</ul>
	<?php if( ! $popular_post->have_posts() ): ?>
		<h4 style="width:100%;" class="w3-padding">Your posts haven't received enough views yet.</h4>
	<?php endif; ?>
	</div>
	<?php echo $args['after_widget'];

	//print_r($popular_post);

}

// Create the admin area widget settings form.
public function form( $instance ) {
	$posts_per_page = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : ''; ?>
	<p><b>Note: </b>If the blog is new, the posts list will not be populated until at least one post is viewed and counted.</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Number of posts to display in widget:', 'a-simple-blog' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo esc_attr( $posts_per_page ); ?>" />
	</p>
	<?php
}

// Apply settings to the widget instance.
public function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance[ 'posts_per_page' ] = strip_tags( $new_instance[ 'posts_per_page' ] );
	return $instance;
}

}

// set widget thumbnail size
function a_simple_blog_widget_thumbnail() {
	add_image_size('popular_posts_widget_thumb', 50, 50, true); // set an image thumbnail size
}
add_action( 'after_setup_theme', 'a_simple_blog_widget_thumbnail' );

// Register the widget.
function a_simple_blog_register_popular_posts_widget() {
  register_widget( 'a_simple_blog_Popular_Posts_Widget' );
}
add_action( 'widgets_init', 'a_simple_blog_register_popular_posts_widget' );

?>
