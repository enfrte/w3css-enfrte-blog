<?php

class a_simple_blog_About_Widget extends WP_Widget {
  /**
  * To create the example widget all four methods will be
  * nested inside this single instance of the WP_Widget class.
  **/

	// Set up the widget name and description.
	public function __construct() {

		// Add Widget scripts
    add_action('admin_enqueue_scripts', array($this, 'scripts'));

		$widget_options = array(
			'classname' => 'about_widget',
			'description' => __('About you, your company, or your blog.', 'a-simple-blog'),
		);
		parent::__construct( 'about_widget', __('About', 'a-simple-blog'), $widget_options );
	}


	// Create the widget output.
  public function widget( $args, $instance ) {
    $name = apply_filters( 'widget_name', $instance[ 'name' ] );
		//$name = apply_filters( 'widget_name', empty( $instance['name'] ) ? __( 'Your Name', 'a-simple-blog' ) : $instance['name'] );
		$description = apply_filters( 'widget_description', $instance[ 'description' ] );
		//$description = apply_filters( 'widget_description', empty( $instance['description'] ) ? __( 'A paragraph about you, your blog, or your company', 'a-simple-blog' ) : $instance['description'] );
		$image = apply_filters( 'widget_image', $instance[ 'image' ] );

    echo $args['before_widget'] ?>
		<?php if(!empty($image)): ?>
			<img src="<?php echo $image ?>" alt="" style="width:100%">
		<?php endif; ?>
		<div class="w3-container w3-white">
		<?php if(!empty($name)): ?>
      <h4><b><?php echo $name ?></b></h4>
		<?php endif; ?>
		<?php if(!empty($description)): ?>
      <p><?php echo $description ?></p>
		<?php endif; ?>
		<?php if( empty($image) && empty($name) && empty($description) ): ?>
			<h4 style="width100%;" class="w3-center w3-padding">You need to enter either an image, name, or description to see anything in this widget.</h4>
		<?php endif; ?>
    </div>
    <?php echo $args['after_widget'];
  }


  // Create the admin area widget settings form.
  public function form( $instance ) {
    $name = ! empty( $instance['name'] ) ? $instance['name'] : ''; ?>
		<p><b>Note:</b> Fields are not compulsory, but you should have something in at least one.</p>
    <p>
      <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:', 'a-simple-blog' ); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo esc_attr( $name ); ?>" />
    </p><?php
		$description = ! empty( $instance['description'] ) ? $instance['description'] : ''; ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:', 'a-simple-blog' ); ?></label>
      <textarea rows="5" class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
    </p><?php
		$image = ! empty( $instance['image'] ) ? $instance['image'] : ''; ?>
    <p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image (at least 400px wide):', 'a-simple-blog' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
			<button style="margin-top:5px;" class="upload_image_button button button-primary">Upload Image</button>
      <!--
				<label for="<?php echo $this->get_field_id( 'image' ); ?>">Image:</label>
      	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_attr( $image ); ?>" />
			-->
    </p><?php
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'name' ] = strip_tags( $new_instance[ 'name' ] );
		$instance[ 'description' ] = strip_tags( $new_instance[ 'description' ], '<p><a><h1><h2><h3><h4><h5><h6><br><hr><b><em><i>' ); // 2nd parameter is allowed tags
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';

    return $instance;
  }

	// script for media upload button
	public function scripts()
	{
	   wp_enqueue_script( 'media-upload' );
	   wp_enqueue_media();
	   wp_enqueue_script('a-simple-blog-media-upload-button', get_template_directory_uri() . '/js/media-upload-button.js', array('jquery'));
	}

}

// Register the widget.
function a_simple_blog_register_about_widget() {
  register_widget( 'a_simple_blog_About_Widget' );
}
add_action( 'widgets_init', 'a_simple_blog_register_about_widget' );

?>
